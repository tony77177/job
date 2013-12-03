<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>贵州找工作</title>
    <base href="<?php echo base_url() ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="resource/common/img/favicon.ico" rel="shortcut icon">
    <!-- Bootstrap -->
    <link href="resource/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="resource/common/css/style.css" rel="stylesheet" type="text/css">
    <link href="resource/common/css/huidaodingbu.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php require_once('header.php');?>

<!--主体内容代码===========================================-->
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <ul class="zw_list">
                <li class="zw_list_first"><span class="hidden-xs hidden-sm zw_laiyuan">来源网站</span>标题&nbsp;&nbsp;<span class="badge" style=" font-size:11px">访问量</span><span class="hidden-xs zw_shijian">时间</span> </li>
                <?php
                for($i=0;$i<count($info_list);$i++){
                    ?>
                    <li>
                        <span class="hidden-xs hidden-sm zw_laiyuan">
                            <a class="zw_tanchu" data-toggle="tooltip" title="<?php echo $from_src[$info_list[$i]["from_src"]];?>" href=""><?php echo $from_src[$info_list[$i]["from_src"]];?></a>
                        </span>
                        <span class="zw_biaoti">
                            <a class="zw_tanchu" href="<?php echo site_url();?>/index/redirect/<?php echo $info_list[$i]["id"];?>" target="_blank" data-toggle="tooltip" title="<?php echo $info_list[$i]["title"];?>"><?php echo $this->common_class->SubContents($info_list[$i]["title"]);?></a>
                            <span class="badge"><?php echo $info_list[$i]["num"];?></span>
                        </span>
                        <span class="hidden-xs zw_shijian zw_tanchu" data-toggle="tooltip" title="<?php echo $info_list[$i]["insert_dt"];?>"><?php echo $this->common_class->getFormatTime($info_list[$i]["insert_dt"]);?></span>
                    </li>
                <?php
                }
                ?>
                <?php
                    if(count($info_list)==0){
                        echo "<p>没有数据！</p>";
                    }
                ?>
            </ul>
            <a style="float:right;margin:20px auto;" class="btn btn-default" href="#" type="button">查看更多</a>
        </div>
        <div class="col-md-3 visible-lg visible-md">
            <div id="tagscloud">
                <a href="" class="tagc1">公务员</a>
                <a href="" class="tagc2">省考</a>
                <a href="" class="tagc5">省公务员</a>
                <a href="" class="tagc2">事业单位</a>
                <a href="" class="tagc2" >贵阳事业单位</a>
                <a href="" class="tagc1" >贵阳公务员</a>
                <a href="" class="tagc2">银行招聘</a>
                <a href="" class="tagc5">贵阳银行招聘</a>
                <a href="" class="tagc2">中国银行招聘</a>
                <a href="" class="tagc2">建设银行招聘</a>
                <a href="" class="tagc5">农业银行招聘</a>
                <a href="" class="tagc2">校园招聘</a>
                <a href="" class="tagc1">贵州财经大学招聘</a>
                <a href="" class="tagc2">贵大招聘</a>
                <a href="" class="tagc5">师大校园招聘</a>
                <a href="" class="tagc2">民族大学招聘</a>
                <a href="" class="tagc2" >医学院招聘</a>
                <a href="" class="tagc1" >中医学院招聘</a>
                <a href="" class="tagc2">贵阳招聘</a>
                <a href="" class="tagc5">遵义招聘</a>
                <a href="" class="tagc2">凯里招聘</a>
                <a href="" class="tagc2">仁怀招聘</a>
                <a href="" class="tagc5">安顺招聘</a>
                <a href="" class="tagc2">贵州招聘</a>
            </div>

            <h4><span class="label label-default">公告</span></h4>
            <p style="text-indent: 30px;">我们提供给大家一个聚合阅读的场所，将贵州大部分招聘信息聚合在此，让您用最少的时间看到最多信息！但是，我们还很年轻，需要您的支持，找工作，上贵州找工作吧！</p>
            <p>QQ群 99793122</p>
        </div>
    </div>
</div>


<!-- Baidu Button BEGIN -->
<script type="text/javascript" id="bdshare_js" data="type=slide&amp;img=1&amp;pos=right&amp;uid=6625554" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
    document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>
<!-- Baidu Button END -->

<?php require_once('footer.php');?>

</body>
</html>