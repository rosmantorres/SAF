<?php
// auto-generated by sfDatabaseConfigHandler
// date: 2013/05/23 13:07:01

return array(
'schema_saf' => new sfDoctrineDatabase(array (
  'dsn' => 'oracle://SAF:safdes@10.2.101.107/(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=10.2.101.107)(PORT=1521)))(CONNECT_DATA=(SID=OPCCODUP)))',
  'name' => 'schema_saf',
)),

'schema_siod' => new sfDoctrineDatabase(array (
  'dsn' => 'oracle://SIOD:siodd@10.2.101.107/(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=10.2.101.107)(PORT=1521)))(CONNECT_DATA=(SID=OPCCODUP)))',
  'name' => 'schema_siod',
)),

'schema_simip' => new sfDoctrineDatabase(array (
  'dsn' => 'oracle://infored:infored@10.2.101.107/(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=10.2.101.107)(PORT=1521)))(CONNECT_DATA=(SID=OPCCODUP)))',
  'name' => 'schema_simip',
)),);
