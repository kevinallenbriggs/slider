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
      <?php
        if (!empty($_GET) || !empty($_POST)) {
          echo "<hr>";
          print_r($_GET);
          print_r($_POST);
        }
        ?>
    </footer>
    
  <body>
</html>