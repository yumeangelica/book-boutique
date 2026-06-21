<?php

namespace Controller;

class Csrf
{
  public static function token()
  {
    if (empty($_SESSION['csrf_token'])) {
      self::regenerate();
    }

    return $_SESSION['csrf_token'];
  }

  public static function regenerate()
  {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }

  public static function validate($token)
  {
    return isset($_SESSION['csrf_token'])
      && is_string($token)
      && hash_equals($_SESSION['csrf_token'], $token);
  }
}
