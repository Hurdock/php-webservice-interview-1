<?php 
  class Form {
    private $update;
    private $tag;

    public function __construct() {
      $this->tag = $_POST['tag'];
      $this->update = date("Y-m-d H:i:s");
    }

    public function submit() {
      $payload = array(
        'lastTag' => $this->tag,
        'lastUpdate' => $this->update // MySQL errors forced me to change it to Y-m-d.
      );
      $payload = json_encode($payload);
      $payload = base64_encode($payload);  
      $submit = new Stats();
      $submit = $submit->updateStats($payload);
      echo 'Database has been updated. Please check it for results.';
    }
  }

?>