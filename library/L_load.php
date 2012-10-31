<?php

class L_load {
	
	private $data = array();
	
	
	public function __construct(){
		$this->data = get_init_view_data();
	}
	
	public function assign( Array $data) {
		$this->data = $data;
	}
	
	
	public function view( $viewName , $type='php' )
	{
		$path = ROOT . 'view/' . $viewName . '.' . $type;
		empty( $this->data ) ? '' : extract( $this->data );
		if( dirname( $path ) ) {
			include $path;
		}else{
			return false;
		}
	}
	
	
	public function model( $modelName , $type='php' )
	{
		$path = ROOT . 'model/' . $modelName . '.' . $type;
		empty( $this->data ) ? '' : extract( $this->data );
		if( dirname( $path ) ) {
			include $path;
			return new $modelName();
		}else{
			return false;
		}
	}
	
	
}