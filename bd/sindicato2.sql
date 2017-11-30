drop DATABASE IF EXISTS sindicato3;
CREATE DATABASE sindicato3;
use sindicato3;
-- se agrego id_plan_cuentas a las tablas ingreso escuela y sindicato
CREATE TABLE tb_personas (
  id_persona int primary key AUTO_INCREMENT ,
  cedula_ruc varchar(13) NOT NULL,
  nombre varchar(30) NOT NULL,
  apellido varchar(30) NOT NULL,
  telefono1 varchar(10) NOT NULL,
  telefono2 varchar(10),
  telefono3 varchar(10),
  direccion varchar(50),
  correo varchar(25),
  estado_civil varchar(20),
  fecha_n date,
  sexo varchar(10)
);

insert into tb_personas (cedula_ruc,nombre,apellido,telefono1,telefono2,telefono3,direccion,correo,estado_civil) values('0916410350','DONALD UBALDO','PASTOR ASTUDILLO','0992971839','0','0','NARANAJL','donalubaldo@hotmail.com','CASADO(A)');

  CREATE TABLE tb_proveedores (
  id_proveedores int primary key AUTO_INCREMENT ,
  ruc varchar(13) NOT NULL,
  nombres varchar(100) NOT NULL,
  telefono varchar(10) NOT NULL,
  direccion varchar(50),
  correo varchar(25),
  fecha_ingreso timestamp,
  estado varchar(10),
  id_usuario int,  
  activi_comercial text
);
  create table tb_tipo_usuario(
  id_tipo_usuario int AUTO_INCREMENT primary key,
  tipo_usuario text
);

INSERT INTO tb_tipo_usuario (`id_tipo_usuario`, `tipo_usuario`) VALUES
(1, 'SECRETARIO_GENERAL'),
(2, 'SECRETARIO_FINANCIERO'),
(3, 'TESORERO'),
(4, 'SECRETARIA'),
(5, 'DOCENTE'),
(6, 'INSPECTOR'),
(7, 'PEDAGOGO'),
(8, 'CONTADOR');

  create table tb_usuarios(
  id_usuarios int AUTO_INCREMENT primary key,
  id_persona int,
  contraseña varchar(15),
  id_tipo_usuario int,
  estado varchar(10),
  acceso varchar(40)
  foreign key(id_persona) references tb_personas (id_persona),
  foreign key(id_tipo_usuario) references tb_tipo_usuario (id_tipo_usuario)
);

insert into tb_usuarios (id_persona,contraseña,id_tipo_usuario,estado) values(1,'123','1','ACTIVO');

  CREATE TABLE tb_empleado (
    id_empleado int primary key AUTO_INCREMENT ,
    id_persona int,
    sueldo float(10,2) NOT NULL,
    cargo varchar(50),
    fecha_inicio date,
    fecha_fin date,
    estado varchar(10),
    observacion text,
    foreign key(id_persona) references tb_personas (id_persona)
    );

  CREATE TABLE tb_plan_cuenta (
    id_plan_cuenta varchar(40) primary key,
    descripcion text NOT NULL
    );

   CREATE TABLE tb_plan_subcuentas (
    id_plan_subcuentas varchar(40) primary key ,
    id_plan_cuenta varchar(40),
    descripcion text NOT NULL,
    foreign key(id_plan_cuenta) references tb_plan_cuenta (id_plan_cuenta)
    );

   create table tb_marca(
  id_marca int primary key AUTO_INCREMENT,
  descripcion varchar(50)
 
 );

create table tb_modelo(
  id_modelo int primary key AUTO_INCREMENT,
  id_marca int,
  descripcion varchar(50),
 foreign key(id_marca) references tb_marca (id_marca)
 );


  CREATE TABLE tb_vehiculo (
  id_vehiculo int primary key AUTO_INCREMENT ,
  fecha_factura date,
  placa varchar(50),
  id_marca int,
  id_modelo int,
  motor varchar(50),
  chasis varchar(50),
  año_produccion varchar(50),
  fecha_inicio_poliza date,
  fecha_fin_poliza date,
  id_proveedores int,
  fecha_venci_matricula date,
  estado varchar(10),
  observacion text,
  aseguradora int,
  foreign key(id_proveedores) references tb_proveedores (id_proveedores),
  foreign key(id_marca) references tb_marca (id_marca),
  foreign key(id_modelo) references tb_modelo (id_modelo),
  foreign key(aseguradora) references tb_proveedores (id_proveedores)
);

  CREATE TABLE tb_mantenimiento_vehiculo (
  id_mant_vehiculo int primary key AUTO_INCREMENT ,
  id_vehiculo int,
  n_factura varchar(18) NOT NULL,
  fecha_fact date,
 descripcion text,
  estado varchar(10),
  observacion text,
  valor float(10,2),
  id_proveedor int,
  foreign key(id_vehiculo) references tb_vehiculo (id_vehiculo),
  foreign key(id_proveedor) references tb_proveedores (id_proveedores)
);

