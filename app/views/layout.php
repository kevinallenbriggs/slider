<!DOCTYPE html>
<html>
  <head>

  <link rel='stylesheet' type='text/css' href='views/style.css'>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

  </head>
  <body>
    <header>
      <div class="navButtons navButton1"><a href="/">Home</a></div>
      <div class="navButtons navButton2"><a href='?controller=slides&action=index'>Slides</a></div>
      <div class="navButtons navButton3"><a href='?controller=settings&action=index'>Settings</a></div>
    </header>

    <?php require_once ("routes.php"); ?>

    <footer>
      <hr>
      Developed &amp; maintained by the Loveland Public Library - Loveland, CO
      <?php
        if (!empty($_GET) || !empty($_POST) || isset($params)) {
          echo '<pre class="debug">$_GET: ';
          var_dump($_GET);
          echo '</pre><pre class="debug">$_POST: ';
          var_dump($_POST);
          echo '</pre><pre class="debug">$params: ';
          var_dump($params);
          echo '</pre>';
        }
        ?>
    </footer>
    
  <body>
</html>
