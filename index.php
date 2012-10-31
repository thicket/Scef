<?php
error_reporting(0);

function exceptions_error_handler($severity, $message, $filename, $lineno) {
    $exception = array(
            'message'=>$message,
            'code'=>10,
            'severity'=>$severity, 
            'file'=>$filename, 
            'line'=>$lineno,
            'get'=>$_GET,
            'post'=>$_POST,
            'path'=>$_SERVER['REQUEST_URI']
        );
    $exception = (object)$exception;
    showErrorPage($exception);
    die;
}


function exception_handler($e) {
    $exception = array(
            'message'=>$e->getMessage(),
            'code'=>$e->getCode(),
            'severity'=>0,//(int)$e->getTrace(), 
            'file'=>$e->getFile(),
            'line'=>$e->getLine(),
            'get'=>$_GET,
            'post'=>$_POST,
            'path'=>$_SERVER['REQUEST_URI']
        );
    $exception = (object)$exception;
    showErrorPage($exception);
}


function shutDownFunction() {
    $exception = error_get_last();
    if($exception){
        showErrorPage($exception);
        header('Location: /');
    }
}


function showErrorPage($exception) {
    echo '<pre>';
    $info = array();
    $info[] = 'LEVEL:'.$exception->severity;
    $info[] = 'CODE:'.$exception->code;
    $info[] = 'INFO:'.$exception->message;
    $info[] = 'FILE:'.$exception->file;
    $info[] = 'LINE:'.$exception->line;
    $info[] = 'GET:'.$exception->get;
    $info[] = 'POST:'.$exception->post;
    $info[] = 'PATH:'.$exception->path;
    //echo mysql_errno() . ": " . mysql_error() . "\n";
    echo join(PHP_EOL,$info);
    die;
}


register_shutdown_function('shutdownFunction');
set_exception_handler('exception_handler');
set_error_handler('exceptions_error_handler');


define('ROOT', dirname(__FILE__) . '/');

include ROOT . 'config/project.php';
include ROOT . 'library/common.php';

header('Content-Type:text/html;charset=' . PROJECT_CHARSET);

session_start();
clearstatcache();	//清除php缓存过得文件

$query_string = array();
$controller = DEF_CTRE;
$function = DEF_FUNC;
$path = '';

//导入必须的库
include ROOT . 'library/system.php';
include ROOT . 'library/js.php';
include ROOT . 'library/L_mysql.php';
include ROOT . 'library/L_load.php';


$load = new L_load();


//参数处理
if ($_SERVER['QUERY_STRING']) {

    $query_string = $_SERVER['QUERY_STRING'] ? explode('/', $_SERVER['QUERY_STRING']) : '';
    $path = ROOT . 'controller/' . $query_string[0] . '.php';

    if (empty($query_string[0])) {
        array_shift($query_string);
    } else {
        if (is_file($path)) {
            $controller = array_shift($query_string);
        } else {
            array_shift($query_string);
        }
    }
    if (empty($query_string[0])) {
        array_shift($query_string);
    } else {
        if (preg_match('/[a-z][\w]+/i', $query_string[0])) {
            $function = array_shift($query_string);
        } else {
            array_shift($query_string);
        }
    }
} else {
    $path = ROOT . 'controller/' . $controller . '.php';
}

/*
//登录
if (empty($_POST['login_uid']) || empty($_POST['login_passwd'])) {

    if (empty($_COOKIE[COOKIE_KEY]) || empty($_COOKIE[$_COOKIE[COOKIE_KEY]])) {
        $load->assign(get_init_view_data());
        $load->view('header');
        $load->view('login');
        $load->view('footer');
        die;
    }

    if (empty($_SESSION['login'][$_COOKIE[COOKIE_KEY]])) {
        $login = json_decode($_COOKIE[$_COOKIE[COOKIE_KEY]]);
        if (empty($login)) {
            alert('请登录再操作!');
            $load->assign(get_init_view_data());
            $load->view('login');
            die;
        } else {
            $_POST['login_uid'] = $login['uid'];
            $_POST['login_passwd'] = $login['passwd'];
            $controller = 'login';
            $function = 'index';
        }
    }
} else {
    $controller = 'login';
    $function = 'index';
}
*/


//-- 加载 --/
if(file_exists($path)){
    include $path;
}else{
    //trigger_error('没有此页');
    header('Location: /');
    die;
}


if (function_exists($function)) {
    
} elseif (function_exists(DEF_FUNC)) {
    $function = DEF_FUNC;
} else {
    header('Location: /');
    die;
}


//当前控制器名称
if (!defined('CTRE')) {
    define('CTRE', $controller);
}
//当前控制器调用的方法名称
if (!defined('FUNC')) {
    define('FUNC', $function);
}

//当前控制器调用的方法名称
if (!defined('XML_PATH_BASE')) {
    define('XML_PATH_BASE', ROOT . 'xml/');
}
//当前控制器调用的方法名称
if (!defined('XML_PATH_VIEW')) {
    define('XML_PATH_VIEW', XML_PATH_BASE . 'view/');
}

if (realpath(XML_PATH_VIEW . $controller . '.xml')) {
    $xml = simplexml_load_file(XML_PATH_VIEW . $controller . '.xml');
} else {
    $xml = '';
}

//-- 方法调用 --/
$data = array();

try {
    $data = $function();
} catch (Exception $e) {
    infoHandler($e->getMessage());
}

$data['category'] = 'default';

//-- 数据 --/
$load->assign($data);


$view = json_decode(file_get_contents('json/view/home'));

if( empty($view->$controller->$data['category']->page) ){
    alert('none configure!');
    error_page();
}


//-- 页面 --/
foreach ($view->$controller->$data['category']->page as $v) {
    $load->view($v);
}
die;;
