<!--footer块代码=======================================================-->
<footer class="zw_footer">
    <div class="zw_footer_top">
        <div class="container"> <a href="http://www.gufe.edu.cn" target="_blank">贵州财经大学</a> | <a href="http://www.gzu.edu.cn" target="_blank"> 贵州大学</a> | <a href="">师大</a> |<a href=""> 贵阳医学院</a> | <a href="">贵州民族大学</a> |<a href=""> 贵阳中医学院</a> |<a href=""> 贵阳学院</a> | <a href="">贵州警官职业学院</a> </div>
    </div>
    <div style="border-top: 1px solid rgb(79, 78, 78); text-align:center; padding:20px 0; font-size:12px">We Are Young<br>
        Made by 赵昱，赵伟<br>
        ©2013 贵州找工作 &emsp;<a title="网站建设、品牌营销策划、网页设计、互动网站建设" target="_blank" href="http://freedomdream.cn"> 畅想工作室 </a></div>
</footer>
<!--footer模块代码=======================================================-->

<!-- 链接jquery.js网络文件 -->
<script src="https://code.jquery.com/jquery.js"></script>
<!-- 链接bootstrap.js文件 -->
<script src="resource/bootstrap/js/bootstrap.js"></script>
<!-- 自己写的.js文件 -->
<script src="resource/common/js/zw_js.js"></script>
<!-- 链接回到顶部.js文件 -->
<script src="resource/common/js/huidaodingbu.js"></script>
<!-- 右边模块.js文件 -->
<script src="resource/common/js/zw_leift.js"></script>

<script type="text/javascript" language="javascript">
    //加入收藏
    function AddFavorite(sURL, sTitle) {
        sURL = encodeURI(sURL);
        try{
            window.external.addFavorite(sURL, sTitle);

        }catch(e) {
            try{
                window.sidebar.addPanel(sTitle, sURL, "");
            }catch (e) {
                alert("加入收藏失败，请使用Ctrl+D进行添加,或手动在浏览器里进行设置.");
            }
        }
    }
</script>
<div style="display: none;">
<!-- loading baidu stat -->
<script type="text/javascript">
    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F7d3fa93d8939cfe0353b06001fdd16d8' type='text/javascript'%3E%3C/script%3E"));
</script>
</div>
<script>
    $(document).ready(function(){
        /* check input */
        $("#search").click(function () {
            var keywords = $("#keywords").val();
            if (keywords == '') {
                $("#search_container").attr('class', 'input-group has-error');
                $("#keywords").focus();
                return false;
            }
        });

        /* 释放焦点 */
        $("#keywords").blur(function () {
            $("#search_container").attr('class', 'input-group');
        });
    });
</script>