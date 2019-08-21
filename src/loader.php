<?php   
  spl_autoload_register(function ($class_name) {
    include './src/classes/' . $class_name . '.php';
  });
  
  if(isset($_POST['submit_form']) && isset($_POST['tag'])) {
    $form = new Form();
    $form->submit();
  }
?>
