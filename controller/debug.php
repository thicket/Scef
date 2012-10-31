<?php


function index() {
	global $query_string;

	include_once 'model/debug.php';
	$model		= new debug();
	$data		= get_url();
	$data_row	= DATA_ROW;
	$page		= empty($query_string) ? 0 : (int)(is_array( $query_string ) ? array_shift( $query_string ) : 0);
	$path		= '?'.CTRE.'/'.__FUNCTION__.'/';
	
	$model->setDataRow( $data_row );
	$model->set_where( ' del_flag=0 ' );
	$total_row	= $model->appGetTotalNumber();
	
	$model->set_field( 'debug_seq,domain,level,status,update_time' );
	$data['list']		= $model->getPage( $page );
	$data['page_url']	= empty( $data['list'] ) ? array() : subPage( $total_row , $data_row , $page , $path );
	
	return $data;
}



function fill() {
	return get_url();
}



function insert() {
	
	include_once 'model/debug.php';
	$model	= new debug();

	try {
		$data = $model->chk_insert();
	} catch (Exception $e) {
		echo($e->getMessage());
		die;
	}

	$model->insert($data);

	if( $model->query() ) {
		echo('ok');
	}else{
		echo('网络延迟');
	}
}



function edit() {
	global $query_string;
	
	include_once 'model/debug.php';
	$model	= new debug();
	$id		= (int) array_shift($query_string);

	$model->set_field( '*' );
	$model->set_where( 'del_flag=0 AND debug_seq='.$id );
	$model->select();
	$model->query();

	$data = $model->fetch_array();
	$data = array_shift($data);

	if( $data ) {
		$url = get_url();
		unset( $url['insert'] );
		$data = array_merge( $data , $url );

		if( !empty( $data ) ) {
			$data['static'] = 1;
			return $data;
		}
	}else{
		echo( '请联系管理员' );
		die;
	}
}



function update() {

	include_once 'model/debug.php';
	$model	= new debug();

	$id = chk_input('seq');

	try {
		$model->set_where( 'del_flag=0 AND debug_seq='.$id );
		$data = $model->chk_update();
	} catch (Exception $e) {
		echo($e->getMessage());
	}

	$model->update($data);

	if( $model->query() ) {
		echo('ok');
	}else{
		echo('网络延迟');
	}
}



function delete() {
	global $query_string;

	include_once 'model/debug.php';
	$model	= new debug();

	$id		= array_shift($query_string);

	$model->set_where( 'del_flag=0 AND debug_seq='.$id );
	$model->delete();

	if( $model->query() ) {
		echo('删除成功');
	}else{
		echo( '请联系管理员' );
	}
}



?>