create table tb_pagos_socio(
id_pagos_socio int primary key AUTO_INCREMENT,
descripcion text,
valor float(10,2)
);

create table tb_pagos_contable(
id_pagos_contable int primary key AUTO_INCREMENT,
descripcion text,
valor float(10,2),
observacion text
);

insert into tb_pagos_socio (descripcion,valor) values('INSCRIPCION',250),('CUOTAS MENSUALES',7.50),('MULTAS',11),('FONDO DE CESANTIA',2.25);


create table tb_socio(
	id_socio int primary key AUTO_INCREMENT,
	id_persona int NOT NULL,
	tipo_licencia varchar(2),
  fecha_ingreso date,
	estado varchar(15),
  id_pagos_socio int,
  fecha_naci date,
  fecha_registro date, 
  observacion text,
  beneficiario text,
	foreign key(id_persona) references tb_personas (id_persona),
  foreign key(id_pagos_socio) references tb_pagos_socio (id_pagos_socio)
);

 CREATE TABLE tb_reunion (
  id_reunion int primary key AUTO_INCREMENT ,
  fecha datetime NOT NULL,
  descripcion text NOT NULL,
  estado varchar(10) NOT NULL,
  observacion varchar(50),
  verificado varchar(1)
);


create table tb_bancos(
  id_banco int primary key  AUTO_INCREMENT,
  n_cuenta text,
  banco text,
  descripcion text,
  saldo float (10,2),
  estado varchar(10)
);  

insert into tb_bancos (n_cuenta,banco,descripcion,saldo,estado) values('1080693962','MACHALA','ESCUELA',300000,'ACTIVO'),('1080602444','MACHALA','ADMINISTRATIVA',1000,'ACTIVO'),('700017532','MACHALA','COFRES',5000,'ACTIVO'),('1080620310','MACHALA','CUENTA MULTAS',800,'ACTIVO'),('2100055804','PICHINCHA','FONDO DE CESANTIA',800,'ACTIVO');


create table tb_recaudaciones(
  id_recaudaciones int primary key AUTO_INCREMENT,
  id_persona int,
  fecha date,
  año varchar(4),
  mes varchar(2),
  id_pagos_socio int,
  comprabante_n int,
  verificacion varchar(1),
  estado varchar(10), 
  observacion varchar(50), 
  valor float(10,2),
  abonos float(10,2),
  foreign key(id_pagos_socio) references tb_pagos_socio (id_pagos_socio),
  foreign key(id_persona) references tb_personas (id_persona)
);

  CREATE TABLE tb_facturasxcobrar (
  id_facturasxcobrar int primary key AUTO_INCREMENT ,
  id_proveedores int,
  fac_ntv varchar(1),
  n_factura_ntv varchar(18),
  fecha_fac1 date,
  aut_sri varchar(10),
  fecha_fact date,
  descripcion text,
  subtotal float(10,2),
  sobtotal_c float(10,2),
  descuento float(10,2),
  iva float(10,2),
  total float(10,2),
  n_retenc int,
  porc_renta float(10,2),
  valor_renta float(10,2),
  porc_iva float(10,2),
  valor_iva float(10,2),
  valor_pagar float(10,2),
  fecha_re timestamp,
  estado varchar(10),
  observacion text,
  id_usuarios int,
  foreign key(id_proveedores) references tb_proveedores (id_proveedores),
  foreign key(id_usuarios) references tb_usuarios (id_usuarios)
);

