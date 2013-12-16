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
<!--搜索代码===========================================-->
<div class=" hidden-sm hidden-xs" style=" padding:20px 0">
    <div class="container">
        <div class="row">
            <div class="col-md-4" style="margin-bottom:5px;"> <a href="#"><img class="img-responsive" src="<?php echo base_url() ?>resource/common/img/logo1.png"></a> </div>
            <div class="col-md-5" style="margin-bottom:5px;">
                <form action="<?php echo site_url() ?>/search/" method="get">
                    <div class="input-group" id="search_container">
                        <input style=" height:44px; font-size:22px;" class="form-control" type="text"
                               placeholder="请输入搜索关键词" id="keywords" name="keywords" value="<?php echo $keywords;?>"/>
                              <span class="input-group-btn">
                                <button class="btn btn-default" style=" height:44px; font-size:22px;" type="submit" id="search">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                              </span>
                    </div>
                </form>
            </div>
            <div class="col-md-3 zw_daxue">
                <a href="#">贵大</a>
                <a href="#">财经大学</a>
                <a href="#">师大</a>
                <a href="#">民族大学</a>
                <a href="#">医学院</a>
                <a href="#">中医学院</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('header.php');?>

<!--主体内容代码===========================================-->
<div class="container">
    <div class="row">
        <div class=" col-sm-12">
            <ul class="select">
                <li class="select-result">
                    <dl>
                        <dt>已选：</dt>
                        <dd class="select-no">暂时没有选择过滤条件</dd>
                    </dl>
                </li>
                <li class="select-list">
                    <dl id="select1">
                        <dt>类型：</dt>
                        <dd class="select-all selected"><a href="javascript:void(0);">全部</a></dd>
                        <dd><a href="javascript:void(0);">银行</a></dd>
                        <dd><a href="javascript:void(0);">事业单位</a></dd>
                        <dd><a href="javascript:void(0);">公务员</a></dd>
                        <dd><a href="javascript:void(0);">民营企业</a></dd>
                    </dl>
                </li>
                <li class="select-list">
                    <dl id="select2">
                        <dt>来源：</dt>
                        <dd class="select-all selected"><a href="javascript:void(0);">全部</a></dd>
                        <dd><a href="javascript:void(0);">163贵州网</a></dd>
                        <dd><a href="javascript:void(0);">贵州大学</a></dd>
                        <dd><a href="javascript:void(0);">贵州财经大学</a></dd>
                        <dd><a href="javascript:void(0);">贵州人才信息网</a></dd>
                        <dd><a href="javascript:void(0);">贵州人才网</a></dd>
                    </dl>
                </li>
                <li class="select_index">
                    <dl>
                        <dt>关键词：</dt>
                        <dd class="row">
                            <div class="input-group col-sm-4">
                                <input type="text" class="form-control" placeholder="请输入关键词" value="<?php echo $keywords;?>">
                <span class="input-group-btn">
                <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span> </div>
                        </dd>
                    </dl>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <ul class="zw_list">
                <li class="zw_list_first"><span class="hidden-xs hidden-sm zw_laiyuan">来源网站</span>标题&nbsp;&nbsp;<span class="badge" style=" font-size:11px">关注度</span><span class="hidden-xs zw_shijian">时间</span> </li>

                <?php
                for($i=0;$i<count($search_info_list);$i++){
                ?>

                <li>
                    <span class="hidden-xs hidden-sm zw_laiyuan"><a class="zw_tanchu" data-toggle="tooltip" title="<?php echo $from_src[$search_info_list[$i]["from_src"]];?>"href=""><?php echo $from_src[$search_info_list[$i]["from_src"]];?></a></span>
                    <span class="zw_biaoti">
                        <a class="zw_tanchu" href="<?php echo site_url();?>/index/redirect/<?php echo $search_info_list[$i]["id"];?>" target="_blank" data-toggle="tooltip" title="<?php echo $search_info_list[$i]["title"];?>">
                            <?php
                                $title = $this->common_class->SubContents($search_info_list[$i]["title"],45);
                                if(!empty($_keywords)){
                                    for($j=0;$j<count($_keywords);$j++){
                                        $title = str_replace($_keywords[$j],"<font color=\"red\">".$_keywords[$j]."</font>",$title);
                                    }
                                }
                                echo $title;
                            ?>
                        </a>
                        <span class="badge">
                            <?php
                                echo $search_info_list[$i]["num"];
                            ?>
                        </span>
                    </span>
                    <span class="hidden-xs zw_shijian zw_tanchu" data-toggle="tooltip" title="<?php echo $search_info_list[$i]["insert_dt"];?>"><?php echo $this->common_class->getFormatTime($search_info_list[$i]["insert_dt"]);?></span></a>
                </li>
                <?php
                }
                ?>
                <?php
                if(count($search_info_list)==0){
                    echo "<p align=\"center\" style=\"color:red\">没有数据！</p>";
                }
                ?>
            </ul>
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>

<?php require_once('footer.php');?>

<script>
    $(document).ready(function(){
        $("#job_search").attr("class","active01");
    });
</script>

</body>
</html>
