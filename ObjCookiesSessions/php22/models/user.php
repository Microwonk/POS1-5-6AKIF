<?php

class User {
   private $mail;
   private $password;
   private $errors = array();

   const EMAIL = "test@test.com";
   const PASSWORD = "passwort";

   public function __construct(string $mail = "", string $password = "") {
      $this->mail = $mail;
      $this->password = $password;
   }

   public function validate() : bool {
      return $this->validateEmail() | $this->validatePassword();
   }

   private function validateEmail() : bool {
      $f = filter_var($this->mail, FILTER_VALIDATE_EMAIL);
      $l = strlen($this->mail);
          if($f && $l > 5 && $l < 30){
              return false;
          }
          else{
              $this->errors['email'] = "Die Eingegebene Email ist nicht gültig!";
              return true;
          }
  }
  
  private function validatePassword() : bool {
      $l = strlen($this->password);
      if($l > 5 && $l < 20){
          return true;
      }
      else {
          $this->errors['password'] = "Das eingegebene Password ist nicht gültig!";
          return false;
      }
  }

   public static function get($mail, $password) : ?User {
      if ($mail == self::EMAIL && $password == self::PASSWORD) {
         return new User(self::EMAIL, self::PASSWORD);
      }
      return null;
   }

   public function login() {
      $u = self::get($this->mail, $this->password);

      if ($u != null) {
         $_SESSION['mail'] = $u->mail;
      } else {
         $this->errors['anmeldung'] = "Anmeldedaten inkorrekt"; 
      }
   }

   public function getErrors() : array {
      return $this->errors;
   }

   public function hasErrors() : bool {
      return !empty($this->errors);
   }

   public static function logout() {
      unset($_SESSION['mail']);
   }

   public function isLoggedIn() : bool {
      return isset($_SESSION['mail']) && strlen($_SESSION['mail']) > 0;
   }

   public function getMail() : string {
      return $this->mail;
   }

   public function setMail($u) {
         $this->mail = $u;        
   }

   public function getPassword() : string {
         return $this->password;
   }

   public function setPassword($p) {
         $this->password = $p;
   }

}