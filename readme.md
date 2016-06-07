Laravel-shopping是一个以laravel框架搭建的商城管理后台。

最初，做这一个后台只是找工作，碰到最多的就是一些做商城项目的，又没有这方面的一些经验，所以，花了一个星期做了这一个商城管理的后台系统。虽然做的很粗糙，但是对一些初学laravel框架，或是做商城的同学，应该还是有点帮助的。

这个后台所用到的模版是: AdminLTE（十分不错的一个后台模版，可以搜索下https://www.almsaeedstudio.com/）

感兴趣的朋友，可以联系我。 邮箱：kelvin_512@sina.com

=============================我是分割线============================

下载完代码后，运行
composer install
// 这个是安装些商城后台系统的一些依赖

php artisan db:seed     
// 商城后台系统的一些基本数据

初始账号： 断水流

密码    :  123asd



简单说下这个系统：

app/Http/Controllers/Admin       
// 后台管理的Controller层目录

app/Models                       
// Model层目录(当然前台也可以用，只是一些数据的操作)

app/Services                     
// Services层目录(对数据操作方法的封装，便于控制器层的调用)

resource/views/admin             
// 后台管理的View层目录

public/backstage                 
// 后台用到的一些插件，样式目录