<?php   
  session_start();

  spl_autoload_register(function ($class_name) {
    include './src/classes/' . $class_name . '.php';
  });

  if(isset($_SESSION['result'])) { unset($_SESSION['result']); }

  if(isset($_POST['submit_form']) && isset($_POST['tag'])) {
    $form = new Form();
    $form->submit();
  }

?>
