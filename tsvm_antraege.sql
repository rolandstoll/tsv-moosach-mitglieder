create table antraege
(
  id       int auto_increment
    primary key,
  nachname varchar(50) not null,
  vorname  varchar(50) not null,
  email    varchar(50) not null,
  data     mediumtext  not null,
  created  datetime    not null
);

