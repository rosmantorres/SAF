CREATE TABLE SAF_AGENDA_CONVOCATORIA (id NUMBER(20), departamento VARCHAR2(10) NOT NULL, observacion VARCHAR2(1000), pendiente NUMBER(20) NOT NULL, created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_ASISTENCIA (id_convocatoria NUMBER(20), id_personal NUMBER(20), PRIMARY KEY(id_convocatoria, id_personal))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_COMP_UE (id NUMBER(20), id_compromiso NUMBER(20) NOT NULL, id_ue NUMBER(20) NOT NULL, status VARCHAR2(50) NOT NULL, acciones VARCHAR2(4000), PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_CONVOCATORIA_CAF (id NUMBER(20), departamento VARCHAR2(10) NOT NULL, asunto VARCHAR2(100) NOT NULL, fecha DATE NOT NULL, hora_ini VARCHAR2(7) NOT NULL, hora_fin VARCHAR2(7) NOT NULL, lugar VARCHAR2(100) NOT NULL, status VARCHAR2(50) NOT NULL, motivo_suspencion VARCHAR2(1000), observacion VARCHAR2(1000), c_caf VARCHAR2(100), created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_EVENTO (id NUMBER(20), descripcion VARCHAR2(4000), id_agenda NUMBER(20), c_evento_t NUMBER(20), c_evento_d NUMBER(20), f_hora_ini DATE, f_hora_rep DATE, region VARCHAR2(100), circuito VARCHAR2(100), cod_nivel NUMBER(20), kva_int NUMBER(20), mva_min NUMBER(20), num_averia NUMBER(20), desc_averia VARCHAR2(4000), tipo_falla VARCHAR2(50), operador VARCHAR2(50), cuadrilla VARCHAR2(50), climatologia VARCHAR2(50), trabajo_realizado VARCHAR2(4000), num_roe NUMBER(20), programador VARCHAR2(50), operador_resp VARCHAR2(50), PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_EVENTO_CONVOCATORIA (id_evento NUMBER(20), id_convocatoria NUMBER(20), status VARCHAR2(20), PRIMARY KEY(id_evento, id_convocatoria))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_EVENTO_RAZON (id_evento NUMBER(20), id_razon NUMBER(20), mva_min NUMBER(20) NOT NULL, PRIMARY KEY(id_evento, id_razon))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_FOTO (id NUMBER(20), titulo VARCHAR2(100) NOT NULL, dir VARCHAR2(100) NOT NULL, id_evento NUMBER(20), sub_titulo VARCHAR2(100), PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_MINUTA (cod_min NUMBER(20), id_convocatoria NUMBER(20) NOT NULL UNIQUE, lista NUMBER(20) NOT NULL, img_compromisos VARCHAR2(500), img_asistencias VARCHAR2(500), created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(cod_min))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_RAZON_MVAMIN (id NUMBER(20), razon VARCHAR2(50) NOT NULL UNIQUE, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_UNIDAD_EQUIPO (id NUMBER(20), departamento VARCHAR2(10) NOT NULL, nombre VARCHAR2(50) NOT NULL, correo VARCHAR2(50) NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE SAF_VARIO (id NUMBER(20), id_evento NUMBER(20) NOT NULL, tipo VARCHAR2(50) NOT NULL, descripcion VARCHAR2(4000) NOT NULL, f_duracion_estimada DATE, titulo VARCHAR2(100), created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE sf_guard_forgot_password (id NUMBER(20), user_id NUMBER(20) NOT NULL, unique_key VARCHAR2(255), expires_at DATE NOT NULL, created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE sf_guard_group (id NUMBER(20), name VARCHAR2(255) UNIQUE, description VARCHAR2(1000), created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE sf_guard_group_permission (group_id NUMBER(20), permission_id NUMBER(20), created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(group_id, permission_id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE sf_guard_permission (id NUMBER(20), name VARCHAR2(255) UNIQUE, description VARCHAR2(1000), created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE sf_guard_remember_key (id NUMBER(20), user_id NUMBER(20), remember_key VARCHAR2(32), ip_address VARCHAR2(50), created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE sf_guard_user (id NUMBER(20), first_name VARCHAR2(255), last_name VARCHAR2(255), ci NUMBER(20) UNIQUE, email_address VARCHAR2(255) NOT NULL UNIQUE, username VARCHAR2(128) NOT NULL UNIQUE, id_ue NUMBER(20), algorithm VARCHAR2(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR2(128), password VARCHAR2(128), is_active NUMBER(1) DEFAULT 1, is_super_admin NUMBER(1) DEFAULT 0, last_login DATE, created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE sf_guard_user_group (user_id NUMBER(20), group_id NUMBER(20), created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(user_id, group_id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE TABLE sf_guard_user_permission (user_id NUMBER(20), permission_id NUMBER(20), created_at DATE NOT NULL, updated_at DATE NOT NULL, PRIMARY KEY(user_id, permission_id))TABLESPACE "TS_DAT_EVENTOS_SOD"
/
CREATE SEQUENCE SAF_AGENDA_CONVOCATORIA_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SAF_COMP_UE_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SAF_CONVOCATORIA_CAF_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SAF_EVENTO_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SAF_FOTO_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SAF_MINUTA_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SAF_RAZON_MVAMIN_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SAF_UNIDAD_EQUIPO_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SAF_VARIO_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SF_GUARD_FORGOT_PASSWORD_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SF_GUARD_GROUP_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SF_GUARD_PERMISSION_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SF_GUARD_REMEMBER_KEY_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE SEQUENCE SF_GUARD_USER_seq START WITH 1 INCREMENT BY 1 NOCACHE
/
CREATE INDEX is_active_idx ON sf_guard_user (is_active)
/
ALTER TABLE SAF_ASISTENCIA ADD CONSTRAINT Sisc FOREIGN KEY (id_personal) REFERENCES sf_guard_user(ci) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_ASISTENCIA ADD CONSTRAINT SiSi_1 FOREIGN KEY (id_convocatoria) REFERENCES SAF_CONVOCATORIA_CAF(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_COMP_UE ADD CONSTRAINT SiSi_3 FOREIGN KEY (id_ue) REFERENCES SAF_UNIDAD_EQUIPO(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_COMP_UE ADD CONSTRAINT SiSi_2 FOREIGN KEY (id_compromiso) REFERENCES SAF_VARIO(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_EVENTO ADD CONSTRAINT SiSi_6 FOREIGN KEY (id_agenda) REFERENCES SAF_AGENDA_CONVOCATORIA(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_EVENTO_CONVOCATORIA ADD CONSTRAINT SiSi_12 FOREIGN KEY (id_convocatoria) REFERENCES SAF_CONVOCATORIA_CAF(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_EVENTO_CONVOCATORIA ADD CONSTRAINT SiSi_11 FOREIGN KEY (id_evento) REFERENCES SAF_EVENTO(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_EVENTO_RAZON ADD CONSTRAINT SiSi_14 FOREIGN KEY (id_razon) REFERENCES SAF_RAZON_MVAMIN(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_EVENTO_RAZON ADD CONSTRAINT SiSi_13 FOREIGN KEY (id_evento) REFERENCES SAF_EVENTO(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_FOTO ADD CONSTRAINT SiSi_15 FOREIGN KEY (id_evento) REFERENCES SAF_EVENTO(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_MINUTA ADD CONSTRAINT SiSi_16 FOREIGN KEY (id_convocatoria) REFERENCES SAF_CONVOCATORIA_CAF(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE SAF_VARIO ADD CONSTRAINT SiSi_19 FOREIGN KEY (id_evento) REFERENCES SAF_EVENTO(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
DECLARE
  constraints_Count NUMBER;
BEGIN
  SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count FROM USER_CONSTRAINTS WHERE TABLE_NAME = 'SF_GUARD_FORGOT_PASSWORD' AND CONSTRAINT_TYPE = 'P';
  IF constraints_Count = 0 THEN
    EXECUTE IMMEDIATE 'ALTER TABLE SF_GUARD_FORGOT_PASSWORD ADD CONSTRAINT SF_GUARD_FORGOT_PASSWORD_AI_PK_idx PRIMARY KEY (id)';
  END IF;
END;
/
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT susi FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
/
DECLARE
  constraints_Count NUMBER;
BEGIN
  SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count FROM USER_CONSTRAINTS WHERE TABLE_NAME = 'SF_GUARD_GROUP' AND CONSTRAINT_TYPE = 'P';
  IF constraints_Count = 0 THEN
    EXECUTE IMMEDIATE 'ALTER TABLE SF_GUARD_GROUP ADD CONSTRAINT SF_GUARD_GROUP_AI_PK_idx PRIMARY KEY (id)';
  END IF;
END;
/
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT spsi FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sgsi FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
/
DECLARE
  constraints_Count NUMBER;
BEGIN
  SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count FROM USER_CONSTRAINTS WHERE TABLE_NAME = 'SF_GUARD_PERMISSION' AND CONSTRAINT_TYPE = 'P';
  IF constraints_Count = 0 THEN
    EXECUTE IMMEDIATE 'ALTER TABLE SF_GUARD_PERMISSION ADD CONSTRAINT SF_GUARD_PERMISSION_AI_PK_idx PRIMARY KEY (id)';
  END IF;
END;
/
DECLARE
  constraints_Count NUMBER;
BEGIN
  SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count FROM USER_CONSTRAINTS WHERE TABLE_NAME = 'SF_GUARD_REMEMBER_KEY' AND CONSTRAINT_TYPE = 'P';
  IF constraints_Count = 0 THEN
    EXECUTE IMMEDIATE 'ALTER TABLE SF_GUARD_REMEMBER_KEY ADD CONSTRAINT SF_GUARD_REMEMBER_KEY_AI_PK_idx PRIMARY KEY (id)';
  END IF;
END;
/
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT susi_1 FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
/
DECLARE
  constraints_Count NUMBER;
BEGIN
  SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count FROM USER_CONSTRAINTS WHERE TABLE_NAME = 'SF_GUARD_USER' AND CONSTRAINT_TYPE = 'P';
  IF constraints_Count = 0 THEN
    EXECUTE IMMEDIATE 'ALTER TABLE SF_GUARD_USER ADD CONSTRAINT SF_GUARD_USER_AI_PK_idx PRIMARY KEY (id)';
  END IF;
END;
/
ALTER TABLE sf_guard_user ADD CONSTRAINT siSi FOREIGN KEY (id_ue) REFERENCES SAF_UNIDAD_EQUIPO(id) NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE sf_guard_user_group ADD CONSTRAINT susi_2 FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sgsi_1 FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT susi_3 FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
/
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT spsi_1 FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
/
CREATE TRIGGER SF_GUARD_FORGOT_PASSWORD_AI_PK
   BEFORE INSERT
   ON SF_GUARD_FORGOT_PASSWORD
   FOR EACH ROW
DECLARE
   last_Sequence NUMBER;
   last_InsertID NUMBER;
BEGIN
   IF (:NEW.id IS NULL OR :NEW.id = 0) THEN
      SELECT SF_GUARD_FORGOT_PASSWORD_seq.NEXTVAL INTO :NEW.id FROM DUAL;
   ELSE
      SELECT NVL(Last_Number, 0) INTO last_Sequence
        FROM User_Sequences
       WHERE UPPER(Sequence_Name) = UPPER('SF_GUARD_FORGOT_PASSWORD_seq');
      SELECT :NEW.id INTO last_InsertID FROM DUAL;
      WHILE (last_InsertID > last_Sequence) LOOP
         SELECT SF_GUARD_FORGOT_PASSWORD_seq.NEXTVAL INTO last_Sequence FROM DUAL;
      END LOOP;
   END IF;
END;
/
CREATE TRIGGER SF_GUARD_GROUP_AI_PK
   BEFORE INSERT
   ON SF_GUARD_GROUP
   FOR EACH ROW
DECLARE
   last_Sequence NUMBER;
   last_InsertID NUMBER;
BEGIN
   IF (:NEW.id IS NULL OR :NEW.id = 0) THEN
      SELECT SF_GUARD_GROUP_seq.NEXTVAL INTO :NEW.id FROM DUAL;
   ELSE
      SELECT NVL(Last_Number, 0) INTO last_Sequence
        FROM User_Sequences
       WHERE UPPER(Sequence_Name) = UPPER('SF_GUARD_GROUP_seq');
      SELECT :NEW.id INTO last_InsertID FROM DUAL;
      WHILE (last_InsertID > last_Sequence) LOOP
         SELECT SF_GUARD_GROUP_seq.NEXTVAL INTO last_Sequence FROM DUAL;
      END LOOP;
   END IF;
END;
/
CREATE TRIGGER SF_GUARD_PERMISSION_AI_PK
   BEFORE INSERT
   ON SF_GUARD_PERMISSION
   FOR EACH ROW
DECLARE
   last_Sequence NUMBER;
   last_InsertID NUMBER;
BEGIN
   IF (:NEW.id IS NULL OR :NEW.id = 0) THEN
      SELECT SF_GUARD_PERMISSION_seq.NEXTVAL INTO :NEW.id FROM DUAL;
   ELSE
      SELECT NVL(Last_Number, 0) INTO last_Sequence
        FROM User_Sequences
       WHERE UPPER(Sequence_Name) = UPPER('SF_GUARD_PERMISSION_seq');
      SELECT :NEW.id INTO last_InsertID FROM DUAL;
      WHILE (last_InsertID > last_Sequence) LOOP
         SELECT SF_GUARD_PERMISSION_seq.NEXTVAL INTO last_Sequence FROM DUAL;
      END LOOP;
   END IF;
END;
/
CREATE TRIGGER SF_GUARD_REMEMBER_KEY_AI_PK
   BEFORE INSERT
   ON SF_GUARD_REMEMBER_KEY
   FOR EACH ROW
DECLARE
   last_Sequence NUMBER;
   last_InsertID NUMBER;
BEGIN
   IF (:NEW.id IS NULL OR :NEW.id = 0) THEN
      SELECT SF_GUARD_REMEMBER_KEY_seq.NEXTVAL INTO :NEW.id FROM DUAL;
   ELSE
      SELECT NVL(Last_Number, 0) INTO last_Sequence
        FROM User_Sequences
       WHERE UPPER(Sequence_Name) = UPPER('SF_GUARD_REMEMBER_KEY_seq');
      SELECT :NEW.id INTO last_InsertID FROM DUAL;
      WHILE (last_InsertID > last_Sequence) LOOP
         SELECT SF_GUARD_REMEMBER_KEY_seq.NEXTVAL INTO last_Sequence FROM DUAL;
      END LOOP;
   END IF;
END;
/
CREATE TRIGGER SF_GUARD_USER_AI_PK
   BEFORE INSERT
   ON SF_GUARD_USER
   FOR EACH ROW
DECLARE
   last_Sequence NUMBER;
   last_InsertID NUMBER;
BEGIN
   IF (:NEW.id IS NULL OR :NEW.id = 0) THEN
      SELECT SF_GUARD_USER_seq.NEXTVAL INTO :NEW.id FROM DUAL;
   ELSE
      SELECT NVL(Last_Number, 0) INTO last_Sequence
        FROM User_Sequences
       WHERE UPPER(Sequence_Name) = UPPER('SF_GUARD_USER_seq');
      SELECT :NEW.id INTO last_InsertID FROM DUAL;
      WHILE (last_InsertID > last_Sequence) LOOP
         SELECT SF_GUARD_USER_seq.NEXTVAL INTO last_Sequence FROM DUAL;
      END LOOP;
   END IF;
END;
/