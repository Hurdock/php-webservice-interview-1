<?php
  class Security {
    
    private $output = null;
    private $encrypt_method = "AES-256-CBC";
    private $secret_key = "This is my secret key";
    private $secret_iv = "This is my secret IV";
    private $key = null;
    private $iv = null;
    private $string = null;

    public function __construct($string) {
      $this->string = $string;
      $this->key = hash('sha256', $this->secret_key);
      $this->iv = substr(hash('sha256', $this->secret_iv), 0, 16);
    }

    public function encrypt() {
      $this->output = openssl_encrypt($this->string, $this->encrypt_method, $this->key, 0, $this->iv);
      $this->output = base64_encode($this->output);
      return $this->output;
    }

    public function decrypt() {
      $this->output = openssl_decrypt(base64_decode($this->string), $this->encrypt_method, $this->key,0, $this->iv);
      return $this->output;
    }

  }
?>