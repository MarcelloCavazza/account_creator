create database formsphp;
use formsphp;

create table clientes(
id_cliente int auto_increment not null primary key,
nome_cliente varchar(225) not null,
email_cliente varchar(255) not null,
telefone_cliente char(14) not null,
senha_cliente varchar(255) not null,
data_nasc_cliente date not null
)ENGINE=INNODB;

select * from clientes;