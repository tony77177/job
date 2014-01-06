<?php require_once('common/header.php'); ?>

    <script>
        $(document).ready(function () {
            $("#job_search").attr("class", "active01");
        });
    </script>

<?php require_once('common/search_box.php'); ?>

<?php require_once('common/navbar.php'); ?>

    <!--主体内容代码===========================================-->
    <div class="container">
        <div class="row">
<!--            <div class=" col-sm-12">-->
<!--                <ul class="select">-->
<!--                    <li class="select-result">-->
<!--                        <dl>-->
<!--                            <dt>已选：</dt>-->
<!--                            <dd class="select-no">暂时没有选择过滤条件</dd>-->
<!--                        </dl>-->
<!--                    </li>-->
<!--                    <li class="select-list">-->
<!--                        <dl id="select1">-->
<!--                            <dt>类型：</dt>-->
<!--                            <dd class="select-all selected"><a href="javascript:void(0);">全部</a></dd>-->
<!--                            <dd><a href="javascript:void(0);">银行</a></dd>-->
<!--                            <dd><a href="javascript:void(0);">事业单位</a></dd>-->
<!--                            <dd><a href="javascript:void(0);">公务员</a></dd>-->
<!--                            <dd><a href="javascript:void(0);">民营企业</a></dd>-->
<!--                        </dl>-->
<!--                    </li>-->
<!--                    <li class="select-list">-->
<!--                        <dl id="select2">-->
<!--                            <dt>来源：</dt>-->
<!--                            <dd class="select-all selected"><a href="javascript:void(0);">全部</a></dd>-->
<!--                            <dd><a href="javascript:void(0);">163贵州网</a></dd>-->
<!--                            <dd><a href="javascript:void(0);">贵州大学</a></dd>-->
<!--                            <dd><a href="javascript:void(0);">贵州财经大学</a></dd>-->
<!--                            <dd><a href="javascript:void(0);">贵州人才信息网</a></dd>-->
<!--                            <dd><a href="javascript:void(0);">贵州人才网</a></dd>-->
<!--                        </dl>-->
<!--                    </li>-->
<!--                    <li class="select_index">-->
<!--                        <dl>-->
<!--                            <dt>关键词：</dt>-->
<!--                            <dd class="row">-->
<!--                                <div class="input-group col-sm-4">-->
<!--                                    <input type="text" class="form-control" placeholder="请输入关键词"-->
<!--                                           value="--><?php //echo $keywords; ?><!--">-->
<!--                <span class="input-group-btn">-->
<!--                <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>-->
<!--                </span></div>-->
<!--                            </dd>-->
<!--                        </dl>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
            <div class="col-md-12">
                <ul class="zw_list">
                    <li class="zw_list_first"><span
                            class="hidden-xs hidden-sm zw_laiyuan">来源网站</span>标题&nbsp;&nbsp;<span class="badge"
                                                                                                  style=" font-size:11px">关注度</span><span
                            class="hidden-xs zw_shijian">时间</span></li>

                    <?php
                    for ($i = 0; $i < count($search_info_list); $i++) {
                        ?>

                        <li>
                            <span class="hidden-xs hidden-sm zw_laiyuan"><a class="zw_tanchu" data-toggle="tooltip"
                                                                            title="<?php echo $from_src[$search_info_list[$i]["from_src"]]; ?>"
                                                                            href=""><?php echo $from_src[$search_info_list[$i]["from_src"]]; ?></a></span>
                    <span class="zw_biaoti">
                        <a class="zw_tanchu"
                           href="<?php echo site_url(); ?>/index/redirect/<?php echo $search_info_list[$i]["id"]; ?>"
                           target="_blank" data-toggle="tooltip" title="<?php echo $search_info_list[$i]["title"]; ?>">
                            <?php
                            $title = $this->common_class->SubContents($search_info_list[$i]["title"], 45);
                            if (!empty($_keywords)) {
                                for ($j = 0; $j < count($_keywords); $j++) {
                                    $title = str_replace($_keywords[$j], "<font color=\"red\">" . $_keywords[$j] . "</font>", $title);
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
                            <span class="hidden-xs zw_shijian zw_tanchu" data-toggle="tooltip"
                                  title="<?php echo $search_info_list[$i]["insert_dt"]; ?>"><?php echo $this->common_class->getFormatTime($search_info_list[$i]["insert_dt"]); ?></span></a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (count($search_info_list) == 0) {
                        echo "<p align=\"center\" style=\"color:red\">没有数据！</p>";
                    }
                    ?>
                </ul>
                <?php echo $pagination; ?>
            </div>
        </div>
    </div>

<?php require_once('common/footer.php'); ?>