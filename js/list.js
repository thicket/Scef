$(function(){
	//$('table tr:nth-child(even)').css('background','#ddd');
});

var ind	= 0;
var ula;
var wul	= 0;
var ul	= 0;
var dct;
var wtb	= 0;
var tb	= 0;
var sta	= true;
var t;
/*
var show_hal = function(inds){
	ind = inds;
	ula = $('ul.action');
	wul = 19/ind;
	dct = $('div#content > table');
	wtb = 20/ind;
	sta = ula.css('display') == 'none';
	tb	= 0;
	ul	= 0;
	s();
}
//$('div#content table tr').find('>:last').show(100);
var s = function(){
	if( sta ) {
		tb = tb+wtb;
		ul = ul+wul;
		
		$('div#content > table').css('width',(100-tb)+'%');
		$('ul.action').css('width',(0+ul)+'%');
		ind--;
		
		if( ind < 0 ){
			dct.css('width','80%');
			ula.css('width','19%');
			clearTimeout(t);
		}else{
			t = setTimeout('s()',1);
		}
		ula.css('display','block');
	}else{
		tb = tb+wtb;
		ul = ul+wul;
		
		$('div#content > table').css('width',(80+tb)+'%');
		$('ul.action').css('width',(19-ul)+'%');
		ind--;
		
		if( ind < 0 ){
			dct.css('width','100%');
			ula.css('width','0%');
			ula.css('display','none');
			clearTimeout(t);
		}else{
			t = setTimeout('s()',1);
		}
	}
}*/