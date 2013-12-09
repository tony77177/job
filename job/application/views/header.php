<!--导航代码===========================================-->
<div class="navbar navbar-inverse" role="navigation" style=" background:rgb(31,166,122); border:none; color:#fff; border-radius:0;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand hidden-lg" href="#">贵州找工作</a> </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li id="job_index"><a href="<?php echo site_url() ?>"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
                <li id="job_search"> <a href="<?php echo site_url() ?>/search/"><span class="glyphicon glyphicon-search"></span> 搜索</a></li>
                <li id="job_about"> <a href="#"><span class="glyphicon glyphicon-user"></span> 关于</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a onclick="AddFavorite(window.location,document.title)" href="#">
				<span class="glyphicon glyphicon-heart"></span> 收藏
				</a>
				</li>
            </ul>
        </div>
        <!--/.navbar-collapse -->
    </div>
</div>