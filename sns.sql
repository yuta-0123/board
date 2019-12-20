drop database if exists sns;
create database sns default character set utf8 collate utf8_general_ci;
grant all on sns.* to 'root'@'localhost' identified by 'password';
use sns;

create table message (
	id int auto_increment primary key, 
	view_name varchar(100) not null,
	message text not null,  
	post_time datetime not null
);

create table users (
	id int auto_increment primary key, 
	name varchar(100) not null, 
	email varchar(255) not null unique, 
	view_name varchar(100) not null, 
	password varchar(255) not null
);
