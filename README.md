## PHP Notes ##

**Memcache的使用**

安装Memcached 及php memcache扩展后就可以

	$memcache = new Memcache ;
	
	$memcache->addServer('memcache_host' , memcache_port);//可添加多个
	
	$memcache->set('key','val','compress?','expire');

使用过程中发现一个问题，当先memcache服务器池中添加多个memcache的时候，set key 每个memcached服务器

中数据显示正确，当调用increment方法，对存储元素 值增加1时，发现并不是所有的服务器都修改了。

这个使用中要特别注意，防止掉坑里了


**PHP安装配置项**

在安装php的是增加--with-config-file-scan-dir=/etc/php.d  configure选项会去/etc/php.d目录下读取配置文件

这样可避免单个php.ini文件的问题，增加配置文件灵活性
