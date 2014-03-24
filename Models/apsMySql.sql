/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     24/03/2014 16:40:00                          */
/*==============================================================*/


drop table if exists Campo;

drop table if exists Categoria;

drop table if exists Dado;

drop table if exists PontoInteresse;

drop table if exists TData;

drop table if exists TInteiro;

drop table if exists TReal;

drop table if exists TString;

/*==============================================================*/
/* Table: Categoria                                             */
/*==============================================================*/
create table Categoria
(
   idCategoria          int not null,
   nomeCategoria        varchar(254) not null,
   primary key (idCategoria)
);

/*==============================================================*/
/* Table: Campo                                                 */
/*==============================================================*/
create table Campo
(
   idCategoria          int,
   idCampo              bigint not null,
   nomeCampo            varchar(254) not null,
   tipoCampo            int not null,
   primary key (idCampo),
   constraint FK_association2 foreign key (idCategoria)
      references Categoria (idCategoria) on delete restrict on update restrict
);

/*==============================================================*/
/* Table: PontoInteresse                                        */
/*==============================================================*/
create table PontoInteresse
(
   idPonto              bigint not null,
   idCategoria          int,
   nomePonto            varchar(254) not null,
   latitude             numeric(8,0) not null,
   longitude            numeric(8,0) not null,
   primary key (idPonto),
   constraint FK_association5 foreign key (idCategoria)
      references Categoria (idCategoria) on delete restrict on update restrict
);

/*==============================================================*/
/* Table: Dado                                                  */
/*==============================================================*/
create table Dado
(
   idPonto              bigint,
   idDado               bigint not null,
   idCampo              bigint,
   valor                varchar(254),
   primary key (idDado),
   constraint FK_association1 foreign key (idPonto)
      references PontoInteresse (idPonto) on delete restrict on update restrict,
   constraint FK_association4 foreign key (idCampo)
      references Campo (idCampo) on delete restrict on update restrict
);

/*==============================================================*/
/* Table: TData                                                 */
/*==============================================================*/
create table TData
(
   idDado               bigint not null,
   valor                datetime not null,
   primary key (idDado),
   constraint FK_Generalization_4 foreign key (idDado)
      references Dado (idDado) on delete restrict on update restrict
);

/*==============================================================*/
/* Table: TInteiro                                              */
/*==============================================================*/
create table TInteiro
(
   idDado               bigint not null,
   valor                int not null,
   primary key (idDado),
   constraint FK_Generalization_1 foreign key (idDado)
      references Dado (idDado) on delete restrict on update restrict
);

/*==============================================================*/
/* Table: TReal                                                 */
/*==============================================================*/
create table TReal
(
   idDado               bigint not null,
   valor                numeric(8,0) not null,
   primary key (idDado),
   constraint FK_Generalization_2 foreign key (idDado)
      references Dado (idDado) on delete restrict on update restrict
);

/*==============================================================*/
/* Table: TString                                               */
/*==============================================================*/
create table TString
(
   idDado               bigint not null,
   valor                varchar(254) not null,
   primary key (idDado),
   constraint FK_Generalization_3 foreign key (idDado)
      references Dado (idDado) on delete restrict on update restrict
);

