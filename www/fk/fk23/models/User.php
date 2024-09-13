<?php

class User {

    //Teil A: Erstellen Sie die Klasse User, sodass ein Login, Logout und Session-Behandlung möglich sind.

    private string $email;
    private string $password;
    private array $errors;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->errors = [];
    }

    private const ADMIN_EMAIL = "admin@fws.com";
    private const ADMIN_PASSWORD = "testitest";

    private static function get(string $email, string $password): ?User {
        if ($email == self::ADMIN_EMAIL && $password == self::ADMIN_PASSWORD) {
            return new User(self::ADMIN_EMAIL, self::ADMIN_PASSWORD);
        }
        return null;
    }

    public function login() {
        $u = self::get($this->email, $this->password);
        if ($u != null) {
            $_SESSION['email'] = $u->email;
         } else {
            $this->errors['anmeldung'] = "Anmeldedaten inkorrekt"; 
         }
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public static function isLoggedIn(): bool
    {
        return isset($_SESSION['email']) && strlen($_SESSION['email']) > 0;
    }

    public static function logOut() {
        unset($_SESSION['email']);
    }
}

?>