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
<!-- 回到顶部代码====================================== -->
<div class="visible-lg">
    <div id="code"></div>
    <div id="code_img"></div>
    <a id="gotop" href="javascript:void(0)"></a></div>
<!--导航代码===========================================-->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style=" background:rgb(3,35,34); border:none">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
                    class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                    class="icon-bar"></span> <span class="icon-bar"></span></button>
            <a class="navbar-brand hidden-lg" href="#">贵州找工作</a></div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active01"><a href="#about">首页</a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">分类 <b class="caret"></b></a>
                    <ul class="dropdown-menu zw_xiaola">
                        <li><a href="#">贵阳</a></li>
                        <li><a href="#">遵义</a></li>
                        <li><a href="#">凯里</a></li>
                        <li><a href="#">仁怀</a></li>
                        <li><a href="#">安顺</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#about">收藏</a></li>
            </ul>
        </div>
        <!--/.navbar-collapse -->
    </div>
</div>
<!--收索代码===========================================-->
<div style=" background:#ededed; margin-top:50px; padding:20px 0">
    <div class="container">
        <div class="row">
            <div class="col-md-4" style="margin-bottom:5px;">
                <div class="row">
                    <div class="col-xs-7"><a href="#"><img class="img-responsive" src="<?php echo base_url() ?>resource/common/img/logo1.png"></a>
                    </div>
                    <div class="col-xs-5">
                        <div class="btn-group" style="float:right">
                            <button class="btn btn-success" style=" height:40px" type="button"> 贵阳</button>
                            <button class="btn btn-success  dropdown-toggle" style=" height:40px" data-toggle="dropdown"
                                    type="button"><span class="caret"></span> <span class="sr-only"> 收索分类 </span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">贵阳</a></li>
                                <li><a href="#">遵义</a></li>
                                <li><a href="#">凯里</a></li>
                                <li><a href="#">仁怀</a></li>
                                <li><a href="#">安顺</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5" style="margin-bottom:5px;">
                <div class="input-group">
                    <input style=" height:44px; font-size:22px;" class="form-control" type="text"
                           placeholder="请输入搜索关键词" name="keywords"/>
                    <span class="input-group-addon">
                        <a href=""><span class="glyphicon glyphicon-search"></span></a></span></div>
            </div>
            <div class="col-md-3 zw_daxue"><a href="">贵大</a><a href="">财经大学</a><a href="">师大</a><a href="">民族大学</a><a
                    href="">医学院</a><a href="">中医学院</a></div>
        </div>
    </div>
</div>
<!--主体内容代码===========================================-->
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <ul class="zw_list">
                <li class="zw_list_first"><span class="hidden-xs hidden-sm zw_laiyuan">来源网站</span>标题&nbsp;&nbsp;<span
                        class="badge" style="font-size:11px">访问量</span><span class="hidden-xs zw_shijian">时间</span>
                </li>
                <?php
                    for($i=0;$i<count($info_list);$i++){
                ?>
                <li><a class="zw_list_a" data-toggle="tooltip" title="<?php echo $info_list[$i]["title"];?>" href="<?php echo site_url();?>/index/redirect/<?php echo $info_list[$i]["id"];?>" target="_blank">
                        <span class="hidden-xs hidden-sm zw_laiyuan"><?php echo $info_list[$i]["from_src"];?></span>
                        <span class="zw_biaoti"><?php echo $this->common_class->SubContents($info_list[$i]["title"]);?><span class="badge"><?php echo $info_list[$i]["num"];?></span></span>
                        <span class="hidden-xs zw_shijian"><?php echo $this->common_class->getFormatTime($info_list[$i]["insert_dt"]);?></span></a></li>
                 <?php
                    }
                ?>
                <?php
                if(count($info_list)==0){
                    echo "<p>没有数据！</p>";
                }
                ?>
            </ul>
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
        </div>
    </div>
</div>
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
</body>
</html>
