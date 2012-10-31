<?php

function index() {

    if (empty($_POST['login_uid']) && empty($_POST['login_passwd'])) {
        url_jump('?home');
    }

    $uid = preg_match('/^\w+$/i', $_POST['login_uid']) ? $_POST['login_uid'] : '';
    $pass = preg_match('/^\w+$/i', $_POST['login_passwd']) ? $_POST['login_passwd'] : '';

    include_once 'model/member.php';

    $member = new member();
    $member->set_field(' member_seq , uid , uname ');
    $member->set_where(' del_flag=0 AND uid=\'' . $uid . '\' AND ' . 'passwd=\'' . md5($pass) . '\'');
    $result = $member->appGetOneData();

    if (empty($result)) {
        alert('没有这个用户，或者输入数据错误。');
        back();
        die;
    } else {
        $key = sha1($uid . $pass);
        $_SESSION['login'][$key] = $result;
        setcookie($key, json_encode($result));
        setcookie(DOMAINTAG, $key);
        url_jump($_SERVER['REQUEST_URI']);
        die;
    }
}

function logout() {
    session_unset();
    empty($_COOKIE[DOMAINTAG]) ? '' : setcookie($_COOKIE[DOMAINTAG], '', -1);
    setcookie(DOMAINTAG, '', -1);
    url_jump('?home');
}