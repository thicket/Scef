<?php

function index() {
	global $load,$query_string;
	
	include_once 'model/member.php';
	$model		= new member();
	$data		= get_url();
	$data_row	= DATA_ROW;
	$page		= empty($query_string) ? 0 : (int)(is_array( $query_string ) ? array_shift( $query_string ) : 0);
	$path		= '?'.CTRE.'/'.__FUNCTION__.'/';
	
	$model->setDataRow( $data_row );
	$model->set_where( ' del_flag=0 ' );
	$total_row	= $model->appGetTotalNumber();
	
	$data['list']		= $model->getPage( $page );
	$data['page_url']	= empty( $data['list'] ) ? array() : subPage( $total_row , $data_row , $page , $path );
	
	return $data;
}



function checkName() {
	include_once 'model/member.php';
	$model	= new member();
	$uid = preg_match( '/^[a-z]\w+$/i' , $_POST['uid'] ) ? $_POST['uid'] : '';
	
	if( empty( $uid ) || ( strlen( $uid ) >= 20 ) ) {
		echo json_encode(array('msg'=>'必须以英文开头，后面可以是英文数字和下划线，不得超过20个字符'));
		die;
	}
	
	$model->set_field( 'count(*) cnt' );
	$model->set_where( 'del_flag=0 AND uid=\''.$uid.'\'' );
	echo json_encode($model->appGetOneData());
}
	
	

function fill() {
	return get_url();
}



function insert() {
	
	include_once 'model/member.php';
	$model	= new member();
	
	try {
		$data = $model->chk_insert();
	} catch (Exception $e) {
		alert($e->getMessage());
		url_jump('?'.CTRE);
		die;
	}
	
	$model->insert($data);
	
	if( $model->query() ) {
		alert('ok');
		url_jump('?'.CTRE);
		die;
	}else{
		alert('网络延迟');
		back();
		die;
	}
}



function edit() {
	global $load,$query_string;
	
	include_once 'model/member.php';
	$model	= new member();
	
	$id		= (int) array_shift($query_string);
	
	$model->set_field( '*' );
	$model->set_where( 'del_flag=0 AND member_seq='.$id );
	$model->select();
	$model->query();
	
	$data = $model->fetch_array();
	$data = array_shift($data);
	
	if( $data ) {
		$url = get_url();
		unset( $url['insert'] );
		$data = array_merge( $data , $url );
		
		if( !empty( $data ) ) {
			return $data;
		}
	}else{
		alert( '请联系管理员' );
		back();
		die;
	}
}



function update() {
	
	include_once 'model/member.php';
	$model	= new member();
	
	$id = chk_input('seq');
	
	try {
		$model->set_where( 'del_flag=0 AND member_seq='.$id );
		$data = $model->chk_update();
	} catch (Exception $e) {
		alert($e->getMessage());
		url_jump('?'.CTRE);
		die;
	}
	
	$model->update($data);
	
	if( $model->query() ) {
		alert('ok');
		url_jump('?'.CTRE);
		die;
	}else{
		alert('网络延迟');
		back();
		die;
	}
}



function delete() {
	global $load,$query_string;
	
	include_once 'model/member.php';
	$model	= new member();
	
	$id		= array_shift($query_string);
	
	$model->set_where( 'del_flag=0 AND member_seq in('.$id.')' );
	$model->delete();
	
	if( $model->query() ) {
		alert('删除成功');
		url_jump( '?'.CTRE );
		die;
	}else{
		alert( '请联系管理员' );
		back();
		die;
	}
}



