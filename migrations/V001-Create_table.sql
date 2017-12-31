create table usuario.membros(
  member_id  serial primary key not null,
  cpf varchar(11) not null unique,
  nome varchar(45) not null,
  dt_aniver varchar(10) not null,
  tel_cel varchar(11),
  email varchar(45),
  senha varchar(50) not null,
  usu_ativ boolean default false not null ,
  level_acess int not null default '1',
  data_cad timestamptz not null,
  data_ult_login timestamptz
);