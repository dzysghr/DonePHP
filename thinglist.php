<?php 

require 'simple_html_dom.php';


$urlbase ="http://www.wufafuwu.com/a/ONE_dongxi/list_10_%d.html";
$urlhead = "http://www.wufafuwu.com";
$page = $_GET["page"];

if (is_null($page)) {
	$page = 1;
}

$url = str_replace("%d",$page,$urlbase);


$html=file_get_html($url);
header("Content-type: text/html; charset=UTF-8"); 
header("Cache-Control: public, max-age=604800");

$re =  $html->find('[class=pic-list cl animated fadeInUp]',0);

$ars = array();

foreach ($re->children as $li ) {

    $item = array();



    $img = $li->find('img',0)->attr['src'];

    $title = $li->find('b',0)->innertext;
    
    $date = $li->find('[class=meta-data]',0)->innertext;
    
    $content = $li->find('p',0)->innertext();
    $url =$li->find('a',0)->attr['href'];


    $item['title'] = urlencode(iconv('GBK', 'UTF-8//IGNORE',$title));
    $item['date'] = urlencode(iconv('GBK', 'UTF-8//IGNORE',$date));
    $item['content'] =urlencode(iconv('GBK', 'UTF-8//IGNORE',$content));
    $item['url'] =$urlhead.urlencode(iconv('GBK', 'UTF-8//IGNORE',$url));
    $item['img'] = $urlhead.urlencode(iconv('GBK', 'UTF-8//IGNORE',$img));
    $item['type'] = 3;

    $ars[] = $item;



}

$json = urldecode(json_encode($ars));
//echo var_dump($ars);

echo $json;


?>