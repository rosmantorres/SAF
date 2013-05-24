CREATE TABLE SAF_AGENDA_CONVOCATORIA (id NUMBER(20), departamento VARCHAR2(50) NOT NULL, f_inicio_consulta DATE NOT NULL, f_fin_consulta DATE NOT NULL, observacion VARCHAR2(1000), created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_ASISTENCIA (id_convocatoria NUMBER(20), id_personal NUMBER(20), PRIMARY KEY(id_convocatoria, id_personal))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_COMP_UE (id NUMBER(20), id_compromiso NUMBER(20) NOT NULL, id_ue NUMBER(20) NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_CONVOCATORIA_CAF (id NUMBER(20), id_agenda NUMBER(20) NOT NULL, asunto VARCHAR2(100) NOT NULL, hora_ini DATE NOT NULL, hora_fin DATE NOT NULL, lugar VARCHAR2(100) NOT NULL, observacion VARCHAR2(1000), c_caf VARCHAR2(100), created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_EVENTO (id NUMBER(20), descripcion VARCHAR2(500) NOT NULL, clasificado_en VARCHAR2(50) NOT NULL, id_agenda NUMBER(20), id_convocatoria NUMBER(20), status VARCHAR2(50), c_eveno_t NUMBER(20), c_evento_d NUMBER(20), f_hora_ini DATE, f_hora_rep DATE, region VARCHAR2(100), circuito VARCHAR2(100), cod_nivel INTEGER, kva_int INTEGER, mva_min INTEGER, num_averia INTEGER, desc_averia VARCHAR2(4000), tipo_falla VARCHAR2(50), operador VARCHAR2(50), cuadrilla VARCHAR2(50), climatologia VARCHAR2(50), trabajo_realizado VARCHAR2(4000), num_roe INTEGER, programador VARCHAR2(50), operador_resp VARCHAR2(50), PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_FOTO (id NUMBER(20), tipo VARCHAR2(50) NOT NULL, titulo VARCHAR2(100) NOT NULL, dir VARCHAR2(100) NOT NULL, id_convocatoria NUMBER(20), id_evento NUMBER(20), id_vario NUMBER(20), sub_titulo VARCHAR2(100), PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_F_CONVOCATORIA_CAF (fecha DATE, id_convocatoria NUMBER(20) NOT NULL, status VARCHAR2(50) NOT NULL, motivo_suspencion VARCHAR2(1000), PRIMARY KEY(fecha))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_PERSONAL (ci NUMBER(20), id_ue NUMBER(20) NOT NULL, nombre VARCHAR2(50), apellido VARCHAR2(50), correo VARCHAR2(50), PRIMARY KEY(ci))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_R1000_MVAMIN (id NUMBER(20), id_evento NUMBER(20) NOT NULL, razon VARCHAR2(50) NOT NULL, valor NUMBER(20) NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_TAREA_REALIZADA_COMP (id NUMBER(20), id_comp_ue NUMBER(20) NOT NULL, descripcion VARCHAR2(1000), created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_UNIDAD_EQUIPO (id NUMBER(20), nombre VARCHAR2(50) NOT NULL, correo VARCHAR2(50) NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_VARIO (id NUMBER(20), id_evento NUMBER(20) NOT NULL, tipo VARCHAR2(50) NOT NULL, descripcion VARCHAR2(4000) NOT NULL, f_duracion_estimada DATE, status VARCHAR2(50), titulo VARCHAR2(100), created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE SEQUENCE SAF_AGENDA_CONVOCATORIA_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SAF_CONVOCATORIA_CAF_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SAF_EVENTO_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SAF_FOTO_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SAF_R1000_MVAMIN_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SAF_TAREA_REALIZADA_COMP_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SAF_UNIDAD_EQUIPO_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SAF_VARIO_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
ALTER TABLE SAF_ASISTENCIA ADD CONSTRAINT SiSi_2 FOREIGN KEY (id_convocatoria) REFERENCES SAF_CONVOCATORIA_CAF(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_ASISTENCIA ADD CONSTRAINT SiSc FOREIGN KEY (id_personal) REFERENCES SAF_PERSONAL(ci) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_COMP_UE ADD CONSTRAINT SiSi_4 FOREIGN KEY (id_ue) REFERENCES SAF_UNIDAD_EQUIPO(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_COMP_UE ADD CONSTRAINT SiSi_3 FOREIGN KEY (id_compromiso) REFERENCES SAF_VARIO(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_CONVOCATORIA_CAF ADD CONSTRAINT SiSi_6 FOREIGN KEY (id_agenda) REFERENCES SAF_AGENDA_CONVOCATORIA(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_EVENTO ADD CONSTRAINT SiSi_12 FOREIGN KEY (id_convocatoria) REFERENCES SAF_CONVOCATORIA_CAF(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_EVENTO ADD CONSTRAINT SiSi_11 FOREIGN KEY (id_agenda) REFERENCES SAF_AGENDA_CONVOCATORIA(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_FOTO ADD CONSTRAINT SiSi_17 FOREIGN KEY (id_evento) REFERENCES SAF_EVENTO(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_FOTO ADD CONSTRAINT SiSi_16 FOREIGN KEY (id_convocatoria) REFERENCES SAF_CONVOCATORIA_CAF(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_FOTO ADD CONSTRAINT SAF_FOTO_id_vario_SAF_VARIO_id FOREIGN KEY (id_vario) REFERENCES SAF_VARIO(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_F_CONVOCATORIA_CAF ADD CONSTRAINT SiSi_18 FOREIGN KEY (id_convocatoria) REFERENCES SAF_CONVOCATORIA_CAF(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_PERSONAL ADD CONSTRAINT SiSi_19 FOREIGN KEY (id_ue) REFERENCES SAF_UNIDAD_EQUIPO(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_R1000_MVAMIN ADD CONSTRAINT SiSi_20 FOREIGN KEY (id_evento) REFERENCES SAF_EVENTO(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_TAREA_REALIZADA_COMP ADD CONSTRAINT SiSi_21 FOREIGN KEY (id_comp_ue) REFERENCES SAF_COMP_UE(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_VARIO ADD CONSTRAINT SiSi_24 FOREIGN KEY (id_evento) REFERENCES SAF_EVENTO(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
