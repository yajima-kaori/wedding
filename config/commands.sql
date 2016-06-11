-- create database testdatabase;

use testdatabase;

-- grant all on testdatabase. * to testuser@localhost identified by '9999';

drop table question;
create table question (
  id int primary key auto_increment,
  title varchar(255) not null default '',
  step int not null default 0,
  cheched_at datetime,
  updated_at datetime
);

insert into question(title,step,cheched_at,updated_at) values(
  '挙式エリアを選んでね！',0,now(),now()
);
insert into question(title,step,cheched_at,updated_at) values(
  '気になるウェディングスタイルは？',1,now(),now()
);
insert into question(title,step,cheched_at,updated_at) values(
  'こだわりポイントは？',2,now(),now()
);

drop table question_choice;
create table question_choice (
  id int primary key auto_increment,
  question_id int not null,
  label varchar(255) not null default '',
  image varchar(255) not null default '',
  sort_num int not null default 0,
  cheched_at datetime,
  updated_at datetime
);

insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  1,'首都圏','image/1_1.jpg',now(),now(),1
);
insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  1,'関西','image/1_2.jpg',now(),now(),2
);
insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  1,'東海','image/1_3.jpg',now(),now(),3
);
insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  1,'北海道','image/1_4.jpg',now(),now(),4
);
insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  1,'東北','image/1_5.jpg',now(),now(),5
);
insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  1,'九州','image/1_6.jpg',now(),now(),6
);

insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  2,'大人の“きちんと”感','image/2_1.jpg',now(),now(),1
);
insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  2,'シンプルウェディング','image/2_2.jpg',now(),now(),2
);
insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  2,'再婚、パパママ婚…柔軟な対応','image/2_3.jpg',now(),now(),3
);

insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  3,'駅徒歩5分以内','image/3_1.jpg',now(),now(),1
);
insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  3,'30名以下可','image/3_2.jpg',now(),now(),2
);
insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  3,'貸切･フロア貸切可','image/3_3.jpg',now(),now(),3
);
insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  3,'結納食事会プラン有','image/3_4.jpg',now(),now(),4
);
insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  3,'短期間で準備可能','image/3_5.jpg',now(),now(),5
);
insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  3,'オリジナルメニュー可','image/3_6.jpg',now(),now(),6
);
insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  3,'写真プラン有','image/3_7.jpg',now(),now(),7
);
insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  3,'オリジナルメニュー可','image/3_8.jpg',now(),now(),8
);
insert into question_choice(question_id,label,image,cheched_at,updated_at,sort_num) values(
  3,'料理試食相談会','image/3_9.jpg',now(),now(),9
);