create table tb_producto(
  id_producto int primary key AUTO_INCREMENT,
  descripcion text,
  valor_compra float(10,2),
  estado varchar(10),
  observacion text
);

create table tb_inventario(
  id_inventario int primary key AUTO_INCREMENT,
  id_producto int,
  cantidad int,
  foreign key(id_producto) references tb_producto (id_producto)
);

create table tb_inventario_historico(
  id_inventario_historico int primary key AUTO_INCREMENT,
  id_producto int,
  entrada int,
  salida int,
  fecha timestamp,
  nombres text,
  foreign key(id_producto) references tb_producto (id_producto)
);

    CREATE TABLE tb_sueldos (
    id_sueldos int primary key AUTO_INCREMENT ,
    id_persona int,
    sueldo float(10,2),
    f_reserva float(10,2),
    iess float(10,2),
    h_extras int,
    descuento float(10,2),
    descripcion_d text,
    tapagar float(10,2),
    fecha date ,
    id_egreso_escuela int,
    estado varchar(10),
    foreign key(id_persona) references tb_personas (id_persona)
 
  );


create table tb_ingreso_escuela(
  id_ingreso_escuela int primary key AUTO_INCREMENT,
  id_persona int,
   id_banco int,
  fecha date,
  descripcion text,
  comprabante_n int,
  comprabante_banco varchar(30),
  saldo float(10,2),
  observacion text,
  estado varchar(10),
  id_plan_subcuentas varchar(40),
  foreign key(id_banco) references tb_bancos (id_banco),
  foreign key(id_persona) references tb_personas (id_persona),
  foreign key(id_plan_subcuentas) references tb_plan_subcuentas (id_plan_subcuentas)
);

create table tb_ingreso_sindicato(
  id_ingreso_escuela int primary key AUTO_INCREMENT,
  id_persona int,
  id_banco int,
  fecha date,
  descripcion text,
  comprabante_n int,
  comprabante_banco varchar(30),
  saldo float(10,2),
  observacion text,
  estado varchar(10),
  id_plan_subcuentas varchar(40),
  foreign key(id_banco) references tb_bancos (id_banco),
  foreign key(id_persona) references tb_personas (id_persona),
  foreign key(id_plan_subcuentas) references tb_plan_subcuentas (id_plan_subcuentas)
);

create table tb_egreso_escuela(
  id_egreso_escuela int primary key AUTO_INCREMENT,
  id_proveedor int,
  id_banco int,
  fecha date,
  descripcion text,
  comprabante_n int,
  cheque int,
  saldo float(10,2),
  observacion text,
  estado varchar(10),
  foreign key(id_banco) references tb_bancos (id_banco),
  foreign key(id_proveedor) references tb_proveedores (id_proveedores),
  foreign key(id_plan_cuentas) references tb_plan_cuentas (id_plan_cuentas)
);




create table tb_egreso_sindicato(
  id_egreso_escuela int primary key AUTO_INCREMENT,
  id_proveedor int,
  id_banco int,
  id_plan_cuentas int,
  fecha date,
  descripcion text,
  comprabante_n int,
  cheque int,
  saldo float(10,2),
  observacion text,
  estado varchar(10),
  foreign key(id_banco) references tb_bancos (id_banco),
  foreign key(id_proveedor) references tb_proveedores (id_proveedores),
  foreign key(id_plan_cuentas) references tb_plan_cuentas (id_plan_cuentas)
);

create table tb_detalle_egreso_sindi(
  id_detalle_egreso_sindi int primary key AUTO_INCREMENT,
  comp_egreso_sindicato int,
  id_facturasxcobrar int,
  foreign key(id_facturasxcobrar) references tb_facturasxcobrar (id_facturasxcobrar)

);


create table tb_detalle_egreso_escuela(
  id_detalle_egreso_sindi int primary key AUTO_INCREMENT,
  comp_egreso_escuela int,
  id_facturasxcobrar int,
  foreign key(id_facturasxcobrar) references tb_facturasxcobrar (id_facturasxcobrar)

);

create table tb_factura(
  id_factura int primary key AUTO_INCREMENT,
  n_factura int,
  id_persona int,
  fecha datetime,
  descripcion text,
  subtotal float(10,2),
  subtotalcero float(10,2),
  descuento float(10,2),
  iva float (10,2),
  observacion varchar(50),
  estado varchar(10),
  foreign key(id_persona) references tb_personas (id_persona)
);


