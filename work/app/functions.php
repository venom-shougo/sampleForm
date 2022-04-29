<?php

session_start();

setToken();

/**
 * XSS対策：エスケープ処理
 * @param string $str
 * @return string
 */
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * CSRF対策：ワンタイムトークン
 * @param void
 * @return string $csrf_token
 */
// トークン生成
function setToken()
{
  if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }
  return $_SESSION['csrf_token'];
}

// トークン照会
function validateToken()
{
  if (empty($_SESSION['csrf_token']) || 
  $_SESSION['csrf_token'] !== filter_input(INPUT_POST, 'csrf_token')) {
    exit('Invalid post request');
  }
}


