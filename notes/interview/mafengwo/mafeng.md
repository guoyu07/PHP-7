###几个面试题

1.mysql复制原理

![mysql_replication](./mysql03-1.JPG)

该过程的第一部分就是master记录二进制日志。在每个事务更新数据完成之前，master在二日志记录这些改变。MySQL将事务串行的写入二进制日志，即使事务中的语句都是交叉执行的。在事件写入二进制日志完成后，master通知存储引擎提交事务。
下一步就是slave将master的binary log拷贝到它自己的中继日志。首先，slave开始一个工作线程——I/O线程。I/O线程在master上打开一个普通的连接，然后开始binlog dump process。Binlog dump process从master的二进制日志中读取事件，如果已经跟上master，它会睡眠并等待master产生新的事件。I/O线程将这些事件写入中继日志。
SQL slave thread处理该过程的最后一步。SQL线程从中继日志读取事件，更新slave的数据，使其与master中的数据一致。只要该线程与I/O线程保持一致，中继日志通常会位于OS的缓存中，所以中继日志的开销很小。
此外，在master中也有一个工作线程：和其它MySQL的连接一样，slave在master中打开一个连接也会使得master开始一个线程。复制过程有一个很重要的限制——复制在slave上是串行化的，也就是说master上的并行更新操作不能在slave上并行操作。


2.redis与memcache区别

3.Innodb类型和MyISAM类型锁机制

http://blog.chinaunix.net/uid-24111901-id-2627857.html

http://www.cnblogs.com/benshan/archive/2013/01/17/2865286.html


4.explain查询语句key_len 长度如何计算

5.二维数组排序问题，针对数组的某一列排序
array_multisort

6.mysql索引 最左原则的使用