CREATE TABLE tb_justificacion (
  id_justificacion int primary key AUTO_INCREMENT ,
  id_reunion int,
  id_persona int,
  descripcion text NOT NULL,
  estado varchar(10) NOT NULL,
  observacion varchar(50),
  id_usuarios int,
  fecha timestamp,
  foreign key(id_reunion) references tb_reunion (id_reunion),
  foreign key(id_usuarios) references tb_usuarios (id_usuarios),
  foreign key(id_persona) references tb_personas (id_persona)
);

CREATE TABLE tb_asistencia (
  id_asistencia int primary key AUTO_INCREMENT ,
  id_persona int,
  id_reunion int,
  asistencia varchar(1),
  fecha timestamp,
  id_usuarios int,
  foreign key(id_persona) references tb_personas (id_persona),
  foreign key(id_reunion) references tb_reunion (id_reunion),
  foreign key(id_usuarios) references tb_usuarios (id_usuarios)
);

create table tb_beneficios(
  id_beneficio int AUTO_INCREMENT primary key,
  beneficio varchar(500), 
  estado varchar(10),
  valor float(10,2),
  abonos float(10,2)
);

insert into tb_beneficios (beneficio,estado,valor) values('SALON DE EVENTOS','DIA',340);
insert into tb_beneficios (beneficio,estado,valor) values('BUS GRANDE','DIA',70);
insert into tb_beneficios (beneficio,estado,valor) values('MESA DE BILLAR','HORAS',1);
insert into tb_beneficios (beneficio,estado,valor) values('CANCHAS SINTETICA','HORAS',15);


create table tb_alquiler(
  id_alquiler int AUTO_INCREMENT primary key,
  id_persona int,
  id_beneficio int,
  fecha_desde datetime,  
  fecha_hasta datetime,
  estado varchar(10),
  valor float (10,2),
  abonos float(10,2),
  descuento int,
  garantia int,
  estadogarantia varchar(10),
  foreign key(id_persona) references tb_personas (id_persona),
  foreign key(id_beneficio) references tb_beneficios (id_beneficio)
);

create table tb_alquiler_pagos(
  id_alquiler_pagos int AUTO_INCREMENT primary key,
  saldo float(10,2),
  comprobante_ingre int,
  id_alquiler int,
  estado varchar(10),
 foreign key(id_alquiler) references tb_alquiler (id_alquiler)
);

-- insert into tb_alquiler (id_persona,id_beneficio,fecha_desde,fecha_hasta,estado) values(1,2,'2017-07-9','2017-07-12','PAGADO');
-- insert into tb_alquiler (id_persona,id_beneficio,fecha_desde,fecha_hasta,estado) values(2,2,'2017-07-19','2017-07-23','ACTIVO');
-- insert into tb_alquiler (id_persona,id_beneficio,fecha_desde,fecha_hasta,estado) values(3,2,'2017-07-24','2017-07-26','ACTIVO');
-- insert into tb_alquiler (id_persona,id_beneficio,fecha_desde,fecha_hasta,estado) values(1,2,'2017-07-27 12:30:00','2017-07-27 18:30:00','ACTIVO');
-- insert into tb_alquiler (id_persona,id_beneficio,fecha_desde,fecha_hasta,estado) values(1,1,'2017-07-9','2017-07-12','ACTIVO');
-- insert into tb_alquiler (id_persona,id_beneficio,fecha_desde,fecha_hasta,estado) values(2,1,'2017-07-19','2017-07-23','ACTIVO');
-- insert into tb_alquiler (id_persona,id_beneficio,fecha_desde,fecha_hasta,estado) values(3,1,'2017-07-24','2017-07-26','ACTIVO');
-- insert into tb_alquiler (id_persona,id_beneficio,fecha_desde,fecha_hasta,estado) values(1,3,'2017-07-15 12:30:00','2017-07-15 18:30:00','ACTIVO');
-- insert into tb_alquiler (id_persona,id_beneficio,fecha_desde,fecha_hasta,estado) values(2,3,'2017-07-16 13:30:00','2017-07-16 19:30:00','ACTIVO');
-- insert into tb_alquiler (id_persona,id_beneficio,fecha_desde,fecha_hasta,estado) values(3,3,'2017-07-17 14:30:00','2017-07-17 20:30:00','ACTIVO');
-- insert into tb_alquiler (id_persona,id_beneficio,fecha_desde,fecha_hasta,estado) values(2,4,'2017-07-18 15:30:00','2017-07-18 21:30:00','ACTIVO');
-- insert into tb_alquiler (id_persona,id_beneficio,fecha_desde,fecha_hasta,estado) values(1,4,'2017-07-19 16:30:00','2017-07-19 22:30:00','ACTIVO');
-- insert into tb_alquiler (id_persona,id_beneficio,fecha_desde,fecha_hasta,estado) values(3,4,'2017-07-20 17:30:00','2017-07-20 23:30:00','ACTIVO');

