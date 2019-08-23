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
      $hashed = new Security($payload);
      $payload = $hashed->encrypt();
      $submit = new Stats();
      $submit = $submit->updateStats($payload);
      $_SESSION['result'] = "Tag changed at " .  date("H:i") . " to <b>$this->tag</b>.";
    }
  }

?>