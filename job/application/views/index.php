<?php require_once('common/header.php'); ?>

    <script>
        $(document).ready(function () {
            $("#job_index").attr("class", "active01");
        });
    </script>

<?php require_once('common/search_box.php'); ?>

<?php require_once('common/navbar.php'); ?>

    <!--主体内容代码===========================================-->
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <ul class="zw_list">
                    <li class="zw_list_first"><span
                            class="hidden-xs hidden-sm zw_laiyuan">来源网站</span>标题&nbsp;&nbsp;<span class="badge"
                                                                                                  style=" font-size:11px">关注度</span><span
                            class="hidden-xs zw_shijian">时间</span></li>
                    <?php
                    for ($i = 0; $i < count($info_list); $i++) {
                        ?>
                        <li>
                        <span class="hidden-xs hidden-sm zw_laiyuan">
                            <a class="zw_tanchu" data-toggle="tooltip"
                               title="<?php echo $from_src[$info_list[$i]["from_src"]]; ?>"
                               href=""><?php echo $from_src[$info_list[$i]["from_src"]]; ?></a>
                        </span>
                        <span class="zw_biaoti">
                            <a class="zw_tanchu"
                               href="<?php echo site_url(); ?>/index/redirect/<?php echo $info_list[$i]["id"]; ?>"
                               target="_blank" data-toggle="tooltip"
                               title="<?php echo $info_list[$i]["title"]; ?>"><?php echo $this->common_class->SubContents($info_list[$i]["title"]); ?></a>
                            <span class="badge"><?php echo $info_list[$i]["num"]; ?></span>
                        </span>
                            <span class="hidden-xs zw_shijian zw_tanchu" data-toggle="tooltip"
                                  title="<?php echo $info_list[$i]["insert_dt"]; ?>"><?php echo $this->common_class->getFormatTime($info_list[$i]["insert_dt"]); ?></span>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (count($info_list) == 0) {
                        echo "<p align=\"center\" style=\"color:red\">没有数据！</p>";
                    }
                    ?>
                </ul>
                <a style="float:right;margin:20px auto;" class="btn btn-default" href="<?php echo site_url() ?>/search/"
                   type="button">查看更多</a>
            </div>
            <div class="col-md-3 visible-lg visible-md">
                <div id="tagscloud">
                    <a href="<?php echo site_url();?>/search/?keywords=公务员" class="tagc1">公务员</a>
                    <a href="<?php echo site_url();?>/search/?keywords=省考" class="tagc2">省考</a>
                    <a href="<?php echo site_url();?>/search/?keywords=省公务员" class="tagc5">省公务员</a>
                    <a href="<?php echo site_url();?>/search/?keywords=事业单位" class="tagc2">事业单位</a>
                    <a href="<?php echo site_url();?>/search/?keywords=贵阳事业单位" class="tagc2">贵阳事业单位</a>
                    <a href="<?php echo site_url();?>/search/?keywords=贵阳公务员" class="tagc1">贵阳公务员</a>
                    <a href="<?php echo site_url();?>/search/?keywords=银行招聘" class="tagc2">银行招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=贵阳银行招聘" class="tagc5">贵阳银行招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=中国银行招聘" class="tagc2">中国银行招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=建设银行招聘" class="tagc2">建设银行招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=农业银行招聘" class="tagc5">农业银行招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=校园招聘" class="tagc2">校园招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=贵州财经大学招聘" class="tagc1">贵州财经大学招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=贵大招聘" class="tagc2">贵大招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=师大校园招聘" class="tagc5">师大校园招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=民族大学招聘" class="tagc2">民族大学招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=医学院招聘" class="tagc2">医学院招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=中医学院招聘" class="tagc1">中医学院招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=贵阳招聘" class="tagc2">贵阳招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=遵义招聘" class="tagc5">遵义招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=凯里招聘" class="tagc2">凯里招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=仁怀招聘" class="tagc2">仁怀招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=安顺招聘" class="tagc5">安顺招聘</a>
                    <a href="<?php echo site_url();?>/search/?keywords=贵州招聘" class="tagc2">贵州招聘</a>
                </div>

                <h4><span class="label label-default">公告</span></h4>

                <p style="text-indent: 30px;">我们提供给大家一个聚合阅读的场所，将贵州大部分招聘信息聚合在此，让您用最少的时间看到最多信息！</p>

                <p style="text-indent: 30px;">但是，我们还很年轻，需要您的支持，找工作，上贵州找工作吧！</p>

                <p style="text-indent: 30px;">QQ群 <a target="_blank"
                                                     href="http://shang.qq.com/wpa/qunwpa?idkey=f40c5e3834b11b56a8a13cf162b09c03e24f7b656eba611f7e17bc14ba1a1b2b"><img
                            border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="贵州找工作"
                            title="加入贵州找工作"></a></p>
            </div>
        </div>
    </div>

<?php require_once('common/footer.php'); ?>