create table tb_docente(
  id_docente int AUTO_INCREMENT primary key,
  id_usuarios int,
  sueldo float(10,2),  
  estado varchar(10),
  fecha_ingreso date,  
  fecha_salida date,
  observaciones text,
  foreign key(id_usuarios) references tb_usuarios (id_usuarios)
);

create table tb_promocion(
  id_promocion int primary key AUTO_INCREMENT,
  descripcion text,
  fecha_inicio date,
  fecha_fin date,
  estado varchar(10)
);


INSERT INTO tb_promocion (descripcion, fecha_inicio, fecha_fin) VALUES
('', '2017-01-1', '2017-07-30');

create table tb_pago_licencia(
  id_tipo_licencia int primary key AUTO_INCREMENT,
  tipo_licencia varchar(30),
  valor float(10,2),
  fecha date,
  estado varchar(10)
);

INSERT INTO tb_pago_licencia (tipo_licencia, valor, fecha, estado) VALUES
('Licencia tipo C', '1200.00', '2017-01-01','ACTIVO'),
('Licencia tipo D', '1600.00', '2017-01-01','ACTIVO'),
('Licencia tipo E', '1700.00', '2017-01-01','ACTIVO');

create table tb_estudiantes(
  id_estudiante int primary key AUTO_INCREMENT,
  id_persona int,
  fecha datetime,
  id_promocion int,
  horario varchar(25),
  valor float(10,2),
  abono float(10,2),
  observacion text,
  estado varchar(10),
  id_curso int,
  foreign key(id_promocion) references tb_promocion (id_promocion),
  foreign key(id_curso) references tb_curso (id_curso),
  foreign key(id_persona) references tb_personas (id_persona)  
);


create table tb_curso(
  id_curso int primary key AUTO_INCREMENT,
  curso varchar(2)
);

create table tb_curso_detalle(
id_curso_detalle int primary key AUTO_INCREMENT,
id_curso int,
id_estudiante int,
foreign key(id_estudiante) references tb_estudiantes (id_estudiante),
foreign key(id_curso) references tb_curso_detalle (id_curso)
);

create table tb_detalle_estudiante_pago(
  id_detalle_estudiante_pago int primary key AUTO_INCREMENT,
  id_estudiante int,  
  descripcion text,  
  fecha datetime,
  id_ingreso_escuela int,
  factura int,
  estado varchar(10),
  observacion text,
  foreign key(id_estudiante) references tb_estudiantes (id_estudiante),  
  foreign key(id_ingreso_escuela) references tb_ingreso_escuela (id_ingreso_escuela)
);

create table tb_asignaturas(
  id_asignatura int primary key AUTO_INCREMENT,
  asignatura text,
  descripcion text,
  prioridad text,
  estado varchar(10)
 );

create table tb_asignatura_docente(
  id_asignatura_docente int AUTO_INCREMENT primary key,
  id_docente int,
  id_asignatura int,
  id_curso int,
  foreign key(id_docente) references tb_docente (id_docente),
  foreign key(id_curso) references tb_curso (id_curso),
  foreign key(id_asignatura) references tb_asignaturas (id_asignatura)
);

create table tb_notas(
  id_notas int primary key AUTO_INCREMENT,
  id_asignatura_docente int,
  id_estudiante int,
  nota float(10,2),
  estado varchar(10),
  observacion text,
  verifica_pago int,
  foreign key(id_asignatura_docente) references tb_asignatura_docente (id_asignatura_docente),
  foreign key(id_estudiante) references tb_estudiantes (id_estudiante)

 );

