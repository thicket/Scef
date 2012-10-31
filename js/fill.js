var form_submit_value = false;
var check_field = function( name ){ // 自定义过滤函数，此处默认为不过滤
	return true;
}

$(function(){
	
});

var getSerialize = function(d){
	if( form_submit_value ){
		return false;
	}
	var th;
	var val;
	var getval = new Array();
	$('#fill > li:odd').each(function(i) {
		th = $(this);
		val = th.find('input,select,textarea');
		getval.push( val.attr('name')+'='+val.val() );
		if( val.val() == '' ) {
			if( check_field( th.find(':first-child')[0].name ) ) { // 过滤用
				getval = new Array();
				th.find(':first-child').focus();
				alert( '请把 【' + th.prev().html() + '】 填写完整!' );
				form_submit_value = false;
				return false;
			}else{
				form_submit_value = true;
			}
		}else{
			form_submit_value = true;
		}
	});
	console.log(1);
	if( form_submit_value ){
		console.log(10);
		d.alt = d.alt+'&'+getval.join('&');
		tb_init(d);
		$(d).click();
	}
}