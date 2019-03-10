create table antrag_abteilung_status
(
  id         int auto_increment
    primary key,
  antrag     int                           not null,
  abteilung  varchar(30)                   not null,
  status     varchar(20) default 'pending' not null,
  created    datetime                      null,
  createdby  varchar(20)                   null,
  modified   datetime                      null,
  modifiedby varchar(20)                   null,
  constraint antrag_abteilung_status_antraege_id_fk
    foreign key (antrag) references antraege (id)
);
