<?php

class news extends L_mysql{
	
	public $data = array();
	public $dataRow = 0;
	
	function __construct(){
		parent::__construct();
		$this->init( 'news' );
		$this->dataRow = 30;
	}
	
	public function chk_insert() {
		$data['title']		= chk_input( 'title' , 'post' );
		$data['author']		= chk_input( 'author' , 'post' );
		$data['type']		= chk_input( 'type' , 'post' );
		$data['status']		= chk_input( 'status' , 'post' );
		$data['content']	= chk_input( 'content' , 'post' );
		
		$cnt	= count( $data );
		$data	= array_filter( $data );
		
		if( empty( $data ) || ($cnt != count($data)) ) {
			throw new Exception('请把数据填写完整');
		}
		
		$data	= chk_str_to_sql( $data );
		
		$data['create_time']= 'NOW()';
		
		return $data;
	}
	
	public function chk_update() {
		$data['title']		= chk_input( 'title' , 'post' );
		$data['author']		= chk_input( 'author' , 'post' );
		$data['type']		= chk_input( 'type' , 'post' );
		$data['status']		= chk_input( 'status' , 'post' );
		$data['content']	= chk_input( 'content' , 'post' );
		
		$data = array_filter( $data );
		
		if( empty( $data ) ) {
			throw new Exception('请把数据填写完整');
		}
		
		$data	= chk_str_to_sql( $data );
		
		return $data;
	}
	
	
	
	/**
	 * 获取提供分页的数据
	 */
	public function getPage( $index=0 ) {
		$this->set_limit( ' LIMIT '.$index * $this->dataRow . ',' . $this->dataRow );
		$this->select();
		$this->query();
		return $this->fetch_array();
	}
	
	
	
	/**
	 * 设置行
	 */
	public function setDataRow( $dataRow ){
		$this->dataRow = $dataRow;
	}
	
}