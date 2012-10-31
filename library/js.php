<?php 
/**
 * 使用javascript.alert()函数
 * @param String $msg	@提示信息
 */
function alert( $msg )
{
	echo( '<script type="text/javascript" >alert("' . $msg . '");</script>' );
}



/**
 * 使用window.history.back()函数
 */
function back()
{
	echo( '<script>window.history.back();</script>' );
	die;
}



/**
 * 提示跳转
 * @param String $msg
 * @param String $url
 */
function tips_jump( $msg , $url)
{
	$msg = preg_replace('/\s/', '', $msg);
	echo( '<script type="text/javascript">alert("' . $msg . '"); window.location.href="' . $url . '";</script>' );
	die;
}



/**
 * 跳转
 * @param String $msg
 * @param String $url
 */
function url_jump( $url)
{
	echo( '<script type="text/javascript">window.location.href="' . $url . '";</script>' );
	die;
}


/**
 * 获取js的毫秒时间戳
 * return string;
 */
function get_microtime( $type ) {
	$sec	= explode( " " , microtime() );
	$micro	= explode( "." , $sec[0] );
	
	switch ($type){
		case 'JS': return $sec[1].'.'.substr( $micro[1] , 0 , 3 ); break;
		case 'PHP_MICRO': return $sec[1].'.'.$micro[1]; break;
		default: return 0; break;
	}
}


/**
 * 获取完整月份排列 1,2,3,4,5,6,7,8,9,10,11,12
 * @param	int		$index	取值，数字或者字符
 * @param	string	$detail	0=简写，1=详细
 * @return	array
 */
function get_moon_str( $index='' , $detail=0 ) {
	
	$index	= trim( $index );
	$mooon	= array('','January','February','March','April','May','June','July','August','September','October','November','December');
	
	if( is_numeric( $index ) ) {
		$mooon = $detail ? $mooon[ $index ] : substr( $mooon[ $index ] , 0 , 3 );
	} elseif( is_string( $index ) ) {
		$mooon = add_zero( array_search( $index , $mooon ) );
	}
	
	return $mooon;
}



/**
 * 补零
 * @param $strTime
 */
function add_zero( $strTime ) {
	if( strlen( $strTime ) == 1 ) {
		$strTime = '0' . $strTime;
	}
	return $strTime;
}