<?php

class member extends L_mysql{
	
	public $dataRow = 0;
	
	function __construct(){
		parent::__construct();
		$this->init( 'member' );
		$this->dataRow = 30;
	}
	
	public function chk_insert()
	{
		$data['uid']		= preg_match( '/^[a-z]\w+$/i' , $_POST['uid'] ) ? $_POST['uid'] : '';
		$data['uname']		= chk_input( 'uname' , 'post' );
		$data['passwd']		= preg_match( '/^\w+$/i' , $_POST['passwd'] ) ? $_POST['passwd'] : '';
		$data['repasswd']	= preg_match( '/^\w+$/i' , $_POST['repasswd'] ) ? $_POST['repasswd'] : '';
		
		$cnt	= count( $data );
		$data	= array_filter( $data );
		
		if( empty( $data ) || ($cnt != count($data)) ) {
			throw new Exception('请把数据填写完整');
		}
		
		if( empty( $data['passwd'] ) || empty( $data['repasswd'] ) ) {
			throw new Exception('请输入两次密码');
		}else{
			if( ($data['passwd'] == $data['repasswd']) ) {
				$data['passwd'] = md5( $data['passwd'] );
				unset($data['repasswd']);
			}else{
				throw new Exception('两次密码填写不一致');
			}
		}
		
		$data	= chk_str_to_sql( $data );
		
		$data['create_time']= 'NOW()';
		
		return $data;
	}
	
	public function chk_update()
	{
		$data['uname']		= chk_input( 'uname' , 'post' );
		$data['passwd']		= chk_input( 'passwd' , 'post' );
		$data['repasswd']	= chk_input( 'repasswd' , 'post' );
		
		$data = array_filter( $data );
		
		if( empty( $data ) ) {
			throw new Exception('请把数据填写完整');
		}
		
		if( empty( $data['passwd'] ) || empty( $data['repasswd'] ) ) {
			
			if( empty( $data['passwd'] ) && empty( $data['repasswd'] ) ) {
				if( isset( $data['passwd'] ) ) {
					unset($data['passwd']);
				}
				if( isset( $data['repasswd'] ) ) {
					unset($data['repasswd']);
				}
			}else{
				throw new Exception('两次密码填写不一致');
			}
		}else{
			if( ($data['passwd'] == $data['repasswd']) ) {
				$data['passwd'] = md5( $data['passwd'] );
				unset($data['repasswd']);
			}else{
				throw new Exception('两次密码填写不一致');
			}
		}
		
		$data	= chk_str_to_sql( $data );
		
		return $data;
	}
	
	
	
	/**
	 * 获取提供分页的数据
	 */
	public function getPage( $index=0 )
	{
		$this->set_field( '*' );
		$this->set_where( 'del_flag=0' );
		$this->set_order( ' ORDER BY member_seq ' );
		$this->set_limit( ' LIMIT '.$index * $this->dataRow . ',' . $this->dataRow );
		$this->select();
		$this->query();
		return $this->fetch_array();
	}
	
	
	
	/**
	 * 设置行
	 */
	public function setDataRow( $dataRow )
	{
		$this->dataRow = $dataRow;
	}
	
}