### 添加自启动脚本到/etc/init.d目录下

添加执行权限
```	
chmod a+x /etc/init.d/nginx
chmod a+x /etc/init.d/php-fpm
```
加入服务
```	
chkconfig --add nginx
chkconfig --add php-fpm
```	 
开机自启
```
chkconfig nginx on    
chkconfig php-fpm on
```