create table tb_cantidad_curso(
  id_cantidad_curso int primary key AUTO_INCREMENT,
  descripcion text,
  cantidad int
  );



create table tb_actividad_comercial(
  id_actividad_comercial int primary key AUTO_INCREMENT,
  descripcion text
  );


create table tb_asistencia_alumnos(
  id_asistencia_alumnos int primary key AUTO_INCREMENT,
  fecha date,
  id_estudiante int,
  asistencia int,
  id_promocion int,
  id_asignatura int,
  id_curso int,
  observacion text,
  foreign key(id_estudiante) references tb_estudiantes (id_estudiante),
  foreign key(id_promocion) references tb_promocion (id_promocion),
  foreign key(id_asignatura) references tb_asignaturas (id_asignatura),
  foreign key(id_curso) references tb_curso (id_curso)

 );

create table tb_agregar_saldo_estudiante(
  id_agregar_saldo_estudiante int primary key AUTO_INCREMENT,
  descripcion text,
  cantidad float(10,2)
  );

drop procedure IF EXISTS insertar_persona;
DELIMITER $$
 
CREATE PROCEDURE insertar_persona(
           IN cedula varchar(10),
           IN nombre varchar(30),
           IN apellido varchar(30),
           IN telefon1 varchar(10),
           IN telefono2 varchar(10),
           IN telefono3 varchar(10),
           IN direccion varchar(50), 
           IN correo varchar(30), 
           IN estado_civil varchar(20),
           IN fecha_n date,
           IN sexo varchar(10)
         )
BEGIN

START TRANSACTION;
INSERT INTO tb_personas(cedula_ruc, nombre, apellido, telefono1, telefono2, telefono3, direccion,correo,estado_civil,fecha_n,sexo)VALUES(cedula,nombre,apellido,telefon1,telefono2,telefono3, direccion,correo,estado_civil,fecha_n,sexo);

COMMIT;    

END
$$
DELIMITER ;



drop procedure IF EXISTS insertar_socio;
DELIMITER $$
 
CREATE PROCEDURE insertar_socio(
           IN id_pers int, 
           IN tipo_li varchar(2),
           IN fecha_na date,
           IN fecha_ingre date,
           IN id_pagos_so int,
           IN abono float(10,2),
           IN fecha_regis date,
           IN descripcion text, 
           IN ingreso_n int, 
           IN comprobante_bco varchar(20),
           IN id_bancos int,
           IN beneficiarios text,
           IN plan_cuent varchar(40),
           IN observaciont text
         )
BEGIN
declare a float(10,2);
declare pago_socio float(10,2);
-- START TRANSACTION;
insert into tb_socio(id_persona,tipo_licencia,fecha_ingreso,estado,id_pagos_socio,fecha_naci,fecha_registro,observacion,beneficiario)values(id_pers,tipo_li,fecha_ingre,'ACTIVO',id_pagos_so,fecha_na,fecha_regis,'',beneficiarios);
set pago_socio=(select valor from tb_pagos_socio where id_pagos_socio=id_pagos_so);
INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES(id_pers,fecha_regis,'','',id_pagos_so,ingreso_n,'1','ACTIVO','',pago_socio,abono);

insert into tb_ingreso_sindicato(id_persona,id_banco,fecha,descripcion,comprabante_n,comprabante_banco,saldo,observacion,estado,id_plan_subcuentas)values(id_pers,id_bancos,fecha_regis,descripcion,ingreso_n,comprobante_bco,abono,observaciont,'ACTIVO',plan_cuent);
set a =(select saldo from tb_bancos where id_banco=id_bancos);
update tb_bancos set saldo=a+abono where id_banco=id_bancos;

-- COMMIT;    

END
$$
DELIMITER ;

drop procedure IF EXISTS insertar_multa;
DELIMITER $$
 
CREATE PROCEDURE insertar_multa(
           IN id_pers int, 
           IN abono float(10,2),
           IN fecha_regis date,  
           IN id_pagos int
         )
BEGIN
declare v_pagos float(10,2);
set v_pagos=(select valor from tb_pagos_socio where id_pagos_socio=id_pagos);
START TRANSACTION;
INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES(id_pers,fecha_regis,'','','3','','0','ACTIVO','',v_pagos,'');
COMMIT;    

