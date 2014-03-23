/*==============================================================*/
/* DBMS name:      PostgreSQL 8                                 */
/* Created on:     22/03/2014 21:34:08                          */
/*==============================================================*/


drop table Campo;

drop table Categoria;

drop table Dado;

drop table PontoInteresse;

drop table TData;

drop table TInteiro;

drop table TReal;

drop table TString;

/*==============================================================*/
/* Table: Categoria                                             */
/*==============================================================*/
create table Categoria (
   idCategoria          INT4                 not null,
   nomeCategoria        VARCHAR(254)         not null,
   constraint PK_CATEGORIA primary key (idCategoria)
);

/*==============================================================*/
/* Table: Campo                                                 */
/*==============================================================*/
create table Campo (
   idCampo              INT8                 not null,
   idCategoria          INT4                 null,
   nomeCampo            VARCHAR(254)         not null,
   tipoCampo            INT4                 not null,
   constraint PK_CAMPO primary key (idCampo),
   constraint FK_CAMPO_ASSOCIATI_CATEGORI foreign key (idCategoria)
      references Categoria (idCategoria)
      on delete restrict on update restrict
);

/*==============================================================*/
/* Table: PontoInteresse                                        */
/*==============================================================*/
create table PontoInteresse (
   idPonto              INT8                 not null,
   idCategoria          INT4                 null,
   nomePonto            VARCHAR(254)         not null,
   latitude             NUMERIC              not null,
   longitude            NUMERIC              not null,
   constraint PK_PONTOINTERESSE primary key (idPonto),
   constraint FK_PONTOINT_ASSOCIATI_CATEGORI foreign key (idCategoria)
      references Categoria (idCategoria)
      on delete restrict on update restrict
);

/*==============================================================*/
/* Table: Dado                                                  */
/*==============================================================*/
create table Dado (
   idDado               INT8                 not null,
   idCampo              INT8                 null,
   idPonto              INT8                 null,
   valor                VARCHAR(254)         null,
   constraint PK_DADO primary key (idDado),
   constraint FK_DADO_ASSOCIATI_PONTOINT foreign key (idPonto)
      references PontoInteresse (idPonto)
      on delete restrict on update restrict,
   constraint FK_DADO_ASSOCIATI_CAMPO foreign key (idCampo)
      references Campo (idCampo)
      on delete restrict on update restrict
);

/*==============================================================*/
/* Table: TData                                                 */
/*==============================================================*/
create table TData (
   idDado               INT8                 not null,
   valor                DATE                 not null,
   constraint PK_TDATA primary key (idDado),
   constraint FK_TDATA_GENERALIZ_DADO foreign key (idDado)
      references Dado (idDado)
      on delete restrict on update restrict
);

/*==============================================================*/
/* Table: TInteiro                                              */
/*==============================================================*/
create table TInteiro (
   idDado               INT8                 not null,
   valor                INT4                 not null,
   constraint PK_TINTEIRO primary key (idDado),
   constraint FK_TINTEIRO_GENERALIZ_DADO foreign key (idDado)
      references Dado (idDado)
      on delete restrict on update restrict
);

/*==============================================================*/
/* Table: TReal                                                 */
/*==============================================================*/
create table TReal (
   idDado               INT8                 not null,
   valor                NUMERIC              not null,
   constraint PK_TREAL primary key (idDado),
   constraint FK_TREAL_GENERALIZ_DADO foreign key (idDado)
      references Dado (idDado)
      on delete restrict on update restrict
);

/*==============================================================*/
/* Table: TString                                               */
/*==============================================================*/
create table TString (
   idDado               INT8                 not null,
   valor                VARCHAR(254)         not null,
   constraint PK_TSTRING primary key (idDado),
   constraint FK_TSTRING_GENERALIZ_DADO foreign key (idDado)
      references Dado (idDado)
      on delete restrict on update restrict
);

