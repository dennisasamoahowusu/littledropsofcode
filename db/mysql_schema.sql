drop table if exists users;
create table users(
    user_id int not null auto_increment,
    username varchar(20) not null,
    password varchar(50) not null default '',
    fullname varchar(50) not null default '',
    email varchar(60) not null default '',
    reg_date datetime not null,
    status enum('active', 'inactive') not null,
    primary key(user_id),
    unique(username),
    unique(email));                            

drop table if exists log_types;
create table log_types(
    type_id int not null auto_increment,
    log_type varchar(50),
    primary key(type_id),
    unique(log_type));

drop table if exists activity_log;
create table activity_log(
    log_id int not null auto_increment,
    log_date datetime not null,
    log_type int not null,
    log_user int not null,
    log_summary text,
    primary key(log_id));

