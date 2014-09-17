##qsyaf (quick start yaf)


###简介
* 让yaf开发者能够快速开始，比你使用其他框架还要快
* 我们的目录结构严格遵守yaf规则，绿色无污染
* 我们还提供了一些常用工具库，让你根本停不下来

###使用方法
####首先你得安装yaf，yaf官网请 [点击这里](http://www.yafdev.com)
####第一步
下载并解压本项目代码到你的网站目录中 [点击下载](http://github.com/whaten/qsyaf/archive/master.zip)
####第二步
添加对应的rewrite规则
####apache
```
DocumentRoot "path/public" #需要定位到本项目的public文件夹
<Directory "path/public">
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule .* index.php
</Directory>
```
###nginx
```
root path/public #需要定位到本项目的public文件夹
location / {
    try_files $uri $uri/ /index.php;
}
```
###sae
```
    - rewrite: if(path ~ "^(?!public/)(.*)") goto "/public/$1"
    - rewrite: if(!is_file()) goto "/public/index.php"
```
####第三步
重启你的web服务器，输入地址后看到 `Thanks a lot` 就ok了

###最后
我们会不断丰富qsyaf的内容，希望通过qsyaf能让你对yaf有一个美好的开始。

欢迎大家贡献自己的代码。

####[About me](http://whaten.github.io)