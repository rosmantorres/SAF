SAF
===

Repositorio para el desarrollo del "Sistema de Análisis de Fallas"

CONEXION CON LA BD DE CORPOELEC (databases.yml)
==
all:
  schema_saf:
    class: sfDoctrineDatabase
    param:
      dsn: oracle://SAF:safdes@10.2.101.107/(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=10.2.101.107)(PORT=1521)))(CONNECT_DATA=(SID=OPCCODUP)))

SCHEMA DEL FRAMEWORK PARA GENERAR EL MODELO (schema.yml) Nota: al generar el sql no sale el tablespace (TABLESPACE "TS_DAT_EVENTOS_SOD")
==
SAF_AGENDA_CONVOCATORIA:
  connection: schema_saf
  tableName: SAF_AGENDA_CONVOCATORIA
  actAs: { Timestampable: ~ }
  columns:
    id: { type: integer, primary: true, sequence: true }
    departamento: { notnull: true, type: string(50) }
    f_inicio_consulta: { notnull: true, type: timestamp(7) }
    f_fin_consulta: { notnull: true, type: timestamp(7) }    
    observacion: { notnull: false, type: string(1000) }
  relations:
    SAF_CONVOCATORIA_CAF:
      local: id
      foreign: id_agenda
      type: many
    SAF_EVENTO:
      local: id
      foreign: id_agenda
      type: many
      
SAF_ASISTENCIA:
  connection: schema_saf
  tableName: SAF_ASISTENCIA
  columns:
    id_convocatoria: { type: integer, primary: true }
    id_personal: { type: integer, primary: true }
  relations:
    SAF_CONVOCATORIA_CAF:
      local: id_convocatoria
      foreign: id
      type: one
    SAF_PERSONAL:
      local: id_personal
      foreign: ci
      type: one
      
SAF_COMP_UE:
  connection: schema_saf
  tableName: SAF_COMP_UE
  columns:
    id: { type: integer, primary: true }
    id_compromiso: { notnull: true, type: integer }
    id_ue: { notnull: true, type: integer }
  relations:
    SAF_VARIO:
      local: id_compromiso
      foreign: id
      type: one
    SAF_UNIDAD_EQUIPO:
      local: id_ue
      foreign: id
      type: one
    SAF_TAREA_REALIZADA_COMP:
      local: id
      foreign: id_comp_ue
      type: many
      
SAF_CONVOCATORIA_CAF:
  connection: schema_saf
  tableName: SAF_CONVOCATORIA_CAF
  actAs: { Timestampable: ~ }
  columns:
    id: {type: integer, primary: true, sequence: true }
    id_agenda: { notnull: true, type: integer }
    asunto: { notnull: true, type: string(100) }
    hora_ini: { notnull: true, type: timestamp(7) }
    hora_fin: { notnull: true, type: timestamp(7) }
    lugar: { notnull: true, type: string(100) }
    observacion: { notnull: false, type: string(1000) }
    c_caf: { notnull: false, type: string(100) }
  relations:
    SAF_AGENDA_CONVOCATORIA:
      local: id_agenda
      foreign: id
      type: one
    SAF_F_CONVOCATORIA_CAF:
      local: id
      foreign: id_convocatoria
      type: many
    SAF_EVENTO:
      local: id
      foreign: id_convocatoria
      type: many
    SAF_FOTO:
      local: id
      foreign: id_convocatoria
      type: many
    SAF_ASISTENCIA:
      local: id
      foreign: id_convocatoria
      type: many
      
SAF_EVENTO:
  connection: schema_saf
  tableName: SAF_EVENTO
  columns:
    id: { type: integer, primary: true, sequence: true }
    descripcion: { notnull: true, type: string(500) }
    clasificado_en: { notnull: true, type: string(50) }
    id_agenda: { notnull: false, type: integer }
    id_convocatoria: { notnull: false, type: integer }
    c_eveno_t: { notnull: false, type: integer }
    c_evento_d: { notnull: false, type: integer }
    status: { notnull: false, type: string(50) }
      
