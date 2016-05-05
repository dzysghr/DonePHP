<?php 
require 'simple_html_dom.php';

$header =  getallheaders();

//$url = $header['url'];
$url = $_GET["url"];
if (is_null($url)) {
	$url = 'http://www.wufafuwu.com/a/ONE_wenda/2016/0319/4615.html';
}

$html=file_get_html($url);
//header("Content-type: text/html; charset=GBK"); 
header("Cache-Control: public, max-age=604800");


$h = $html->find('[class=cuestion-contenido]', 0);
$head= iconv('GBK','UTF-8//IGNORE', $h->plaintext);

$re = $html->find('[class=cuestion-contenido]', 1);
//echo $re->plaintext;
//urldecode(ltrim(urlencode(iconv('GBK','UTF-8', $re->innertext())),'+'));
//$out = $re->innertext();
//$out =  mb_convert_encoding($re->innertext(), "UTF-8", "gbk");
$out= iconv('GBK','UTF-8//IGNORE', $re->innertext());


//utf-8 正常
echo $out;
?>