

insert into carrera (id,nombre)VALUES(1,'Informática');
insert into estudiante (id,nombre,matricula,carrera_id)VALUES(1,'Juan García','inf-1235',1);

select * from carrera;

select id, nombre, matricula from estudiante;


DELETE FROM carrera WHERE id=8;
DELETE FROM estudiante  WHERE id=4;


UPDATE carrera SET nombre='Architectura' WHERE id=8;