SAF_FOTO:
  connection: schema_saf
  tableName: SAF_FOTO
  columns:
    id: { type: integer, primary: true, sequence: true }
    tipo: { notnull: true, type: string(50) }
    titulo: { notnull: true, type: string(100) }
    dir: { notnull: true, type: string(100) }
    id_convocatoria: { notnull: false, type: integer }
    id_evento: { notnull: false, type: integer }
    id_vario: { notnull: false, type: integer }
    sub_titulo: { notnull: false, type: string(100) }
  relations:
    SAF_CONVOCATORIA_CAF:
      local: id_convocatoria
      foreign: id
      type: one
    SAF_EVENTO:
      local: id_evento
      foreign: id
      type: one
    SAF_VARIO:
      local: id_vario
      foreign: id
      type: one
      
SAF_F_CONVOCATORIA_CAF:
  connection: schema_saf
  tableName: SAF_F_CONVOCATORIA_CAF
  columns:
    fecha: { type: timestamp(7), primary: true }
    id_convocatoria: { notnull: true, type: integer }
    status: { notnull: true, type: string(50) }
    motivo_suspencion: { notnull: false, type: string(1000) }
  relations:
    SAF_CONVOCATORIA_CAF:
      local: id_convocatoria
      foreign: id
      foreignAlias: MisFechasDeConvocatia
      type: one
      
SAF_PERSONAL:
  connection: schema_saf
  tableName: SAF_PERSONAL
  columns:
    ci: { type: integer, primary: true }
    id_ue: { notnull: true, type: integer }
    nombre: { notnull: false, type: string(50) }
    apellido: { notnull: false, type: string(50) }
    correo: { notnull: false, type: string(50) }
  relations:
    SAF_UNIDAD_EQUIPO:
      local: id_ue
      foreign: id
      type: one
    SAF_ASISTENCIA:
      local: ci
      foreign: id_personal
      type: many
      
SAF_R1000_MVAMIN:
  connection: schema_saf
  tableName: SAF_R1000_MVAMIN
  columns:
    id: { type: integer, primary: true, sequence: true }
    id_evento: { notnull: true, type: integer }
    razon: { notnull: true, type: string(50) }
    valor: { notnull: true, type: integer }
  relations:
    SAF_EVENTO:
      local: id_evento
      foreign: id
      foreignAlias: Razones_1000MvaMin
      type: one
      
SAF_TAREA_REALIZADA_COMP:
  connection: schema_saf
  tableName: SAF_TAREA_REALIZADA_COMP
  actAs: { Timestampable: ~ }
  columns:
    id: { type: integer, primary: true, sequence: true }
    id_comp_ue: { notnull: true, type: integer }
    descripcion: { notnull: false, type: string(1000) }
  relations:
    SAF_COMP_UE:
      local: id_comp_ue
      foreign: id
      type: one
      
SAF_UNIDAD_EQUIPO:
  connection: schema_saf
  tableName: SAF_UNIDAD_EQUIPO
  columns:
    id: { type: integer, primary: true, sequence: true }
    nombre: { notnull: true, type: string(50) }
    correo: { notnull: true, type: string(50) }
  relations:
    SAF_PERSONAL:
      local: id
      foreign: id_ue
      type: many
    SAF_COMP_UE:
      local: id
      foreign: id_ue
      type: many
      
SAF_VARIO:
  connection: schema_saf
  tableName: SAF_VARIO
  actAs: { Timestampable: ~ }
  columns:
    id: { type: integer, primary: true, sequence: true }
    id_evento: { notnull: true, type: integer }
    tipo: { notnull: true, type: string(50) }
    descripcion: { notnull: true, type: string(4000) }
    f_duracion_estimada: { notnull: false, type: timestamp(7) }
    status: { notnull: false, type: string(50) }
    titulo: { notnull: false, type: string(100) }
  relations:
    SAF_EVENTO:
      local: id_evento
      foreign: id
      type: one
    SAF_FOTO:
      local: id
      foreign: id_vario
      type: many
    SAF_COMP_UE:
      local: id
      foreign: id_compromiso
      type: many
