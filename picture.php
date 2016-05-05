<?php 
require 'simple_html_dom.php';

function startWith($str, $needle) {

    return strpos($str, $needle) === 0;
}
//$header =  getallheaders();

$url = $_GET["url"];

if (is_null($url)) {
	$url = 'http://www.wufafuwu.com/a/ONE_tupian/2016/0310/4587.html';
}

$html=file_get_html($url);

header("Content-type: text/html; charset=UTF-8"); 
header("Cache-Control: public, max-age=604800");

$root = $html->find('[class=d]',0);

$item = array();

$img = $root->find('[class=one-imagen]',0)->find('img',0)->attr['src'];
if (!startWith($img,'http://wufafuwu.com')) {
	$img = 'http://wufafuwu.com'.$img;
}

$num = $root->find('[class=one-titulo]',0)->innertext;
$author = $root->find('[class=one-imagen-leyenda]',0)->innertext;
$content =  '    '.$root->find('[class=one-cita]',0)->innertext;
$year =  $root->find('[class=may]',0)->innertext;
$day = $root->find('[class=dom]',0)->innertext;

$item['author'] = urldecode(ltrim(urlencode(iconv('GBK','UTF-8', $author)),'+'));
$item['img'] =urldecode(ltrim(urlencode(iconv('GBK','UTF-8', $img)),'+'));
$item['num'] =urldecode(ltrim(urlencode(iconv('GBK','UTF-8', $num)),'+'));
$item['content'] = urldecode(ltrim(urlencode(iconv('GBK','UTF-8', $content)),'+'));
$item['year'] = urldecode(ltrim(urlencode(iconv('GBK','UTF-8', $year)),'+'));
$item['day'] =urldecode(ltrim(urlencode(iconv('GBK','UTF-8', $day)),'+'));


//echo $re->plaintext;
$json = json_encode($item,JSON_UNESCAPED_UNICODE);
//echo $json;
//echo $item['author'];
//echo var_dump($item);
$json = str_replace('\t','',$json);
echo str_replace('&amp;','&',$json);
?>