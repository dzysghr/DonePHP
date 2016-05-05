<?php 
require 'simple_html_dom.php';

$header =  getallheaders();

//$url = $header['url'];
$url = $_GET["url"];
if (is_null($url)) {
	$url = 'http://www.wufafuwu.com/a/ONE_wenzhang/2016/0215/4498.html';
}

$html=file_get_html($url);
header("Content-type: text/html; charset=UTF-8"); 
header("Cache-Control: public, max-age=604800");

$re = $html->find('[class=articulo-contenido]', 0);
//echo $re->plaintext;
$out = iconv('GBK', 'UTF-8//IGNORE',$re->innertext());
//echo $re->innertext();
//utf-8 正常
echo $out;
?>