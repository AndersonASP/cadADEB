CREATE TABLE membros.tb_acess_level (
	id_level serial NOT  null unique,
	ds_nome_level varchar(100) NOT NULL,
	CONSTRAINT tb_acess_level_pkey PRIMARY KEY (id_level)
);

CREATE TABLE membros.tb_status (
	id_status serial NOT NULL unique ,
	ds_status varchar(100) NOT NULL,
	CONSTRAINT tb_status_pkey PRIMARY KEY (id_status)
);

CREATE TABLE membros.membros (
  member_id  serial primary key not null unique ,
  cpf varchar(11) not null,
  nome varchar(45) not null,
  dt_aniver varchar(10) not null,
  tel_cel varchar(11),
  email varchar(45),
  senha varchar(50) not null,
  level_acess int not null default '1',
  id_status int not null default '1',
  data_cad timestamptz not null,
  data_ult_login timestamptz,
  FOREIGN KEY (level_acess) references membros.tb_acess_level(id_level) on DELETE
  cascade ,
  FOREIGN KEY (id_status) references membros.tb_status(id_status) on delete cascade

);