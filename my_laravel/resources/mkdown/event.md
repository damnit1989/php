# 1. MySQL定时清除记录说明

## 1.1. 事件设置

确认事件设置是否开启

```sql
SHOW VARIABLES LIKE 'event_scheduler';
```

如果值为OFF，则执行命令开启

```sql
set global event_scheduler = on
```

## 1.2. 创建存储过程

首先定义一个存储过程，del_data，传入一个int参数就是保留的数据天数,过程的内容就是删除 simplecrc.gf_admin_syslog,simplecrc.gf_system_log表保留天数外的数据。就是多少天之后删除该数据。

```sql
CREATE DEFINER=`root`@`%` PROCEDURE `del_data`(IN `date_inter` int)
BEGIN
    delete from simplecrc.gf_admin_syslog where create_time < date_sub(curdate(), interval date_inter day);
    delete from simplecrc.gf_system_log where create_time < date_sub(curdate(), interval date_inter day);
END
```

## 1.3. 创建事件

定义del_event，在Event事件中定义事件执行的开始事件和频率，事件设置成Enable，并且到点的时候执行del_data存储过程（传进去的天数是30天），注：可以写入sql文件中

```sql
create event del_event  
on schedule 
EVERY 1 day  
STARTS '2019-07-31 00:00:00'  
ON COMPLETION  PRESERVE ENABLE  
do  call del_data(30)
```

从2019-07-31起开始每天执行一次这个事件
ON COMPLETION [NOT] PRESERVE ：表示当事件不会再发生的情况下，删除事件（注意特定时间执行的事件，如果设置了该参数，执行完毕后，事件将被删除，不想删除的话可以设置成ON COMPLETION PRESERVE）,ENABLE：表示系统将执行这个事件。

## 1.4. 查看事件

```sql
show events
```

## 1.5. 关闭事件

```sql
alter event demo_event on completion preserve disable;
```

## 1.6. 删除事件

```sql
DROP EVENT del_event
```

## 1.7. 频率说明

每一天  
EVERY 1 DAY

每一秒  
EVERY 1 second
