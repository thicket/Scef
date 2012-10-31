<?php

class debug extends L_mysql{
	
	public $data = array();
	public $dataRow = 0;
	
	function __construct(){
		parent::__construct();
		$this->init( 'debug' );
		$this->dataRow = 30;
	}
	
	public function chk_insert() {
		$data['domain']		= chk_input( 'domain' , 'post' );
		$data['status']		= chk_input( 'status' , 'post' );
		$data['level']		= chk_input( 'level' , 'post' );
		$data['status']		= chk_input( 'status' , 'post' );
		$data['descripton']	= chk_input( 'descripton' , 'post' );
		
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
		$data['domain']		= chk_input( 'domain' , 'post' );
		$data['status']		= chk_input( 'status' , 'post' );
		$data['level']		= chk_input( 'level' , 'post' );
		$data['status']		= chk_input( 'status' , 'post' );
		$data['descripton']	= chk_input( 'descripton' , 'post' );
		
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