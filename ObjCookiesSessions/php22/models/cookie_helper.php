<?php

class CookieHelper {

   // Gültigkeitsdauer des Cookies: 30 Tage (in Sekunden)
   const COOKIE_EXPIRATION_TIME = 60 * 60 * 24 * 30;

   public static function checkCookiesAllowed() : bool {
      return isset($_COOKIE['allowed']) && $_COOKIE['allowed'];
   }

   public static function allowCookies() {
      setcookie('allowed', true, time() + self::COOKIE_EXPIRATION_TIME, "/");
   }
}