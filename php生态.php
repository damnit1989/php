<?php 

/******************************网站开发知识体系**************************/

前端：
	1.html，css，js,jquery，img,bootstrap
	2.前端组件的cdn
	3.前端组件的压缩处理
	4.前端常用技术
		上传插件，图表插件，实时推送插件，novnc，canvas，svg，xss攻击，ajax跨域
	5.http请求的状态码含义
		200：
		301：
		302：
		304：
		403：
		404：
		500：


php:
	1.知识点
		session和cookie,
			session 保存在服务端(默认是在服务器的/tmp 目录下面,数据存储格式:实例化的数据格式
			cookie 保存在客户端电脑,通过sessionid（cookie）识别服务端的session信息
		post/get请求方式
		
		exec()和system()执行外部命令
			exec() 可以将执行的结果存入数组
			system() 直接输出执行的结果

	2.面向对象
		接口(interface),抽象类(abstract),普通类(class)
		访问限制:
			public:类的外部和内部都可以访问
			private:只允许在类的内部访问
			protected:类的内部以及子类的内部访问
	3.php设计模式
		简单工程模式
		工厂方法模式
		抽象工厂模式
		单例模式
		策略模式
		......
	
	4.php框架常用函数
		call_user_func(),call_user_func_array() 	执行普通函数，或者类的方法
		spl_autoload_register() 	注册自动加载器 可以定义文件的搜寻目录
		extract()  	从数组中将变量导入到当前的符号表
		ob_start()	打开输出控制缓冲 ob_get_contents(),ob_end_flush()等

mysql:
	1.存储引擎:
		myisam:
			表锁的两种模式：表共享读锁（table read lock）和表独占写锁（table write lock）
			表级锁:myISAM表的读操作，不会阻塞其他用户对同一个表的读请求，但会阻塞对同一个表的写请求。 2.myISAM表的写操作，会阻塞其他用户对同一个表的读和写操作
			myISAM锁调度问题:
				MyISAM存储引擎的读锁和写锁是互斥的，读写操作室串行的，那么如果读写两个进程同时请求同一张表，Mysql将会使写进程先获得锁。
				不仅仅如此，即使读请求先到达锁等待队列，写锁后到达，写锁也会先执行。因为mysql因为写请求比读请求更加重要。这也正是MyISAM不适合含有大量更新操作和查询操作应用的原因。
				调节办法：1)通过指定启动参数low-priority-updates,使MyISAM引擎默认给与读请求优先的权限 
					2）通过执行set low_PRIORITY_UPDATES=1，降低更新请求的优先级。 
					3）指定INSERT、UPDATE、DELETE语句的LOW_PRIORITY属性

		innodb:
			支持事务处理
			行级锁:InnoDB行锁是通过给索引上的索引项加锁来实现的，这一点MySQL与Oracle不同，后者是通过再数据块中，对相应数据行加锁来实现的。InnoDB这种行锁实现特点意味着：只有通过索引条件检索数据，innoDB才使用行级锁，否则InnoDB将使用表锁
			显示添加锁
				共享锁（S） ： SELECT * FROM table_name WHERE .... LOCK IN SHARE MODE
				排他锁（X）：  SELECT * FROM table_name WHERE .... FOR UPDATE.
				使用select ... in share mode获取共享锁，主要用在需要数据依存关系时，确认某行记录是否存在，并确保没有人对这个记录进行update或者delete
		memory:
			（1）memory存储引擎相比前面的一些存储引擎，有点不一样，其使用存储在内从中的数据来创建表，而且所有的数据也都存储在内存中。
			（2）每个基于memory存储引擎的表实际对应一个磁盘文件，该文件的文件名和表名是相同的，类型为.frm。该文件只存储表的结构，而其数据文件，都是存储在内存中，这样有利于对数据的快速处理，提高整个表的处理能力。
			（3）memory存储引擎默认使用哈希（HASH）索引，其速度比使用B-+Tree型要快，如果读者希望使用B树型，则在创建的时候可以引用。
			（4）memory存储引擎文件数据都存储在内存中，如果mysqld进程发生异常，重启或关闭机器这些数据都会消失。所以memory存储引擎中的表的生命周期很短，一般只使用一次
		merge-mysiam: 
			 主要可以对mysiam引擎的表进行分表操作
				
	2.索引
		索引类型:normal,unique,FULLTEXT
			索引的最左前缀匹配原则,对于聚合索引，首先 匹配到最左边的字段
			normal索引是最基本的索引类型，单列索引或者多个字段的聚合索引
			unique索引是唯一索引，保证某一个字段(多个字段)的唯一性
			FULLTEXT索引是全文索引，应用在char，varchar，text字段类型上，采用分词技术，对于中文需要php来分词，然后存储到一个单独的字段，当查找时直接查找分词字段,通过分词字段找到整条数据，格式：where match('字段') AGAINST('字符串')
		索引方式:BTREE,HASH

			BTREE索引的取决于树的高度,树越低 I/O越少，查找越快，这就要求所以字段长度 尽可能的小
			myisam引擎的索引文件和数据文件是分开存储的，叶子节点只存储数据的地址，通过地址找到真正的数据
			innode引擎的数据文件本身就是索引文件，叶子节点直接存储的就是真正的数据，以主键为导向,查找分两步走，先查找普通索引，然后再通过主键索引找到数据
		索引创建:
			对于区分度比较高的字段创建索引是个好主意，where条件后面的字段，以及join子句列出的字段
	3.sql语句，增删改查
	4.分表，分库
		merge-mysiam 引擎，可以对mysiam表进行分表管理
	5.mysql主从复制，读写分离
		主从复制：配置master/slave 在每次主服务器更新完成后，master在二进制日志记录这些改变，slave复制日志文件，开启线程同步数据，分为异步和同步
		读写分离：
			基于程序代码实现，在代码中根据select，insert进行路由分类，性能好，但是有时代码更改麻烦
			基于中间代理层实现，代理数据库服务器收到应用服务器的请求后根据判断自动转发到不同的后端数据库，例如，mysql_proxy,atlas,阿里巴巴的Amoeba
	5.数据库优化
	6.数据库的常见三大范式
		第一范式：强调的是列的原子性，即列不能够再分成其他几列
		第二范式：在第一范式的基础上，第二范式需要确保数据库表中的每一列都和主键相关，而不能只与主键的某一部分相关（主要针对联合主键而言）。也就是说在一个数据库表中，一个表中只能保存一种数据，不可以把多种数据保存在同一张数据库表中，多的数据可以创建外键，关联字段来解决
		第三范式：一个数据库表中不包含已在其它表中已包含的非主关键字信息，避免出现冗余字段
		

