<?php

class ValidateForm
{
  /**
   * サインアップバリデーション
   * @param array $userData
   * @return array $err
   */
  public static function setSignup($userData)
  {
    $err = [];

    if (empty(trim($userData['username']))) {
      $err[] = 'Please enter your username!';
    }
    if (empty(trim(filter_var($userData['email'], FILTER_VALIDATE_EMAIL)))) {
      $err[] = 'Please enter your Email Address!';
    }
    if (empty(trim($userData['userid']))) {
      $err[] = 'Please enter your ID Name!';
    }
    $password = trim($userData['password']);
    if (!preg_match("/\A[a-z\d]{8,100}+\z/i", $password)) {
      $err[] = 'Please enter the password from 8 to 100 characters!';
    }
    $password_conf = trim($userData['password_conf']);
    if ($password !== $password_conf) {
      $err[] = 'Password and confirmation password are defferent!';
    }
    return $err;
  }

  /**
   * ログインバリデーション
   * @param array $userData
   * @param array $arr
   * @return array $err
   */
  public static function setForm($userData)
  {
    // var_dump($userData);
    // exit;
    $err = [];

    if (empty(trim($userData['userid']))) {
      $err['userid'] = 'Please enter your ID Name!';
    }
    if (empty(trim($userData['password']))) {
      $err['password'] = 'Password is incorrect!';
    }
    return $err;
  }

  /**
   * ログイン実行
   * @param array $userData
   * @return array $arr
   */

  public static function setLogin($userData)
  {
    $arr = [];
    if (!empty($userData)) {
      $arr = $userData;
    }
      return $arr;
  }
}