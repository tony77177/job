<!--搜索代码===========================================-->
<div class=" hidden-sm hidden-xs" style=" padding:20px 0">
    <div class="container">
        <div class="row">
            <div class="col-md-4" style="margin-bottom:5px;"> <a href="#"><img class="img-responsive" src="<?php echo base_url() ?>resource/common/img/logo1.png"></a> </div>
            <div class="col-md-5" style="margin-bottom:5px;">
                <form action="<?php echo site_url() ?>/search/" method="get">
                    <div class="input-group" id="search_container">
                            <input style=" height:44px; font-size:22px;" class="form-control" type="text"
                                   placeholder="请输入搜索关键词" id="keywords" name="keywords"/>
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
<!--导航代码===========================================-->
<div class="navbar navbar-inverse" role="navigation" style=" background:rgb(31,166,122); border:none; color:#fff; border-radius:0;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand hidden-lg" href="#">贵州找工作</a> </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active01"><a href="#">首页</a></li>
                <li> <a href="#">搜索</a></li>
                <li> <a href="#">关于</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a onclick="AddFavorite(window.location,document.title)" href="#favorite">收藏</a></li>
            </ul>
        </div>
        <!--/.navbar-collapse -->
    </div>
</div>