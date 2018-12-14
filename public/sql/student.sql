set names utf8;
set foreign_key_checks = 0;

-- --------------------------
-- Table structure for `yunzhi_student`
-- --------------------------

drop Table if exists `yunzhi_student`;
create table `yunzhi_student`(
    `id` int(11) unsigned not null auto_increment,
    `name` varchar(40) not null default '' comment '姓名',
    `num` varchar(40) not null default '',
    `sex` tinyint(2) not null default '0',
    `klass_id` int(11) not null default '0',
    `email` varchar(40) not null default '',
    `create_time` int(11) not null default '0',
    `update_time` int(11) not null default '0',
    primary key (`id`)
) engine=myisam auto_increment=7 default charset=utf8;

-- ----------------------------
-- Records of `yunzhi_student`
-- ----------------------------

begin;
insert into `yunzhi_student` values
    ('1', '徐琳杰', '111', '0', '1', 'xulinjie@yunzhiclub.com', '0', '0'), 
    ('2', '魏静云', '112', '1', '2', 'weijingyun@yunzhiclub.com', '0', '0'), 
    ('3', '刘茜', '113', '0', '2', 'liuxi@yunzhiclub.com', '0', '0'), 
    ('4', '李甜', '114', '1', '1', 'litian@yunzhiclub.com', '0', '0'), 
    ('5', '李翠彬', '115', '1', '3', 'licuibin@yunzhiclub.com', '0', '0'), 
    ('6', '孔瑞平', '115', '0', '4', 'kongruiping@yunzhiclub.com', '0', '0');
commit;

set foreign_key_checks = 1;