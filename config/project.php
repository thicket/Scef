<?php

/**
 * 时间设置
 */
date_default_timezone_set('Asia/Hong_Kong');


/**
 * 项目编码设定
 */
define('PROJECT_CHARSET', 'UTF-8');


/**
 * 主页标签，cookice
 * @var string
 */
define('DOMAINTAG', '夜里风飘雨，山里多蚊子。');


/**
 * 主页标签，cookice
 * @var string
 */
define('COOKIE_KEY', '项目管理');

/** ---------------------------------- 错误处理 ---------------------------------- * */
/**
 * 0不报错，-1报错
 */
error_reporting(-1);


/**
 * 0,不记录不输出
 * 1,记录到文件里面.
 * 2,直接输出页面
 * @var number
 */
define('BUG_LOG', 2);


/**
 * 0,不记录不输出
 * 1,记录到文件里面.
 * 2,直接输出页面
 * @var number
 */
define('TIPS', 2);


/** ---------------------------------- 验证 ---------------------------------- * */
/**
 * 站点域名与$_SERVER['HTTP_REFERER']对称，否则数据库不能操作
 * @var string
 */
define('HTTP_URL', '127.0.0.1');


/**
 * mysql验证用，防止直接操作
 * @var unknown_type
 */
define('SECRETKEY', 'o0/l1I8-+$');



/** ---------------------------------- 控制器 ---------------------------------- * */
/**
 * 默认的控制器
 * @var unknown_type
 */
define('DEF_CTRE', 'home');


/**
 * 默认控制器调用的方法
 * @var unknown_type
 */
define('DEF_FUNC', 'index');



/** ---------------------------------- mysql服务器设置 ---------------------------------- * */
// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //

/** 数据库的名称 */
define('DB_NAME', 'wordpress');



/** MySQL 数据库用户名 */
define('DB_USER', 'root');



/** MySQL 数据库密码 */
define('DB_PASSWORD', '123456');



/** MySQL 主机 */
define('DB_HOST', 'localhost');



/** MySQL 端口 */
define('DB_PORT', '3306');



/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');



/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');



/**
 * 是否开启数据库永久连接
 * 0关闭，1打开
 */
define('DB_PERSISTENT_CON', 0);






/** ---------------------------------- 上传文件目录设置 ---------------------------------- * */
/**
 * 上传文件路径//请使用服务器根路径
 * @var string
 */
define('UPLOADPATH', '/www/upload/');



/** ---------------------------------- 页面设置 ---------------------------------- * */
/**
 * 设置行显示量
 * @var number
 */
define('DATA_ROW', 50);



/**
 * 设置页码显示量
 * @var number
 */
define('PAGE_NUMBER', 3);

