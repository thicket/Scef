<?php

$str = file_get_contents('level.txt');
$arr = explode( '}' , $str );

$str = '<?xml version="1.0" encoding="UTF-8"?>';
$str .= '<handle>';
foreach( $arr as $s ){
	preg_match( '/(\w+)\s*group/i' , $s , $m );
	if( empty($m[1]) ) {
	} else {
		$str .= '<group><name>'.$m[1].'</name>';
		preg_match_all( '/(-{0,1}\d{1,3})\s-\s([^\n]+)/i' , $s , $mm );
		foreach( $mm[0] as $k=>$v ){
			$str .= '<type><name>'.$mm[1][$k].'</name>';
			$str .= '<value>'.$mm[2][$k].'</value></type>';
		}
		$str .= '</group>';
	}
}
$str .= '</handle>';
echo $str;
die;
/*
$xml = simplexml_load_file('./handle_type.xml');
print_r($xml);
foreach( $xml->group as $g ){
	echo trim($g->name);
	echo PHP_EOL;echo PHP_EOL;
	foreach( $g->type as $i ){
		echo trim($i->name).'-'.trim($i->value);
		echo PHP_EOL;
	}
	echo PHP_EOL;echo PHP_EOL;echo PHP_EOL;
}
die;*/
