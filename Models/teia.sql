/*==============================================================*/
/* DBMS name:      PostgreSQL 8                                 */
/* Created on:     04/03/2014 15:00:50                          */
/*==============================================================*/


drop table Atributo;

drop table Classe;

drop table Localidade;

drop table TInteiro;

drop table TReal;

drop table TString;

drop table TipoDados;

/*==============================================================*/
/* Table: TipoDados                                             */
/*==============================================================*/
create table TipoDados (
   idTipoDados          INT4                 not null,
   nomeTipoDados        VARCHAR(254)         null,
   constraint PK_TIPODADOS primary key (idTipoDados)
);

/*==============================================================*/
/* Table: Classe                                                */
/*==============================================================*/
create table Classe (
   idClasse             INT4                 not null,
   nomeClasse           VARCHAR(254)         null,
   constraint PK_CLASSE primary key (idClasse)
);

/*==============================================================*/
/* Table: Atributo                                              */
/*==============================================================*/
create table Atributo (
   idAtributo           INT4                 not null,
   idTipoDados          INT4                 not null,
   idClasse             INT4                 not null,
   nomeAtributo         VARCHAR(254)         null,
   constraint PK_ATRIBUTO primary key (idAtributo),
   constraint FK_ATRIBUTO_ASSOCIATI_TIPODADO foreign key (idTipoDados)
      references TipoDados (idTipoDados)
      on delete restrict on update restrict,
   constraint FK_ATRIBUTO_ASSOCIATI_CLASSE foreign key (idClasse)
      references Classe (idClasse)
      on delete restrict on update restrict
);

/*==============================================================*/
/* Table: Localidade                                            */
/*==============================================================*/
create table Localidade (
   idLocalidade         INT8                 not null,
   idClasse             INT4                 not null,
   latitude             NUMERIC              null,
   longitude            NUMERIC              null,
   constraint PK_LOCALIDADE primary key (idLocalidade),
   constraint FK_LOCALIDA_ASSOCIATI_CLASSE foreign key (idClasse)
      references Classe (idClasse)
      on delete restrict on update restrict
);

/*==============================================================*/
/* Table: Dado                                                  */
/*==============================================================*/
create table Dado (
   idDado               INT8                 not null,
   idLocalidade         INT8                 null,
   idAtributo           INT8                 not null,
   constraint PK_DADO primary key (idDado),
   constraint FK_DADO_ASSOCIATI_LOCALIDA foreign key (idLocalidade)
      references Localidade (idLocalidade)
      on delete restrict on update restrict,
   constraint FK_DADO_ASSOCIATI_ATRIBUTO foreign key (idAtributo)
      references Atributo (idAtributo)
      on delete restrict on update restrict
);

/*==============================================================*/
/* Table: TInteiro                                              */
/*==============================================================*/
create table TInteiro (
   idDado               INT8                 not null,
   valorInteiro         INT4                 null,
   constraint PK_TINTEIRO primary key (idDado),
   constraint FK_TINTEIRO_INHERITANCE_DADO foreign key (idDado)
      references Dado (idDado)
      on delete CASCADE on update restrict
);

/*==============================================================*/
/* Table: TReal                                                 */
/*==============================================================*/
create table TReal (
   idDado               INT8                 not null,
   valorReal            NUMERIC              null,
   constraint PK_TREAL primary key (idDado),
   constraint FK_TREAL_INHERITANCE_DADO foreign key (idDado)
      references Dado (idDado)
      on delete cascade on update restrict
);

/*==============================================================*/
/* Table: TString                                               */
/*==============================================================*/
create table TString (
   idDado               INT8                 not null,
   valor                VARCHAR(254)         null,
   constraint PK_TSTRING primary key (idDado),
   constraint FK_TSTRING_INHERITANCE_DADO foreign key (idDado)
      references Dado (idDado)
      on delete CASCADE on update restrict
);

