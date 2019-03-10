create table roles
(
  id        int auto_increment
    primary key,
  user      int         not null,
  abteilung varchar(20) not null,
  constraint roles_user_id_fk
    foreign key (user) references user (id)
);

INSERT INTO tsvm.roles (id, user, abteilung) VALUES (1, 1, 'tennis');
INSERT INTO tsvm.roles (id, user, abteilung) VALUES (2, 2, 'hauptabteilung');
INSERT INTO tsvm.roles (id, user, abteilung) VALUES (3, 2, 'ski');
INSERT INTO tsvm.roles (id, user, abteilung) VALUES (4, 2, 'fitness');
INSERT INTO tsvm.roles (id, user, abteilung) VALUES (5, 3, 'tennis');
INSERT INTO tsvm.roles (id, user, abteilung) VALUES (6, 4, 'tennis');