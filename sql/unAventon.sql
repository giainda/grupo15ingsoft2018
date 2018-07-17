create database unAventon
    default character set utf8;
use unAventon;
create table Usuarios(
    id int not null unique auto_increment,
    correo varchar(255) not null unique,
    nombre varchar(25) not null,
    apellido varchar(25) not null,
    fechanac date not null,
    contrasena varchar(255) not null ,
    fondos int not null,
    codigo_tarjeta varchar(12) not null,
    calificacionPos int not null,
    calificacionNeg int not null,
    activo tinyint not null,
    primary key (id)
);
create table calificacion_pendiente(
    id int not null unique auto_increment,
    idUsuariocalificador int not null,
    idusuarioACalificar int not null,
    activo tinyint not null,
    esAConductor tinyint not null,
    foreign key(idUsuarioCalificador)
         references Usuarios(id)
         on update Cascade
         on delete restrict,
    foreign key(idUsuarioACalificar)
         references Usuarios(id)
         on update Cascade
         on delete restrict     
);
create table pago_pendiente(
    id int not null unique auto_increment,
    idUsuarioDeudor int not null,
    idusuarioCobrador int not null,
    activo tinyint not null,
    monto numeric not null,
    foreign key(idUsuarioDeudor)
         references Usuarios(id)
         on update Cascade
         on delete restrict,
    foreign key(idUsuarioCobrador)
         references Usuarios(id)
         on update Cascade
         on delete restrict     
);
create table conductor(
    idUsuario int not null,
    calificacionPos int not null,
    calificacionNeg int not null,
    foreign key(idUsuario)
        references Usuarios(id)
        on update Cascade
        on delete restrict
) ;
create table auto (
    patente varchar(7) not null unique,
    marca varchar(20) not null,
    modelo varchar(20) not null,
    capasidad int not null,
    color varchar (20) not null,
    tipo varchar(20) not null,
    activo tinyint not null,
    primary key(patente)
) ; 
create table tiene(
    idConductor int not null,
    patente varchar(7) not null,
    activo tinyint not null,
    foreign key(idConductor)
       references conductor(idUsuario)
       on update Cascade
       on delete restrict,
    foreign key(patente)
       references auto(patente)
       on update Cascade
       on delete restrict      
);
create table viajes(
    idViaje int not null auto_increment unique,
    idConductor int not null,
    patente varchar(7) not null,
    fechaCreacion date not null,
    fechaInicio datetime not null,
    inicio varchar(20) not null,
    destino varchar(20) not null,
    asientos int not null,
    precio float not null,
    descripcion text character set utf8 not null,
    tipoViaje varchar(30) not null,
    estado tinyint not null,
    duracion time not null,
    terminado tinyint not null,
    primary key(idViaje),
    foreign key(idConductor)
       references conductor(idUsuario)
       on update Cascade
       on delete restrict  
) ;
create table postula(
    idUsuario int not null,
    idViaje int not null,
    eliminado tinyint not null,
    foreign key(idUsuario)
       references usuarios(id)
       on update Cascade
       on delete restrict,
    foreign key(idViaje)
       references viajes(idViaje)
       on update Cascade
       on delete restrict  

);
create table viaja(
    idUsuario int not null,
    idViaje int not null,
    eliminado tinyint not null,
    foreign key(idUsuario)
       references usuarios(id)
       on update Cascade
       on delete restrict,
    foreign key(idViaje)
       references viajes(idViaje)
       on update Cascade
       on delete restrict   

);
create table mensajes(
    id int not null auto_increment unique,
    idUsuario int not null,
    idViaje int not null,
    fecha datetime not null,
    texto text character set utf8 not null,
    respuesta text character set utf8 not null,
    primary key (id)

);
create table fotos(
    idUsuario int not null,
    foto varchar(255) not null,
    foreign key(idUsuario)
        references usuarios(id)
        on update Cascade
        on delete restrict
);
create table fotoAuto(
    patente varchar(7) not null,
    foto varchar(255) not null,
    foreign key(patente)
        references auto(patente)
        on update Cascade
        on delete restrict
);
create table notificacion(
    idUsuario int not null,
    texto text character set utf8 not null,
    leido tinyint not null,
    fechaNoti datetime not null,
    foreign key (idUsuario)
        references usuarios(id)
        on update Cascade
        on delete restrict
);
create table viajesProgramados(
    idViajeProgramado int not null unique auto_increment,
    fechaInicio datetime not null,
    fechaFin datetime not null,
    activo tinyint not null,
    primary key (idViajeProgramado)

);
create table viajePertenece(
    idViajeProgramado int not null ,
    idViaje int not null,
    activo tinyint not null,
    foreign key(idViajeProgramado)
          references viajesProgramados(idViajeProgramado)
          on update Cascade
          on delete restrict,
    foreign key(idViaje)
          references viajes(idViaje)
          on update Cascade
          on delete restrict      
);
create table calificaciones(
    id int not null unique auto_increment,
    idUsuario int not null,
    texto text character set utf8 not null,
        foreign key(idUsuario)
          references usuarios(id)
          on update Cascade
          on delete restrict 
)

