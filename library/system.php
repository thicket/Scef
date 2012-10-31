<?php

/**
 * 仅适合此系统的函数
 */



/**
 × 信息处理
 */
function infoHandler( $msg , $num ){
	switch( $num ){
		case 1:
			tipsType( $msg );
		break;
		default:
		break;
	}
}


/**
 * 提示类型
 */
function tipsType( $msg , $type='' ){
	switch( $type ){
		case '':
		break;
		default:
			echo '<script>alert('.$msg.');</script>';
		break;
	}
}



/**
 * 自定义错误
 */



/**
 * 分页
 * @param number $total_row
 * @param number $data_row
 * @param number $page
 * @param string $path
 * @param number $page_number
 * @return multitype:string
 */
function subPage( $total_row , $data_row , $page , $path , $page_number=2 ) {
	$offset			= 0;
	$index			= 0; 
	$stop			= 0;
	$page_url		= array();
	$page_html		= array();
	$total_page		= $total_row / $data_row - 1;
	
	if( preg_match( '/\./' , $total_page ) ) {
		$total_page = abs( ceil($total_page) );
	}
	
	if( $total_page < $page ) {
		return FALSE;
	}
	
	$offset	= $page + $page_number;
	$stop	= $page - $page_number;

	$offset	= abs( $offset > $total_page ? $total_page : $offset );
	$stop	= abs( $stop < 0 ? 0 : $stop );
	$index	= $offset;
	
	while( $index >= $stop ) {
		$page_html[$index] = '<a href="'.$path.$index.'" '.($index == $page ? 'class="number current"':'class="number"').'>'.($index+1).'</a>';
		$index--;
	}

	ksort($page_html);

	$trans		= array('class="number"' => '');
	$page_url	= $page_html;

	empty($page) ? '' : array_unshift( $page_html , strtr( preg_replace( '/([^>]+>)\d+/' , '\1 &laquo; 上一页' , $page_url[ empty($page) ? 0 : $page-1 ] ) , $trans ) );
	$page >= $total_page ? '' : array_push( $page_html , strtr( preg_replace( '/([^>]+>)\d+/' , '\1 下一页  &raquo;' , $page_url[ empty( $page ) ? ($total_page?1:0) : (($page+1)<=$total_page?$page+1:$total_page) ] ) , $trans ) );

	array_unshift( $page_html , '<a href="'.$path.'0" >首页</a>' );
	array_push( $page_html , '<a href="'.$path.$total_page.'" >尾页</a>' );
	return $page_html;
}



/**
 * 上传文件
 * @param string $path
 * @param array $fileType
 * @throws Exception
 */
function upLoadFile( $path , $fileType ) {
	$fileInfo	= array();
	$uploadpath = realpath( $path ).'/';
	
	if( realpath( $uploadpath ) == false ) {
		throw new Exception( '上传路径不存在 ' );
	}
	
	foreach( $_FILES as $file ) {
		
    	switch( $file['error'] ) {
    		case 0: if( empty( $file['size'] ) ) throw new Exception( '没有文件被上传 ' , 4 ); break;						//没有错误发生，文件上传成功。
    		case 1: throw new Exception( '上传的文件超过了大小 Return Code: ' . $file['error'] , $file['error'] ); break;	//上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。
    		case 2: throw new Exception( '上传的文件超过了大小 Return Code: ' . $file['error'] , $file['error'] ); break;	//上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。 
    		case 3: throw new Exception( '文件只有部分被上传 Return Code: ' . $file['error'] , $file['error'] ); break;	//文件只有部分被上传。
    		case 4: throw new Exception( '没有文件被上传 Return Code: ' . $file['error'] , $file['error'] ); break;		//没有文件被上传。
    		case 5: throw new Exception( '服务器临时文件夹丢失，请重新上传！' . $file['error'] , $file['error'] ); break;	//服务器临时文件夹丢失
			case 6:	throw new Exception( '文件写入到临时文件夹出错！' . $file['error'] , $file['error'] ); break;			// 文件写入到临时文件夹出错
    		default: throw new Exception( '发生不可预料的情况' , -1); break;
    	}
    	
    	if( array_search( $file["type"] , $fileType ) === FALSE ) {
    		throw new Exception( '只允许：'.str_replace( 'image/' , '', join( ',' , $fileType ) ) , -20 );
    	}
    	
    	if( !is_uploaded_file( $file['tmp_name'] ) ) {
    		throw new Exception( '非法文件' , -100);
    	}
    	
		$info['type']	= substr( $file['name'] , strripos($file['name'] , '.')+1 , strlen($file['name']) );
		$info['name']	= md5(time());
		$info['path']	= $path . $info['name'] . '.' . $info['type'];
		
		if( move_uploaded_file( $file['tmp_name'] , $uploadpath . $info['name'] . '.' . $info['type'] ) ) {
			$fileInfo[] = $info;
		}else{
			foreach( $fileInfo as $val ) {
				is_file( $val['path'] ) ? unlink( $val['path'] ) : '';
			}
			throw new Exception( '发生不可预料的情况，文件上传失败' , -2);
		}
	}
	return $fileInfo;
}



