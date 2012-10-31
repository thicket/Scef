$(function(){
	$('#check').click(function(d) {
	    $('#content > table tr > td > input[type="checkbox"]').each(function(d) {
	        if( $('#check:checked').length ) {
	            this.checked = true;
	        }else{
	            this.checked = false;
	        }
	    });
	});
	
	$('#edit').click(function() {
		if( $('#content > div.table > table tr > td > input:checked').length == 1 ) {
			$(this).attr( 'href' , $(this).attr('url')+$('#content > div.table > table tr > td > input:checked').val() );
			if( $(this).attr( 'class' ) != 'thickbox' ) {
				$(this).attr( 'class' , 'thickbox' );
				tb_init(this);
				$('#edit').click();
			}
		}else{
			$(this).attr( 'href' , 'javascript:void(0);return false;' );
			alert('请选择一个要编辑的项目');
		}
		return false;
	});
	
	var delArr;
	$('#delete').click(function(d) {
		delArr = new Array();
		if( $('#content > table tr > td > input:checked').length ) {
			$('#content > table tr > td > input:checked').each(function(d) {
				delArr.push( this.value );
			});
			if( confirm( '是否删除共 '+delArr.length+' 个项目' ) ) {
				$('#delete').attr( 'href' , $('#delete').attr('url')+delArr.join(',') );
			}
		}else{
			alert('请选择要删除的项目');
		}
	});
	
});

function full(){
	$('#content').attr('class','full');
	$('#unfull').css('display','block');
	$('#full').css('display','none');
}

function unfull(){
	$('#content').attr('class','unfull');
	$('#full').css('display','block');
	$('#unfull').css('display','none');
}