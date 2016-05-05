<?php 
require 'simple_html_dom.php';


function startWith($str, $needle) {

    return strpos($str, $needle) === 0;

}


$header =  getallheaders();

//$url = $header['url'];
$url = $_GET["url"];
if (is_null($url)) {
	$url = 'http://www.wufafuwu.com/a/ONE_dongxi/2016/0130/4439.html';
}

$html=file_get_html($url);
header("Content-type: text/html; charset=UTF-8"); 
header("Cache-Control: public, max-age=604800");

$root = $html->find('[class=d]',0);

$item = array();

$img = $root->find('[class=cosas-imagen]',0)->find('img',0)->attr['src'];
$name = $root->find('[class=cosas-titulo]',0)->plaintext;
$content = $root->find('[class=cosas-contenido]',0)->plaintext;

if (!startWith($img,'http://wufafuwu.com')) {
	$img = 'http://wufafuwu.com'.$img;
}


$item['name'] = urlencode($name);
$item['content'] = urlencode($content);
$item['img'] = urlencode($img);


$item['name'] = urldecode(trim($item['name'],'+'));
$item['content'] = urldecode(trim($item['content'],'+'));
$item['img'] = urldecode(trim($item['img'],'+'));

//echo $re->plaintext;
$json =  json_encode($item,JSON_UNESCAPED_UNICODE);
$json =  str_replace('\t','',$json);


echo $json;
?>