END
$$
DELIMITER ;

drop procedure IF EXISTS actualizar_socio;
DELIMITER $$
 
CREATE PROCEDURE actualizar_socio(
           IN id_per int,
           IN nombres varchar(30),
           IN apellidos varchar(30),
           IN telefon1s varchar(10),
           IN telefono2s varchar(10),
           IN telefono3s varchar(10),
           IN direccions varchar(50), 
           IN correos varchar(30), 
           IN estado_civils varchar(20),
           IN tipo_lis varchar(2),
           IN fecha_nas date,
           IN fecha_ingres date,
           IN beneficiarioss text,
           IN observacions text,
           IN estados varchar(10)
         )
BEGIN

START TRANSACTION;
update tb_personas set nombre=nombres,apellido=apellidos,telefono1=telefon1s,telefono2=telefono2s,telefono3=telefono3s,direccion=direccions,correo=correos,estado_civil=estado_civils where id_persona=id_per;
update tb_socio set  tipo_licencia= tipo_lis,fecha_naci=fecha_nas,fecha_ingreso=fecha_ingres,beneficiario=beneficiarioss,observacion=observacions,estado=estados where id_persona=id_per;

COMMIT;    

END
$$
DELIMITER ;

drop procedure IF EXISTS actualizar_vehiculo;
DELIMITER $$
 
CREATE PROCEDURE actualizar_vehiculo(
           IN id_vehicul int,
           IN placas varchar(50),
           IN marcas int,
           IN modelos int,
           IN motors varchar(10),
           IN chasiss varchar(10),
           IN año_produccions varchar(10),
           IN fecha_inicio_polizas varchar(50), 
           IN fecha_fin_polizas varchar(30), 
           IN fecha_venci_matriculas varchar(20),
           IN observacions text,
           IN estados varchar(10)
         )
BEGIN

START TRANSACTION;
update tb_vehiculo set placa=placas,id_marca=marcas,id_modelo=modelos,motor=motors,chasis=chasiss,año_produccion=año_produccions,fecha_inicio_poliza=fecha_inicio_polizas,fecha_fin_poliza=fecha_fin_polizas,estado=estados,observacion=observacions,fecha_venci_matricula=fecha_venci_matriculas where id_vehiculo=id_vehicul;

COMMIT;    

END
$$
DELIMITER ;


drop procedure IF EXISTS actualizar_empleado;
DELIMITER $$
 
CREATE PROCEDURE actualizar_empleado(
           IN id_per int,
           IN nombres varchar(30),
           IN apellidos varchar(30),
           IN telefon1s varchar(10),
           IN telefono2s varchar(10),
           IN telefono3s varchar(10),
           IN direccions varchar(50), 
           IN correos varchar(30), 
           IN estado_civils varchar(20),           
           IN fecha_ini date,
           IN fecha_fi date,
           IN sueldos float(10,2),
           IN cargos varchar(50),
           IN observacions text,
           IN estados varchar(10)
         )
BEGIN

START TRANSACTION;
update tb_personas set nombre=nombres,apellido=apellidos,telefono1=telefon1s,telefono2=telefono2s,telefono3=telefono3s,direccion=direccions,correo=correos,estado_civil=estado_civils where id_persona=id_per;
update tb_empleado set  sueldo= sueldos,cargo=cargos,fecha_inicio=fecha_ini,fecha_fin=fecha_fi,observacion=observacions,estado=estados where id_persona=id_per;

COMMIT;    

END
$$
DELIMITER ;



drop procedure IF EXISTS ingresar_producto;
DELIMITER $$
 
CREATE PROCEDURE ingresar_producto(
           IN descripcions text,
           IN valor_compras float (10,2)
          
         )
BEGIN
declare a int;
START TRANSACTION;
insert into tb_producto (descripcion,valor_compra,estado,observacion)values(descripcions,valor_compras,'ACTIVO','');
set a =(select id_producto from tb_producto where descripcion=descripcions and valor_compra=valor_compras);
insert into tb_inventario(id_producto,cantidad)values(a,0);
COMMIT;    

END
$$
DELIMITER ;

drop procedure IF EXISTS ingreso_inventario;
DELIMITER $$
 
