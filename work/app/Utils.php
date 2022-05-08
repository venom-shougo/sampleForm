<?php

class Utils
{
  /**
   * XSS対策：エスケープ処理
   * @param string $str
   * @return string
   */
  public static function h($str)
  {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  }
}