缓存:
	memcache
		数据类型：string(key/value)
	redis
		数据类型：string(key/value),list,hash,set,sorted set
		持久化：
			RDB模式 dump.rbd
			AOF模式 appendonly.aof
			存放目录:/var/lib/redis/


框架:
	1.thinkphp,zend framework2,ci,yil,
	2.mvc
	3.路由
	4.组件
	

web服务器：
	1.apache
	2.nginx
	

其他技术:

	页面静态化
		第一种：ob_start,ob_end_flush,ob_get_clean,ob_get_contents等函数将输出内容保存到静态html文件中，下次直接从静态文件返回内容输出
	负载均衡
	大数据访问
	消息队列
		应用场景：为了更快的响应客户端的请求，先给用户一个成功的提示，然后将一些需要花更多时间处理的（不需要马上回复的）任务放入消息队列，交由后端异步处理，如：发邮件，短信通知等
		1.mysql实现消息队列：将要处理的消息信息存入数据库表里面，然后通过定时任务每次从表里面取适量数据进行处理，处理完成更新字段状态。
		2.redis实现消息队列：将要处理的消息信息存入redis的list中，然后每次取出一条来执行处理
		3.redis的消息订阅和发布，
		4.php扩展 php-resque


linux:
	1.linux的常用命令
	2.运维