CREATE PROCEDURE ingreso_inventario(
           IN id_prod int,
           IN cantidads int,
           IN nombres text
          
         )
BEGIN
declare nomb text;
START TRANSACTION;
set nomb=(select nombres From tb_proveedores where id_proveedores=nombres);
update tb_inventario set cantidad=(cantidad+cantidads) where id_producto=id_prod;
insert into tb_inventario_historico(id_producto,entrada,salida,nombres)values(id_prod,cantidads,0,nomb);
COMMIT;    

END
$$
DELIMITER ;

drop procedure IF EXISTS salida_inventario;
DELIMITER $$
 
CREATE PROCEDURE salida_inventario(
           IN id_prod int,
           IN cantidads int,
           IN nombres text
         )
BEGIN
START TRANSACTION;
update tb_inventario set cantidad=(cantidad-cantidads) where id_producto=id_prod;
insert into tb_inventario_historico(id_producto,entrada,salida,nombres)values(id_prod,0,cantidads,nombres);
COMMIT;    

END
$$
DELIMITER ;

drop procedure IF EXISTS insertar_pagos_alquiler;
DELIMITER $$
 
CREATE PROCEDURE insertar_pagos_alquiler(
           IN id_per int,
           IN comprobante_ingreso int,
           IN Id_banco int,
           IN fechas date,
           IN Descripcion text,
           IN deposito varchar(50),
           IN saldos float(10,2),
           IN id_alqui int,
           IN id_plan_c varchar(40),
           IN id_bien int,
           IN observaciont text

         )
BEGIN
declare a float(10,2);
declare b float(10,2);
START TRANSACTION;
update tb_bancos set saldo = saldo+saldos where id_banco = Id_banco;
update tb_alquiler set abonos=abonos+saldos where id_alquiler=id_alqui;

set a =(select abonos from tb_alquiler where id_alquiler=id_alqui);
set b=(select valor from tb_alquiler where id_alquiler=id_alqui);
IF(b=a) then
update tb_alquiler set estado='PAGADO' where id_alquiler=id_alqui;
  if(id_bien=1)then
    update tb_alquiler set estadogarantia='DEVUELTO' where id_alquiler=id_alqui;
  end if;
end if;
insert into tb_ingreso_sindicato (id_persona, id_banco, fecha, descripcion, comprabante_n, comprabante_banco, saldo,observacion, estado,id_plan_subcuentas) values (id_per, Id_banco, Fechas,Descripcion, comprobante_ingreso, deposito, saldos,observaciont,'ACTIVO',id_plan_c );
insert into tb_alquiler_pagos (saldo,comprobante_ingre,id_alquiler,estado) values(saldos,comprobante_ingreso,id_alqui,'ACTIVO');
COMMIT;    

END
$$
DELIMITER ;

drop procedure IF EXISTS insertar_pagos_estu;
DELIMITER $$
 
CREATE PROCEDURE insertar_pagos_estu(
           IN id_pers int, 
           IN id_estudi int, 
           IN promo int, 
           IN valor float(10,2),
           IN tipo_ingreso varchar(50),
           IN fecha_ingre date,
           IN descripcion text, 
           IN ingreso_n int, 
           IN comprobante_bco varchar(20),
           IN id_bancos int,
           IN id_plan_c varchar(40),
           IN observaciont text
         )
BEGIN
declare a int;
START TRANSACTION;
insert into tb_ingreso_escuela(id_persona,id_banco,fecha,descripcion,comprabante_n,comprabante_banco,saldo,observacion,estado,id_plan_subcuentas)values(id_pers,id_bancos,fecha_ingre,descripcion,ingreso_n,comprobante_bco,valor,observaciont,'ACTIVO',id_plan_c);
set a =(select id_ingreso_escuela from tb_ingreso_escuela where comprabante_n=ingreso_n);

insert into tb_detalle_estudiante_pago(id_estudiante,descripcion,fecha,id_ingreso_escuela,factura,estado,observacion)values(id_estudi,tipo_ingreso,fecha_ingre,a,'','ACTIVO','');

update tb_bancos set saldo=saldo+valor where id_banco=id_bancos;
update tb_estudiantes set abono=abono+valor where id_estudiante=id_estudi;

COMMIT;    

END
$$
DELIMITER ;