create database if not exists bets
default character set utf8 collate utf8_slovak_ci;

use bets;

drop table users;
drop table role;

create table role (
  id_role int(1),
  name varchar(20),
  primary key (id_role)
);

create table if not exists users (
  id_users int(11) AUTO_INCREMENT,
  id_role int(1),
  firstname varchar(30) not null,
  surname varchar(30) not null,
  email varchar(50) not null,
  password varchar (50) not null,
  phone varchar(20) not null,
  ip_address varchar(15),
  primary key (id_users),
  foreign key (id_role) references role(id_role) on update cascade on delete restrict
);

insert into role(id_role, name) values (0, 'admin');
insert into role(id_role, name) values (1, 'user');

insert into users(id_role, email, password) values(0, 'sakac.m@gmail.com', 'sakinko');