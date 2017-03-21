<!DOCTYPE html>
<html>
  <head>

  <link rel='stylesheet' type='text/css' href='views/style.css'>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

  <meta http-equiv="refresh" content="<?php echo 30 * 60; ?>" >

  </head>
  <body>
    <header>
      <div class="navButtons navButton1"><a href="/">Slideshow</a></div>
      <div class="navButtons navButton2"><a href='?controller=slides&action=index'>Slides</a></div>
      <div class="navButtons navButton3"><a href='?controller=settings&action=index'>Settings</a></div>
    </header>

    <?php require_once ("routes.php"); ?>

    <?php
      $uri = $_SERVER['REQUEST_URI'];
      if ($uri != '/') {
        $html = "<footer>" .
                  "<hr>" .
                    "<p>Developed &amp; maintained by the Loveland Public Library - Loveland, CO</p>";
            
            if (!empty($_GET) || !empty($_POST) || isset($params)) {
              $get_vars = var_export($_GET, true);
              $post_vars = var_export($_POST, true);
              $html .= '<pre class="debug">$_GET: ' . $get_vars . '</pre>';
              $html .= '<pre class="debug">$_POST: ' . $post_vars . '</pre>';
            }
        $html .= '</footer>';
        //echo $html;
      }
      ?>
    
  <body>
</html>
