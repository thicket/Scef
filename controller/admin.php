<?php


function index() {
	global $load , $query_string;

	include_once 'model/admin.php';
	$model		= new admin();
	$data		= get_url();
	$data_row	= DATA_ROW;
	$page		= empty($query_string) ? 0 : (int)(is_array( $query_string ) ? array_shift( $query_string ) : 0);
	$path		= '?'.CTRE.'/'.__FUNCTION__.'/';
	
	$model->setDataRow( $data_row );
	$model->set_where( ' del_flag=0 ' );
	$total_row	= $model->appGetTotalNumber();
	
	$model->set_field( 'admin_seq,title,author,update_time' );
	$data['list']		= $model->getPage( $page );
	$data['page_url']	= empty( $data['list'] ) ? array() : subPage( $total_row , $data_row , $page , $path );

	return $data;
}



function fill() {
	return get_url();
}



function insert() {
	
	include_once 'model/admin.php';
	$model	= new admin();

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
	global $load , $query_string;
	
	include_once 'model/admin.php';
	$model	= new admin();
	$id		= (int) array_shift($query_string);

	$model->set_field( '*' );
	$model->set_where( 'del_flag=0 AND admin_seq='.$id );
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

	include_once 'model/admin.php';
	$model	= new admin();

	$id = chk_input('seq');

	try {
		$model->set_where( 'del_flag=0 AND admin_seq='.$id );
		$data = $model->chk_update();
	} catch (Exception $e) {
		alert($e->getMessage());
		back();
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
	global $query_string;

	include_once 'model/admin.php';
	$model	= new admin();

	$id		= array_shift($query_string);

	$model->set_where( 'del_flag=0 AND admin_seq='.$id );
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



?>
