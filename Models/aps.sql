drop table if exists Categoria cascade;

drop table if exists Campo cascade;

drop table if exists PontoInteresse cascade;

drop table if exists Dado cascade;

drop table if exists TData cascade;

drop table if exists TInteiro cascade;

drop table if exists TReal cascade;

drop table if exists TString cascade;

create table Categoria (
   idCategoria          SERIAL,
   nomeCategoria        VARCHAR(254)         not null,
   constraint PK_CATEGORIA primary key (idCategoria)
);

create table Campo (
   idCampo              BIGSERIAL,
   idCategoria          INT4                 null,
   nomeCampo            VARCHAR(254)         not null,
   tipoCampo            INT4                 not null,
   constraint PK_CAMPO primary key (idCampo),
   constraint FK_CAMPO_ASSOCIATI_CATEGORI foreign key (idCategoria)
      references Categoria (idCategoria)
      on delete cascade on update restrict
);

create table PontoInteresse (
   idPonto              BIGSERIAL,
   idCategoria          INT4                 null,
   nomePonto            VARCHAR(254)         not null,
   latitude             NUMERIC              not null,
   longitude            NUMERIC              not null,
   constraint PK_PONTOINTERESSE primary key (idPonto),
   constraint FK_PONTOINT_ASSOCIATI_CATEGORI foreign key (idCategoria)
      references Categoria (idCategoria)
      on delete cascade on update restrict
);

create table Dado (
   idDado               BIGSERIAL,
   idCampo              INT8                 null,
   idPonto              INT8                 null,
   valor                VARCHAR(254)         null,
   constraint PK_DADO primary key (idDado),
   constraint FK_DADO_ASSOCIATI_PONTOINT foreign key (idPonto)
      references PontoInteresse (idPonto)
      on delete cascade on update restrict,
   constraint FK_DADO_ASSOCIATI_CAMPO foreign key (idCampo)
      references Campo (idCampo)
      on delete cascade on update restrict
);

create table TData (
   idDado               INT8                 not null,
   valor                DATE                 not null,
   constraint PK_TDATA primary key (idDado),
   constraint FK_TDATA_GENERALIZ_DADO foreign key (idDado)
      references Dado (idDado)
      on delete cascade on update restrict
);

create table TInteiro (
   idDado               INT8                 not null,
   valor                INT4                 not null,
   constraint PK_TINTEIRO primary key (idDado),
   constraint FK_TINTEIRO_GENERALIZ_DADO foreign key (idDado)
      references Dado (idDado)
      on delete cascade on update restrict
);

create table TReal (
   idDado               INT8                 not null,
   valor                NUMERIC              not null,
   constraint PK_TREAL primary key (idDado),
   constraint FK_TREAL_GENERALIZ_DADO foreign key (idDado)
      references Dado (idDado)
      on delete cascade on update restrict
);

create table TString (
   idDado               INT8                 not null,
   valor                VARCHAR(254)         not null,
   constraint PK_TSTRING primary key (idDado),
   constraint FK_TSTRING_GENERALIZ_DADO foreign key (idDado)
      references Dado (idDado)
      on delete cascade on update restrict
);

CREATE INDEX fk_idcategoria_index ON campo USING btree (idcategoria);

CREATE INDEX fk_idcategoria_ponto_index ON pontointeresse USING btree (idcategoria);

CREATE INDEX fk_idponto_index ON dado USING btree (idponto);
