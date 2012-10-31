<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http: //www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Language" content="zh-cn" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>demo</title>
        <script language="JavaScript" type="text/javascript" src="js/jquery-1.8.1.min.js"></script>
        <style>
            html,body,div,ul,li,ol,a,span,p{
                border: 0;
                padding: 0;
                margin: 0;
            }
            body{
                background-color: #363636;
                width: 100%;
                height: 100%;
                overflow-y: scroll;
                font-size: 12px;
                font-family: "lucida grande",tahoma,verdana,arial,sans-serif;
            }
            li,ol{
                list-style: none outside none;
            }
            a {
                color: #363636;
                text-decoration: none;
            }
            .errortips{
                text-align: center;
            }
            .box{
                width: 100%;
            }
            .blank_left{
                border-right: 10px solid #555;
                height: 100%;
                left: 0;
                position: fixed;
                top: 0;
            }
            .blank{
                background-color: #FF8A00;
                height: 100%;
                left: 30%;
                position: fixed;
                top: 0;
                width: 1px;
                z-index: 99;
            }
            .auxiliary_line{
                border-top: 1px solid #DDD;
                width: 1%;
                left: 29.5%;
                position: fixed;
                top: 0;
                z-index: 99;
            }
            nav{
                top: 0;
                height: 45px;
                position: fixed;
                padding-top: 6px;
                width: 100%;
                background-color: #717171;
                opacity: 0.01;
                border:0;
                z-index: 100;
                display: block;

                -webkit-box-shadow: 0 2px 10px #000;
                -moz-box-shadow: 0 2px 10px #000;
                box-shadow: 0 2px 10px #000;
                
                -webkit-transition: all 0.4s ease;
                -moz-transition: all 0.4s ease;
                -o-transition: all 0.4s ease;
                transition: all 0.4s ease;
                
            }
            nav:HOVER{
                opacity: 1;
                background-color: #717171;
                overflow: visible;
            }
            nav > a{
                float: right;
                height: 40px;
                line-height: 40px;
                text-align: center;
                width: 90px;
                margin-left: 10px;
                border-radius: 3px;

                -webkit-box-shadow: 0 8px 8px rgb(0,0,0);
                -moz-box-shadow: 0 8px 8px rgb(0,0,0);
                box-shadow: 0 8px 8px rgb(0,0,0);

                background-color: #363636;
                color: #929292;

                z-index: 100;

                -ms-transform: rotate(40deg);
                -moz-transform: rotate(40deg);
                -webkit-transform: rotate(40deg);
                -o-transform: rotate(40deg);
                transform: rotate(40deg);

                -webkit-transition: all 0.2s ease;
                -moz-transition: all 0.2s ease;
                -o-transition: all 0.2s ease;
                transition: all 0.2s ease;
            }
            nav:HOVER > a{
                color: #FFF;
                margin-top: 20px;

                -ms-transform: rotate(360deg) scale(1.5);
                -moz-transform: rotate(360deg) scale(1.5);
                -webkit-transform: rotate(360deg) scale(1.5);
                -o-transform: rotate(360deg) scale(1.5);
                transform: rotate(360deg) scale(1.5);
            }
            .left{
                float: left;
                height: 100%;
                overflow: hidden;
                position: fixed;
                width: 30%;
            }
            #setting{
                position: absolute;
            }
            #setting > *{
                display: none;
                -webkit-transition: all 0.5s ease;
                -moz-transition: all 0.5s ease;
                -o-transition: all 0.5s ease;
                transition: all 0.5s ease;
            }
            #setting:HOVER > *{
                display: block;
            }
            #setting > ul{
                border: 1px solid #333;
            }
            #setting > ul > li{
                cursor: pointer;
            }
            #setting > ul > li:hover{
                background-color: #666;
            }
            ul.nav{
                float: left;
                width: 30%;
                height: 100%;
                margin-top: 10px;
                
                -webkit-transition: all 0.5s ease;
                -moz-transition: all 0.5s ease;
                -o-transition: all 0.5s ease;
                transition: all 0.5s ease;
            }
            ul.nav > li > a{
                float: right;
                display: block;
                height: 90px;
                text-align: center;
                width: 20px;
                margin-right: 2%;
                border-top: 1px solid #363636;
                border-right: 1px solid #363636;
                border-left: 1px solid #363636;
                color: #363636;
                
                -webkit-transition: all 0.1s ease;
                -moz-transition: all 0.1s ease;
                -o-transition: all 0.1s ease;
                transition: all 0.1s ease;
            }
            ul.nav > li > a:HOVER{
                color: #FFF;
            }
            ul.nav > li > a.na1:HOVER,nav > a.na1:HOVER{
                background-color: #11284B;
            }
            ul.nav > li > a.na2:HOVER,nav > a.na2:HOVER{
                background-color: #404244;
            }
            ul.nav > li > a.na3:HOVER,nav > a.na3:HOVER,li > a.show_nav3{
                background-color: #84ACCD;
            }
            ul.nav > li > a.na4:HOVER,nav > a.na4:HOVER{
                background-color: #2B3944;
            }
            ul.nav > li > a.na5:HOVER,nav > a.na5:HOVER{
                background-color: #576E7F;
            }
            ul.nav > li > a.na6:HOVER,nav > a.na6:HOVER{
                background-color: #47658F;
            }
            ul.nav > li > a.na7:HOVER,nav > a.na7:HOVER{
                background-color: #53616F;
            }
            ul.nav > li > a.na8:HOVER,nav > a.na8:HOVER{
                background-color: #2C658F;
            }
            ul.nav > li > a.na9:HOVER,nav > a.na9:HOVER{
                background-color: #888C90;
            }
            ul.nav > li > a.na0:HOVER,nav > a.na0:HOVER{
                background-color: #3389CF;
            }

            ul.nav > li > a:HOVER,li > a.show_nav3{
                -ms-transform: rotate(7deg) scale(1.2);
                -moz-transform: rotate(7deg) scale(1.2);
                -webkit-transform: rotate(7deg) scale(1.2);
                -o-transform: rotate(7deg) scale(1.2);
                transform: rotate(7deg) scale(1.2);
            }

            /*--------------------------- right ---------------------------*/
            
            .right{
                width: 70%;
                float: right;
                overflow: hidden;
                margin-top: 100px;
            }
            .right > .list > .box_model{
                padding-bottom: 100px;
                overflow: hidden;
            }
            .right > .list > .box_model > .article{
                padding-left: 100px;
            }
            .right > .list > .box_model > .article:HOVER{
                color: #929292;
                
                text-shadow: 1px 1px 1px #333;
                -webkit-transition: color .25s linear;
                transition: color .25s linear;
            }
            .right > .list > .box_model > .article > header{
                padding-bottom: 20px;
                height:2em;
                cursor: pointer;
            }
            .right > .list > .box_model > .article > header > p{
                border-top: 0;
                border-left: 1px solid #39BBD2;
                margin-bottom: 10px;
            }
            .right > .list > .box_model > .article > header > strong{
                color: #0099CC;
                font-size: 20px;
                text-shadow: 1px 1px 1px #111111;
            }
            .right > .list > .box_model > .box_signs{
                float: left;
            }
            .right > .list > .box_model > .box_signs span{
                background-color: #0099CC;
                box-shadow: 1px 1px 2px black;
                display: block;
                float: left;
                height: 10px;
                margin-top: 6px;
                width: 10px;
            }
            .right > .list > .box_model > .box_signs strong{
                color: #AAAAAA;
                display: block;
                font-weight: normal;
                margin: 1px 0 0 15px;
                padding: 1px 4px 0;
                text-shadow: 1px 1px 1px #929292;
            }
            .right > .list > .box_model > .box_tools{
                margin-top:30px;
                margin-left:50px;
                margin-right:50px;
                overflow: hidden;
                border-top: 1px dashed #202020;
                border-bottom: 1px dashed #202020;
            }
            .right > .list > .box_model > .box_tools > p{
                overflow: hidden;
            }
            .right > .list > .box_model > .box_tools > p > strong{
                width: 50px;
                padding: 10px;
                display: block;
                float: left;
            }
            .right > .list > .box_model > .box_tools > p > a{
                color: #666666;
                display: block;
                float: left;
                padding: 10px;
                text-shadow: 1px 1px 0 #111111;
            }
            .right .hide{
                display: none;
            }
            
            
            .etc_opacity_001{
                opacity: 0.01;
            }
            .etc_opacity_1{
                opacity: 1;
            }
        </style>
        
        
        
        
        <script type="text/javascript"> 
            var s = {
                setting : 0,
                article : 1,
                nav : 0,
                timer : 0,
                $str : ''
            }
            function initialize(){ 
                s.timer=setInterval("BottomScrollWindow()",200);
            }
            function sc(){
                clearInterval(s.timer);
            }
            function TopScrollWindow(){ 
                window.scrollBy(0,-(document.body.clientWidth/10) );
            }
            function BottomScrollWindow(){ 
                window.scrollBy(0,1);
            }
            document.onmousedown = sc;
            document.ondblclick = initialize;

            var oevent = function(e){
                return e || window.event;
            }
            
            $(window).mousemove(function(e){
                s.$str = '';
                s.$str += "<br/>oevent(e).clientY: " + oevent(e).clientY;
                s.$str += "<br/>oevent(e).layerY: " + oevent(e).layerY;
                s.$str += "<br/>oevent(e).pageY: " + oevent(e).pageY;
                s.$str += "<br/>oevent(e).screenY: " + oevent(e).screenY;
	
                $('.auxiliary_line').css('top',oevent(e).clientY);
            });

            function detectBrowser(){
                //	var browser=navigator.appName
                var b_version=navigator.appVersion
                //	var version=parseFloat(b_version)
                /*alert(browser);alert(b_version);alert(version);console.log(b_version.match(/MSIE (\d)/i) == null);*/
                if (b_version.match(/MSIE (\d)/i) == null){
                    return true;
                }else{
                    if((b_version.match(/MSIE (\d)/i)[1]) >= 9){
                        return true;
                    }
                }
                document.body.innerHTML = ("<h1 class='errortips'>It's time to upgrade your browser!</br>Please Use : IE >= 9 or firefox or Chrome or Opera</h1>");
            }
            
            function navToggle(){
                if(s.nav){
                    $('nav').removeClass( 'etc_opacity_1');
                    $('nav').addClass( 'etc_opacity_001');
                    s.nav = 0;
                    $('#setting li.nav span').text('保持显示');
                }else{
                    $('nav').removeClass( 'etc_opacity_001');
                    $('nav').addClass( 'etc_opacity_1');
                    s.nav = 1;
                    $('#setting li.nav span').text('隐藏');
                }
            }
            function articleToggle(d){
                switch(d){
                    case 0:
                        $('.article article').hide(1300);
                        s.article = 1;
                        $('#setting li.article span').text('展开');
                        break;
                    case 1:
                        $('.article article').show(1300);
                        s.article = 0;
                        $('#setting li.article span').text('折叠');
                        break;
                    default:
                        $d = $(d).next();
                        if($d.css('display') == 'block'){
							$d.hide(500);
                        }else{
                            $d.show(500);
                        }
                        break;
                }
            }

            function rightClear(){
                $("div.blank").animate( { left: '80%' }, { queue: false, duration: 500 } )
                .animate( { width: '1px' }, { queue: false, duration: 500 } )
                .animate( { top: '0px' }, { queue: false, duration: 500 } )
                .animate( { height: '1px' }, 500 )
                .animate( { height: '100%' }, 300);
	
                $("div.auxiliary_line").animate( { left: "79.5%"}, 1000 );
	
                $("div.list").animate({
                    height: '100%', opacity: 1
                }, {
                    duration: "slow" 
                });
	
                $('div.right').animate( { width: "100%"}, 400, 'linear', function (){$('div.right').css('float', 'left')}).animate( { width: '70%' }, 200 );
                //$('div.right').animate( { width: "100%"}, 200 ).delay(200).css('float', 'left').animate( { width: '70%' }, 200 );
                //.css('float', 'left')
                //.animate( { width: '70%' }, { queue: false, duration: 200 } );
	
                //$('.nav').show();
        
                $('nav').animate( { height: "45px"}, 500 );
                $('nav').css( 'opacity', '');
	
                $('nav > a').animate( { height: "40px"}, { queue: false, duration: 500 } )
                .animate( { 'lineHeight': '40px' }, 500 );
	
                //$("div.left").css('height','100%');
            }

            function rightShow(){
                $("div.blank").animate( { left: "30%" }, { queue: false, duration: 400 } )
                .animate( { width: '1px' }, { queue: false, duration: 400 } )
                .animate( { height: '1px' }, 400 );
	
                $("div.blank").animate( { top: window.innerHeight+'px' }, 250 )
                .animate( { height: '100%' }, 1 )
                .animate( { top: '0px' }, 350);
	
                $("div.auxiliary_line").animate( { left: "29.5%"}, 1000 );
	
                $("div.list").animate({
                    height: '100%', opacity: 1
                }, {
                    duration: "slow" 
                });
	
                $('div.right').animate( { width: "100%"}, 200, 'linear', function (){$('div.right').css('float', 'right')}).animate( { width: '70%' }, 400 );
	
                //$('.nav').show();
        
                $('nav').animate( { height: "45px"}, 500 );
                $('nav').css( 'opacity', '');
	
                $('nav > a').animate( { height: "40px"}, { queue: false, duration: 500 } )
                .animate( { 'lineHeight': '40px' }, 500 );
	
                //$("div.left").css('height','100%');
            }

            function topShow(){
                $("div.blank").animate( { left: '0%' }, { queue: false, duration: 500 } )
                .animate( { height: '1px' }, { queue: false, duration: 500 } )
                .animate( { top: '0px' }, 500 )
                .animate( { width: window.innerWidth+'px' }, 500 );
	
                $("div.auxiliary_line").animate( { left: "99%"}, 1000 );
	
                $('div.right').animate( { width: "100%"}, 500, 'linear', function (){$('div.right').css('float', 'right')});
                
                //$('.nav').hide();
	
                $('nav').animate( { height: "5px"}, 500 );
                $('nav').css( 'opacity', '');
	
                $('nav > a').animate( { height: "90px"}, { queue: false, duration: 500 } )
                .animate( { 'lineHeight': '90px' }, 500 );
	
                //$("div.left").css('height','auto');
            }
            
            function blodShow(){
                $("div.blank").animate( { left: '0%' }, { queue: false, duration: 500 } )
                .animate( { height: '1px' }, { queue: false, duration: 500 } )
                .animate( { top: '5px' }, 500 )
                .animate( { width: 1+'px' }, 500 );
	
                $("div.auxiliary_line").animate( { left: "99%"}, 1000 );
	
                $('div.right').animate( { width: "100%"}, 500, 'linear', function (){$('div.right').css('float', 'right')});
	
                //$('.nav').show();
                
                $('nav').animate( { height: "95px"}, 500 );
                $('nav').css( 'opacity', 1);
                
                $('nav > a').animate( { height: "90px"}, { queue: false, duration: 500 } )
                .animate( { 'lineHeight': '90px' }, 500 );
	
                //$("div.left").css('height','auto');
            }

            $(function(){
                $('.box_model').mouseover(function(){
                    //$(this).find('.box_signs').attr('style','-ms-transform:rotate(7deg);-moz-transform:rotate(7deg);-webkit-transform:rotate(7deg);-o-transform:rotate(7deg;transform:rotate(7deg)');
                });
                $('.box_model').mouseout(function(){
                    $(this).find('.box_signs').css('-ms-transform','');
                    $(this).find('.box_signs').css('-moz-transform','');
                    $(this).find('.box_signs').css('-webkit-transform','');
                    $(this).find('.box_signs').css('-o-transform','');
                    $(this).find('.box_signs').css('transform','');
                });
                /*太慢了
                $_list = $('.list');
                $('.nav>li>a').mouseover(function(){
                    $('.'+this.name).show();
                    $_list.css('display','none');
                });
                $('.nav>li>a').mouseout(function(){
                    $('.'+this.name).hide();
                    $_list.css('display','block');
                });*/
        
            });


        </script>

    </head>
    
<script type="text/javascript">
 $(document).ready(function(){
  $("#jquery_jplayer_1").jPlayer({
   ready: function () {
    $(this).jPlayer("setMedia", {
     m4a: "/media/mysound.mp4",
     oga: "/media/a.ogg"
    });
   },
   swfPath: "/js/jQuery.jPlayer.2.1.0",
   supplied: "m4a, oga"
  });
 });
</script>
    <br></br><br></br><br></br><br></br>
<div id="jquery_jplayer_1"></div>
<div id="jp_container_1">
 <a href="#" class="jp-play">Play</a>
 <a href="#" class="jp-pause">Pause</a>
</div>

<script language="JavaScript" type="text/javascript" src="js/jQuery.jPlayer.2.1.0/jquery.jplayer.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/jQuery.jPlayer.2.1.0/add-on/jquery.playlist.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/jQuery.jPlayer.2.1.0/add-on/jquery.jplayer.inspector.js"></script>