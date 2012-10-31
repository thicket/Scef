<?php

function index() {

    include_once 'model/posts.php';
    include_once 'model/debug.php';
    include_once 'model/task.php';

    $postDb = new posts();

    $postDb->setDataRow(30);
    $data = get_init_view_data();
    $data['posts'] = $postDb->getPage();
    
    $postKey = array_keys($data['posts']);
    $tag = $postDb->getTag($postKey);
    $cate = $postDb->getCate($postKey);
    //$linkcate = $postDb->getLinkCate($postKey);
    
    foreach($data['posts'] as $k=>$v){
        $data['posts'][$k]['tags'] = empty($tag[$k])?array():$tag[$k];
        $data['posts'][$k]['cate'] = empty($cate[$k])?array():$cate[$k];
    }
    //print_r($data['posts'][3]['cate'][0]);die;
    $need = '';
    $event = '';
    $status = 'list';
    
    return array(
                'data'=>$data, //数据输出
                'need'=>$need, //对页面的需求
                'event'=>$event, //需要通知页面做什么事
                'status'=>$status, //页面状态
                'p_t'=>'life' //页面标签
            );
}

