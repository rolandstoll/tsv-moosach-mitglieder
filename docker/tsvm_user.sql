create table user
(
  id        int auto_increment
    primary key,
  login     varchar(50) not null,
  password  varchar(60) not null,
  firstname varchar(50) null,
  lastname  varchar(50) null,
  email     varchar(50) null,
  constraint user_user_uindex
    unique (user)
);

INSERT INTO tsvm.user (id, login, password, firstname, lastname, email) VALUES (1, 'rstoll', 'e10adc3949ba59abbe56e057f20f883e', 'Roland', 'Stoll', 'r.stoll@outlook.com');
INSERT INTO tsvm.user (id, login, password, firstname, lastname, email) VALUES (2, 'mdietel', 'e10adc3949ba59abbe56e057f20f883e', 'Manfred', 'Dietel', 'manfred.dietel@arcor.de');
INSERT INTO tsvm.user (id, login, password, firstname, lastname, email) VALUES (3, 'ttriller', 'e10adc3949ba59abbe56e057f20f883e', 'Thomas', 'Triller', 'thomasitriller@gmail.com');
INSERT INTO tsvm.user (id, login, password, firstname, lastname, email) VALUES (4, 'shartmann', 'e10adc3949ba59abbe56e057f20f883e', 'Sylvia', 'Hartmann', 'sylviahartmann49@t-online.de');