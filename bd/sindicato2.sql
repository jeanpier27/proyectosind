drop DATABASE IF EXISTS sindicato2;
CREATE DATABASE sindicato2;
use sindicato2;

CREATE TABLE tb_personas (
  id_persona int primary key AUTO_INCREMENT ,
  cedula_ruc varchar(13) NOT NULL,
  nombre varchar(30) NOT NULL,
  apellido varchar(30) NOT NULL,
  telefono1 varchar(10) NOT NULL,
  telefono2 varchar(10),
  telefono3 varchar(10),
  direccion varchar(50),
  correo varchar(25)
);

create table tb_socio(
	id_socio int primary key AUTO_INCREMENT,
	id_persona int,
	valor_ingreso float,
	tipo_licencia varchar(2),
	estado varchar(15),
	foreign key(id_persona) references tb_personas (id_persona)
);

create table tb_estudiantes(
	id_estudiante int primary key AUTO_INCREMENT,
	id_persona int,
	valor float,
	promocion varchar(20),
	estado varchar(10),
	foreign key(id_persona) references tb_personas (id_persona)
);

create table tb_empleados(
	id_empleados int primary key AUTO_INCREMENT,
	id_persona int,
	cargo varchar(20),
	sueldo float,
	estado varchar(10),
	foreign key(id_persona) references tb_personas (id_persona)
); 

create table tb_plan_cuentas(
  id_plan_cuentas varchar(30) not null primary key,
  nombre varchar(100),
  saldo float,
  estado varchar(10)
);

create table tb_plan_subcuentas(
  id_subcuentas varchar(30) not null primary key,
  id_plan_cuentas varchar(30),
  nombre varchar(100),
  saldo float,
  estado varchar(10),
  foreign key(id_plan_cuentas) references tb_plan_cuentas (id_plan_cuentas)
);

create table tb_ingreso_escuela(
  id_ingreso_escuela int primary key AUTO_INCREMENT,
  id_persona int,
  fecha datetime,
  descripcion text,
  comprabante_n int,
  comprabante_banco varchar(30),
  saldo float,
  observacion varchar(50),
  foreign key(id_persona) references tb_personas (id_persona)
);

create table tb_ingreso_sindicato(
  id_ingreso_escuela int primary key AUTO_INCREMENT,
  id_persona int,
  fecha datetime,
  descripcion text,
  comprabante_n int,
  comprabante_banco varchar(30),
  saldo float,
  observacion varchar(50),
  foreign key(id_persona) references tb_personas (id_persona)
);

create table tb_egreso_escuela(
  id_egreso_escuela int primary key AUTO_INCREMENT,
  id_persona int,
  fecha datetime,
  descripcion text,
  comprabante_n int,
  cheque int
  saldo float,
  observacion varchar(50),
  foreign key(id_persona) references tb_personas (id_persona)
);

create table tb_egreso_sindicato(
  id_egreso_escuela int primary key AUTO_INCREMENT,
  id_persona int,
  fecha datetime,
  descripcion text,
  comprabante_n int,
  cheque int,
  saldo float,
  observacion varchar(50),
  foreign key(id_persona) references tb_personas (id_persona)
);

create table tb_factura(
  id_factura int primary key AUTO_INCREMENT,
  id_persona int,
  fecha datetime,
  descripcion text,
  subtotal float,
  iva float,
  observacion varchar(50),
  foreign key(id_persona) references tb_personas (id_persona)
);

create table tb_tipo_usuario(
	id_tipo_usuario int AUTO_INCREMENT primary key,
	tipo_usuario text,
);

INSERT INTO tb_tipo_usuario (`id_tipo_usuario`, `tipo_usuario`) VALUES
(1, 'SECRETARIO_GENERAL'),
(2, 'SECRETARIO_FINANCIERO'),
(3, 'TESORERO'),
(4, 'SECRETARIA'),
(5, 'ESTUDIANTE'),
(6, 'SOCIO'),
(7, 'DOCENTE'),
(8, 'INSPECTOR'),
(9, 'PEDAGOGO'),
(10, 'CONTADOR');

create table tb_usuarios(
	id_usuarios int AUTO_INCREMENT primary key,
	id_persona int,
	usuario varchar(15),
	contraseña varchar(15),
	id_tipo_usuario int,
	foreign key(id_persona) references tb_personas (id_persona)
	foreign key(id_tipo_usuario) references tb_tipo_usuario (id_tipo_usuario)
);