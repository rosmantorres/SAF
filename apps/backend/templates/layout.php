<!DOCTYPE html>
<html lang="es">
  <head>    
    <meta charset="utf-8">
    <?php include_stylesheets() ?>    
    <?php include_javascripts() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <title>
      <?php if (!include_slot('title')): ?>
        SAF - ADMINISTRADOR
      <?php endif; ?>      
    </title>
  </head>
  <body>    
    <!-- MENÚ -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="#">SAF-ADMINISTRADOR</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="<?php include_slot('menu_activo_agenda') ?>">
                <a href="<?php echo url_for('@admin_usuarios') ?>">Usuarios</a>
              </li>
              <li class="<?php include_slot('menu_activo_convocatoria') ?>">
                <a href="<?php echo url_for('@admin_grupos') ?>">Grupos</a>
              </li>
              <li class="<?php include_slot('menu_activo_minuta') ?>">
                <a href="<?php echo url_for('@admin_permisos') ?>">Permisos</a>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <!-- END MENÚ -->
    
    <div class="container">            
      
      <?php if ($sf_user->isAuthenticated()) : ?>                 
        <a class="pull-right" href="<?php echo url_for('@sf_guard_signout') ?>" style="font-size: 11px">
          <i class="icon-user"></i> Cerrar Sesión
        </a>
      <?php endif; ?>
      
      <hr>
      <div class="sf_content">
        <?php echo $sf_content ?>
      </div>
      
      <br><br><hr>
      <div class="footer">
        <p>&copy; SAF | SISTEMA DE ANALISIS DE FALLAS 2013</p>
      </div>
    </div><!-- /container -->
    
  </body>
</html>