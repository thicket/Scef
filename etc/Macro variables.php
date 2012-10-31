<?php
/*
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
die;*/

define( 'ROOT'		, dirname( __FILE__ ) . '/' );

include ROOT.'config/project.php';
include ROOT.'library/common.php';

header( 'Content-Type:text/html;charset='.PROJECT_CHARSET );

session_start();

$query_string	= array();
$controller		= DEF_CTRE;
$function		= DEF_FUNC;
$path = '';

//导入必须的库
include ROOT.'library/system.php';
include ROOT.'library/js.php';
include ROOT.'library/L_mysql.php';
include ROOT.'library/L_load.php';



//set error handler
//set_error_handler("customError");

$load = new L_load();


//参数处理
if( $_SERVER['QUERY_STRING'] ) {

	$query_string = $_SERVER['QUERY_STRING'] ? explode( '/' , $_SERVER['QUERY_STRING'] ) : '';
	$path = './controller/'.$query_string[0].'.php';
	
	if( empty($query_string[0]) ) {
		array_shift( $query_string );
	}else{
		if( is_file($path) ) {
			$controller = array_shift( $query_string );
		}else{
			array_shift( $query_string );
		}
	}
	if( empty($query_string[0]) ) {
		array_shift( $query_string );
	}else{
		if( preg_match( '/[a-z][\w]+/i' , $query_string[0] ) ) {
			$function = array_shift( $query_string );
		}else{
			array_shift( $query_string );
		}
	}
}else{
	$path = './controller/'.$controller.'.php';
}


//登录
if( empty($_POST['login_uid']) || empty($_POST['login_passwd']) ) {

	if( empty($_COOKIE[DOMAINTAG]) || empty($_COOKIE[$_COOKIE[DOMAINTAG]]) ) {
		$load->assign(get_init_view_data());
		$load->view('header');
		$load->view('login');
		$load->view('footer');
		die;
	}

	if( empty( $_SESSION['login'][$_COOKIE[DOMAINTAG]] ) ) {
		$login = json_decode( $_COOKIE[$_COOKIE[DOMAINTAG]] );
		if( empty( $login ) ) {
			alert('请登录再操作!');
			$load->assign(get_init_view_data());
			$load->view('header');
			$load->view('login');
			$load->view('footer');
			die;
		} else {
			$_POST['login_uid']		= $login['uid'];
			$_POST['login_passwd']	= $login['passwd'];
			$controller			= 'login';
			$function			= 'index';
		}
	}
} else {
	$controller	= 'login';
	$function	= 'index';
}



/** 加载 **/

include $path;

$data = array();
if( function_exists($function) ) {
}elseif( function_exists(DEF_FUNC) ) {
	$function = DEF_FUNC;
}else{
	alert('没有此页');
	back();
	die;
}


//当前控制器名称
if( !defined( 'CTRE' ) ) {
	define( 'CTRE' , $controller );
}
//当前控制器调用的方法名称
if( !defined( 'FUNC' ) ) {
	define( 'FUNC' , $function );
}


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


if( realpath('./xml/'.$controller.'.xml') ){
	$xml = simplexml_load_file('./xml/'.$controller.'.xml');
}else{
	$xml = '';
}


/** 方法调用 **/
try{
	$data = $function();
} catch (Exception $e) {
	infoHandler($e->get_init_view_data);
}

$data['static']		= 'default';

/** 数据 **/
empty($data)?'':$load->assign($data);

/** 页面 **/


if( $xml && $xml->controller->name == CTRE ){
	
	foreach( $xml->controller->action as $action ){
		
		if($action->name == FUNC){
			
			foreach( $action->view as $view ){
				
				if( (!empty($view->name)) && (!empty($data['static'])) && ($view->name == $data['static']) ){
					
					$view = (array)$view->html;
					$view = (array)$view['page'];
					
					if( is_array($view) ){
						foreach( $view as $v ){
							$load->view( $v );
						}
					}else{
						error_page('配置文件设置不全，页面文件配置出错。');
					}
					die;
				}else{
					error_page('配置文件设置不全，页面名称配置出错。');
					die;
				}
			}
		}
	}
}else{
	error_page();
}