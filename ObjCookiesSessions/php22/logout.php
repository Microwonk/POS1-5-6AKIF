<?php

require_once "models/cookie_helper.php";
require_once "models/user.php";

if (!CookieHelper::checkCookiesAllowed()) {
   header("Location: index.php");
   exit();
}

User::logout();
header("Location: index.php");
exit();

