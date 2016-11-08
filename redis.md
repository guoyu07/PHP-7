## linux下安装redis集群(Master-Slave) ##

本文演示了redis在同一台linux上的安装及运行多个实例，并演示了主从复制，
以及如何进行主从的切换。

**1．下载**

    $ wget http://download.redis.io/releases/redis-3.0.7.tar.gz

**2．解压缩**

    $ tar xzf redis-3.0.7.tar.gz

**3．编译**

    $ cd redis-3.0.7

    $ make

    $make install

    $cp redis.conf /etc/ #该步骤将配置文件放入etc方便管理

**特别说明：**

make install命令执行完成后，会在/usr/local/bin目录下生成可执行文件，比如redis-server、redis-cli等等，这样就可以在任何目录下执行redis命令了。

**4.启动redis:**

    $ redis-server 

**5.下面我们来配置redis单主机多实例：**

我们首先拷贝一份配置文件：


    # cp /etc/redis.conf /etc/redis-6380.conf

然后修改之

	# 是否后台运行
	daemonize yes

	# 指定进程号
	pidfile /var/run/redis_6380.pid

	# 指定端口
	port 6380

使用这个配置启动redis

	# redis-server /etc/redis-6380.conf

启动成功没有提示，因为已经设置了后台运行，所以可以通过ps命名查看，或者直接用redis-cli连接上去。比如：

	# redis-cli -p 6380
	127.0.0.1:6380> keys *
	(empty list or set)
	127.0.0.1:6380>

分别测试一下6379和6380的redis服务，看是否都正常工作，且互不干扰。

	# redis-cli -p 6379
	127.0.0.1:6379> keys *
	(empty list or set)
	127.0.0.1:6379> set k1 0
	OK
	127.0.0.1:6379> INCR k1
	(integer) 1
	127.0.0.1:6379> INCR k1
	(integer) 2
	127.0.0.1:6379> INCR k1
	(integer) 3
	127.0.0.1:6379> exit
	[root@localhost redis-3.0.7]# redis-cli -p 6380
	127.0.0.1:6380> keys *
	(empty list or set)
	127.0.0.1:6380> 

**6.配置master-slave关系**

首先编辑master的配置文件

	#配置合适的时间
	tcp-keepalive 60
	#下面行保证是注释的
	#bind 127.0.0.1
	#最好加上密码，如果你想不被攻击的话
	requirepass your_redis_master_password
	#打开追加的备份
	appendonly yes
	appendfilename redis-nice.aof

保存之后，重启

	#redis-server  /etc/redis.conf
客户端这时连接之后，执行任何命令都会报错，需要使用auth yourpassword,进行授权。

	127.0.0.1:6379> keys *
	(error) NOAUTH Authentication required.
	接下来，配置slave : vim /etc/redis-6380.conf

	#指向master的地址
	slaveof your_redis_master_ip 6379
	#master的密码
	masterauth your_redis_master_password

一样保存之后重启redis-server /etc/redis-6380.conf。

**7.校验主从复制**

我们在master的redis里随便set一些东西，看看slave是否自动有这些值，就可以知道它们是否复制成功了。

	[root@localhost redis-3.0.7]# redis-cli 
	127.0.0.1:6379> keys *
	(error) NOAUTH Authentication required.
	127.0.0.1:6379> auth Yourpassword
	OK
	127.0.0.1:6379> keys *
	(empty list or set)
	127.0.0.1:6379> set ma 21
	OK
	127.0.0.1:6379> keys *
	1) "ma"
	127.0.0.1:6379> exit
	[root@localhost redis-3.0.7]# redis-cli -p 6380
	127.0.0.1:6380> keys *
	1) "ma"
	127.0.0.1:6380> 

成功！使用info命令可以查看更多信息。

**8.切换slave到master**

我们做主从结构的目的就是为了应对如果master挂了，可以切换到slave上。

这里演示手动切换：（目前生产环境都是使用脚本完成）

a，将slave的行为关闭，命令如下

	127.0.0.1:6380> SLAVEOF NO ONE

这时它就不是slave了，而是独立的master。

b，将其他slave都指向这个新的master(我这里没有其他slave，就不演示了)，命令如下

	127.0.0.1:6380> SLAVEOF hostname port

这时候所有的slave都会丢弃没复制完的东西，开始到新的master那复制。

**9.恢复到原始master**

	> SLAVEOF your_redis_master_ip 6379

经过问题的排查，master的问题解决了，我们可以将它恢复使用。
