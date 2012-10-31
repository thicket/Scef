
    <body onload="detectBrowser()">

        <div class="blank" ></div>
        <div class="auxiliary_line" ></div>

        <div class="box" >
            <nav>
                <div id="setting">设置
                    <ul>
                        <li class="article" onclick="articleToggle(s.article)">文章：<span>折叠</span></li>
                        <li class="nav" onclick="navToggle()">导航：<span>保持显示</span></li>
                    </ul>
                </div>
                <ul class="nav" >
                    <li><a class="na1" name="share" href="javascript:" >分享</a></li>
                    <li><a class="na2" name="it" href="javascript:" >技术</a></li>
                    <li><a class="na3 <?php echo $p_t=='life'?'show_nav3':''?>" name="life" href="javascript:" >生活</a></li>
                    <li><a class="na4" name="project" href="javascript:" >项目</a></li>
                    <li><a class="na5" name="idea" href="javascript:" >构思</a></li>
                    <li><a class="na6" name="number" href="javascript:" >数字</a></li>
                    <li><a class="na7" name="links" href="javascript:" >友链</a></li>
                    <li><a class="na8" name="music" href="javascript:" >音乐</a></li>
                    <li><a class="na9" name="tags" href="javascript:" >标签</a></li>
                    <li><a class="na0" name="about" href="javascript:" >关于</a></li>
                </ul>
                <a class="na1" href="javascript:" >RSS</a>
                <a class="na2" href="javascript:" onclick="blodShow()">粗状</a>
                <a class="na3" href="javascript:" onclick="rightClear()">显示左边</a>
                <a class="na4" href="javascript:" onclick="rightShow()">显示右边</a>
                <a class="na5" href="javascript:" onclick="topShow()">显示上面</a>
            </nav>
            <div class="right" >
                <div class="share hide" >分享</div>
                <div class="it hide" >技术</div>
                <div class="life hide" >生活</div>
                <div class="project hide" >项目</div>
                <div class="idea hide" >构思</div>
                <div class="number hide" >数字</div>
                <div class="links hide" >友链</div>
                <div class="music hide" >音乐</div>
                <div class="tags hide" >标签</div>
                <div class="about hide" >关于</div>

                <div class="list" style="height: 100%; opacity: 1; display: block; ">
                    <?php foreach ($data['posts'] as $i): ?>
                        <div class="box_model">
                            <div class="box_signs">
                                <span></span><?php $d = explode(' ',$i['post_date'])?>
                                <strong><?php echo $d[0]?></strong>
                                <strong style="border-top: 1px solid;" ><?php echo $d[1]?></strong>
                            </div>
                            <div class="article">
                                <header onclick="articleToggle(this)">
                                    <strong><?php echo $i['post_title'] ?> </strong>
                                </header>
                                <article>
                                    <?php echo nl2br($i['post_content']) ?>
                                </article>
                            </div>
                            <div class="box_tools">
                                <p>
                                    <strong>category</strong>
                                    <a><?php echo $i['cate'][0]['name']?></a>
                                </p>
                                <p>
                                    <strong>tags</strong>
                                    <?php foreach ($i['tags'] as $t): ?>
                                    <a><?php echo $t['name']?></a>
                                    <?php endforeach; ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </body>
    