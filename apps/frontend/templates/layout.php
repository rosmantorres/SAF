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
        SAF 
      <?php endif; ?>      
    </title>
  </head>
  <body>    
    <!-- MENÚ -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="#">SAF</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="<?php include_slot('menu_activo_agenda') ?>">
                <a href="<?php echo url_for('@index_agenda') ?>">Agenda</a>
              </li>
              <li class="<?php include_slot('menu_activo_convocatoria') ?>">
                <a href="<?php echo url_for('@index_convocatoria') ?>">Convocatoria</a>
              </li>
              <li class="<?php include_slot('menu_activo_minuta') ?>">
                <a href="<?php echo url_for('@index_minuta') ?>">Minuta</a>
              </li>
              <li class="<?php include_slot('menu_activo_estadisticas_indicadores') ?>">
                <a href="<?php echo url_for('@index_estadisticas_indicadores') ?>">Estadisticas e Indicadores</a>
              </li>
<!--              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>-->
            </ul>
            <form class="navbar-form pull-right">
              <input class="span2" type="text" placeholder="Email">
              <input class="span2" type="password" placeholder="Password">
              <button type="submit" class="btn">iniciar sesión</button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <!-- END MENÚ -->
    
    <div class="container">
      
      <div class="flashes">
        <?php if ($sf_user->hasFlash('notice')): ?>
          <div class="alert alert-success">
            <strong><?php echo $sf_user->getFlash('notice') ?></strong>
          </div>
        <?php endif ?>
        <?php if ($sf_user->hasFlash('error')): ?>
          <div class="alert alert-error">
            <strong><?php echo $sf_user->getFlash('error') ?></strong>
          </div>
        <?php endif ?>
      </div>
      
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