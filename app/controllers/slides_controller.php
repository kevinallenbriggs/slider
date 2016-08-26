<?php
  class SlideController {
    public function index() {
      // we store all the slides in a variable
      $slides = Slide::all();
      require_once('views/slides/index.php');
    }

    public function show() {
      // we expect a url of form ?controller=slides&action=show&id=x
      // without an id we just redirect to the error page as we need the post id to find it in the database
      if (!isset($_GET['id']))
        return call('pages', 'error');

      // we use the given id to get the right post
      $slide = Slide::find($_GET['id']);
      require_once('views/slides/show.php');
    }
  }
?>