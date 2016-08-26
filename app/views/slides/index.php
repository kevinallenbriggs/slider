<p>Here is a list of all slides:</p>

<?php foreach($slides as $slide) { ?>
  <p>
    <?php echo $slide->name; ?>
    <a href='?controller=slides&action=show&id=<?php echo $slide->id; ?>'>See content</a>
  </p>
<?php } ?>