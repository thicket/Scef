<?php

/**
 * 遍历数据，使之字符串符合sql语句
 */
function chk_str_to_sql(Array $data) {
    foreach ($data as $k => $v) {
        if (is_string($v)) {
            $data[$k] = '"' . mysql_real_escape_string($v) . '"';
            //$data[$k] = '"' . $v . '"';
        }
    }
    return $data;
}

function mbSubStr($str, $num) {
    return ( mb_strlen($str, 'utf-8') > $num ) ? (mb_substr($str, 0, $num, 'utf-8') . '...') : $str;
}

/*
 * 初始页面所需数据
 */

function get_init_view_data() {
    $data = array();
    $data['__start_time'] = get_microtime('JS');
    return $data;
}

function get_url() {
    $url = array();
    $url = get_init_view_data();
    $url['header_articles'] = '?articles/create/';
    $url['header_product'] = '?product/create/';
    $url['header_images'] = '?images/upload/';


    $url['add'] = '?' . CTRE . '/fill/';
    $url['insert'] = '?' . CTRE . '/insert/';
    $url['edit'] = '?' . CTRE . '/edit/';
    $url['update'] = '?' . CTRE . '/update/';
    $url['delete'] = '?' . CTRE . '/delete/';

    return $url;
}

function error_page($data='') {
    if (!is_array($data)) {
        $data = (array) $data;
        $data['info'] = $data[0];
    }
    extract($data);
    include 'view/error.php';
}

/* * --------------------------------------------------input* */

/**
 * 添加过滤
 * @param unknown_type $str
 */
function str_add_filter($str) {
    $str = htmlentities($str, ENT_QUOTES, 'UTF-8');
    if (get_magic_quotes_gpc()) {
        $str = stripslashes($str);
    }
    return $str;
}

/**
 * 解除过滤
 * @param unknown_type $str
 */
function str_un_filter($str) {
    $str = html_entity_decode($str, ENT_QUOTES, 'UTF-8');
    return $str;
}

/**
 * 添加输入值的过滤
 * @param unknown_type $input
 * @param unknown_type $type
 */
function chk_input($input = '', $type = '') {
    $data = get_input($input, $type);

    if (is_array($data)) {
        foreach ($data as $str) {
            $str = str_add_filter($str);
        }
    } else {
        $data = str_add_filter($data);
    }
    return $data;
}

/**
 * 解除输入值的过滤
 * @param unknown_type $input
 * @param unknown_type $type
 */
function unchk_input($input = '', $type = '') {
    $data = $input;

    if (is_array($data)) {
        foreach ($data as $str) {
            $str = str_un_filter($str);
        }
    } else {
        $data = str_un_filter($data);
    }
    return $data;
}

/**
 * 获得所有传值
 * @param unknown_type $input
 * @param unknown_type $type
 */
function get_input($input = '', $type = '') {
    switch ($type) {

        case 'get':
            return empty($input) ? $_GET : isset($_GET[$input]) ? $_GET[$input] : '';
            break;
        case 'post':
            return empty($input) ? $_POST : isset($_POST[$input]) ? $_POST[$input] : '';
            break;
        default:
            return empty($input) ? $_REQUEST : isset($_REQUEST[$input]) ? $_REQUEST[$input] : '';
            break;
    }
}

/* * --------------------------------------------------file* */

/**
 * 删除目录里的,所有或者指定类型文件
 * @param string $dir
 * @param string $type
 */
function delTree($dir, $type = '') {
    foreach (glob($dir . '*') as $file) {
        if (is_dir($file)) {
            delTree($file, $type);
        } else {
            unlink($file);
        }
    }

    if (is_dir($dir)) {
        return rmdir($dir);
    }
}

/**
 * 枷锁写入文件
 * @param string $path
 * @param string $data
 */
function lockWriteFile($path, $data) {
    $pathinfo = pathinfo($path);

    if (!is_dir($pathinfo['dirname'])) {
        mkdir($pathinfo['dirname']);
    }

    $fh = fopen($path, 'w');

    if (!$fh) {
        throw new Exception('文件打开错误');
    }
    if (flock($fh, LOCK_EX)) {
        if (!fwrite($fh, $data)) {
            throw new Exception('文件写入错误');
        }
        flock($fh, LOCK_UN);
    } else {
        throw new Exception('文件加锁错误');
    }

    $fh ? fclose($fh) : '';
    return true;
}

/**
 * 记录日志到文件
 * @param unknown_type $info
 */
function bug_log($file_path, $info) {
    if (defined('BUG_LOG') && ( BUG_LOG == 1 )) {
        $arr = array(date('Y-m-d H:i:s'), $file_path, HTTP_PATH, $info);
        $info = join(PHP_EOL, $arr);
        $handle = fopen(BUG_LOG_PATH . 'log.txt', 'a');
        fwrite($handle, $info);
        fclose($handle);
    }
}

/**
 * 获取宏定义
 * @param string $argv
 * @param string $pattern
 */
function get_macro($argv = 'user', $pattern = '') {
    $macro = array();
    $arr = array();
    $key = array();

    $argv = empty($argv) ? 'user' : $argv;

    $macro = arr_to_object(get_defined_constants(1))->$argv; // 获取用户的宏定义

    if ($pattern) {
        $key = array_keys($macro); //获取数组字段
        $filter = preg_replace_callback('/' . $pattern . '/', 'filter_null', $key); // 过滤匹配的宏定义
        $arr = array_diff($key, $filter); // 计算差值，获得被过滤的数据
        $arr = array_flip($arr); // 翻转键值

        return array_intersect_key($macro, $arr);  // 使用键名比较计算数组的交集
    }

    return $macro;
}

/**
 * 生成随机长度的字符串
 * @param int $length
 */
function random_string($length) {

    $string = '';
    $index = 0;

    do {
        $length--;
        $index = mt_rand(0, 2);

        switch ($index) {
            case 0:
                $string .= chr(mt_rand(48, 57)); //数字的ASCII值
                break;

            case 1:
                $string .= chr(mt_rand(65, 90)); //大写字母的ASCII值
                break;

            case 2:
                $string .= chr(mt_rand(97, 122)); //小写字母的ASCII值
                break;

            case 3:
                $string .= chr(mt_rand(0, 32));  //键盘和其他的ASCII值
                break;

            case 4:
                $string .= chr(127);    //del键盘的ASCII值
                break;

            case 5:
                $string .= chr(mt_rand(33, 47)); //符号的ASCII值
                break;

            case 6:
                $string .= chr(mt_rand(58, 64)); //符号的ASCII值
                break;

            case 7:
                $string .= chr(mt_rand(91, 96)); //符号的ASCII值
                break;

            case 8:
                $string .= chr(mt_rand(123, 126)); //符号的ASCII值
                break;

            case 9:
                $string .= chr(mt_rand(128, 255)); //符号的ASCII值
                break;

            default:
                break;
        }
    } while ($length);

    return $string;
}