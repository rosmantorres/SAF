<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <?php include_stylesheets() ?>    
    <?php include_javascripts() ?>
    <?php echo stylesheet_tag('main') ?>
    <title>
      <?php if (!include_slot('title')): ?>
        SAF 
      <?php endif; ?>
    </title>
    <link rel="shortcut icon" href="/favicon.ico" />
  </head>
  <body>
    <div class="container">

      <div class="masthead">
        <h3 class="muted">SISTEMA DE ANALISIS DE FALLAS</h3>
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
              <ul class="nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Downloads</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </div>
          </div>
        </div><!-- /.navbar -->
      </div>

      <div>
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

      <!-- jumbotron -->
      <div>
        <?php echo $sf_content ?>
      </div>

      <hr>
      <div class="footer">
        <p>&copy; SAF 2013</p>
      </div>

    </div> <!-- /container -->
  </body>
</html>