create database meuemprego;

use meuemprego;

create table usuarios(
  id int not null primary key AUTO_INCREMENT,
  nome varchar(100) not null,
  sobrenome varchar(60) not null,
  email varchar(150) not null,
  senha varchar(32) not null,
  nivel tinyint not null default 0,
  ativo tinyint not null default 1,
  deleted_at datetime default null,
  updated_at datetime default null,
  created_at datetime default current_timestamp
);

insert into
  usuarios (nome, email, senha, nivel)
values
  (
    'fabio',
    'fabio@gmail.com',
    '63a9f0ea7bb98050796b649e85481845',
    1
  );

#senha root

create table empregos (
  id int not null auto_increment primary key,
  id_usuario int not null,
  titulo varchar(100) not null,
  descricao text not null,
  modalidade varchar(100) not null,
  habilidade text not null,
  ativo tinyint default 1,
  qtde_vaga tinyint default 1,
  local_trabalho text not null,
  telefone varchar(20),
  email varchar(100) not null,
  salario decimal(10, 2),
  deleted_at datetime default null,
  updated_at datetime default null,
  created_at datetime default current_timestamp
);

insert into
  empregos (
    id_usuario,
    titulo,
    descricao,
    modalidade,
    habilidade,
    ativo,
    qtde_vaga,
    local_trabalho,
    telefone,
    email,
    salario
  )
values
  (
    1,
    'Programador VBA',
    'Programar rotinas em VBA para Excel',
    'Presencial',
    'Excel;Word,VBA',
    1,
    2,
    'Senai Cuiabá',
    '65992436228',
    'fabiofaria@gmail.com',
    2000.55
  );

insert into
  empregos (
    id_usuario,
    titulo,
    descricao,
    modalidade,
    habilidade,
    ativo,
    qtde_vaga,
    local_trabalho,
    telefone,
    email,
    salario
  )
values
  (
    1,
    'Programador Junior',
    'Programar pequenas rotinas em projetos da empresa',
    'Home Office',
    'PHP;JAVA;NODE',
    1,
    1,
    'TDS',
    '65992436228',
    'tds@gmail.com',
    12500.00
  );

insert into
  empregos (
    id_usuario,
    titulo,
    descricao,
    modalidade,
    habilidade,
    ativo,
    qtde_vaga,
    local_trabalho,
    telefone,
    email,
    salario
  )
values
  (
    1,
    'Programador Pleno',
    'Atuar em projetos de modernização e/ou automatização de processos internos; Integrar ERP Protheus com demais ferramentas.Outros requisitos: Desejável conhecimento básico Oracle; Integrações API/REST/Webservice; Ensino Superior completo nas áreas de Sistemas de informação',
    'Presencial',
    'Php;Java;Node;React,Vue',
    1,
    3,
    'TDS',
    '65992436228',
    'tds@gmail.com',
    18500.00
  );