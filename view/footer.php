
</html>

<script type="text/javascript">
    var arr = new Array();
    var $win = $(window);
    var $body = $("body");
    var $html = "";
    var scroll_top = 0;
    var box_signs_top = 0;
    var index = 'undefined';

    function insertcode() {
        $body.append('<div style=\" height:1000px; font-size:24px;\"></div>')
        $("#page_tag_load").hide();
    }
    $(document).ready(function () {
        $('.right div.box_signs>span').each(function(i){
            arr.push($(this));
        });
        $win.scroll(function () {
            /*$html = '';
                $html += "<br/>" + ($win.height() + $win.scrollTop());
                $html += "<br/>window.height: " + $win.height();
                $html += "<br/>body.height: " + $body.height();
                $html += "<br/>window.scrollTop: " + $win.scrollTop();
                for( i in arr ){
                        $html += "<br/>span-"+i+": " + arr[i].position().top+'-'+arr[i].offset().top+'-'+arr[i].scrollTop()+'-'+scroll_top;
                }
                $("#page_tag_bottom").html($html+$str);*/
            /*判断窗体高度与竖向滚动位移大小相加 是否 超过内容页高度*/
            if (($win.height() + $win.scrollTop()) >= $body.height()) {
                $("#page_tag_load").show();
                //setTimeout(insertcode, 1000);/*IE 不支持*/
                insertcode();
            }
            for( i in arr ) {
                i = Number(i);
			
                if( (arr[i].position().top <= $win.scrollTop() && arr[i].parent().css('position') != 'fixed') || box_signs_top > $win.scrollTop() ) {
				
                    if( !isNaN( parseInt(index) ) ){
                        arr[index].parent().css('position','static');
                        arr[index].parent().css('top','auto');
                    }
				
                    if( $win.scrollTop() > 100 ){
                        box_signs_top = arr[i].position().top;
                        index = i;
                        arr[i].parent().css('position','fixed');
                        arr[i].parent().css('top','0');
                    }
                    //console.log(i);
                }
            }
        });
    });
</script>
<div id="page_tag_bottom" style=" width:0%;height:0%; position:fixed; left:5%; bottom:0px; background-color:#cccccc;"></div>
<div id="page_tag_load" style=" display:none; font-size:14px;position:fixed; bottom:0px; background-color:#cccccc;height:50px;">加载中...</div>