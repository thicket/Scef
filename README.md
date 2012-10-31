如若要使用这个东东
请更改以下设置：
./config/project.php
controller/* && model/* && view/* && xml/*
还有很多功能没有弄好，这个文件主要修改的是数据库连接。

非常勉强的发布了。问题有很多。图能静下心来，再去整理。
现在应用在自己的博客里面多demo to http://in-life.info/wp


基本原理

限制
url：http://youdomain.com/?index/demo

index.php 载入配置文件后，调用 josn 文件夹里面的显示配置，来显示加载页面。
之前残留的xml文件处理。现在还在。暂不用理会。

报错处理
在加载完毕错误处理函数后，所有级别的错误，都以抛出异常，后为结束。


祝：希望自己能安下心后，延续～
