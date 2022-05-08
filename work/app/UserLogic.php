<?php

/**クラスを定義
 * class UserLogicは連想配列を使い値を入れていく
 */
class UserLogic
{
  
  /**
   * 同ユーザーIDがないかチェック
   * @param array $uniqueuser
   * @return bool $result true|false
   */
  public static function checkUser($uniqueuser)
  {
    $result = false;

    $sql = "SELECT COUNT(id) FROM users WHERE username = :username";

    $arr = [];
    $arr[] = $uniqueuser['userid'];
    try {
      $stmt = Database::connect()->prepare($sql);
      $stmt->execute($arr);
      $result = $stmt->fetch();
      if ($result['COUNT(id)'] == 1) {
        $result = true;
        return $result;
      }
      $result = false;
      return $result;
    } catch (PDOException $e) {
      return $result;
    }
  }

  /**
   * ユーザを登録する
   * @param array $userData
   * @return bool $result
   */

  public static function createUser($userData) 
  {
    $result = false;

    $sql = "INSERT INTO users (username, password, name, address) VALUES (?, ?, ?, ?)";
    
    $arr = [];
    $arr[] = $userData['userid'];
    $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT);
    $arr[] = $userData['username'];
    $arr[] = $userData['email'];
    // var_dump($arr);
    // exit;
    try {
      $stmt = Database::connect()->prepare($sql); 
      $result = $stmt->execute($arr);
      return $result; 
    } catch(PDOException $e) {
      return $result; 
    }
  }

  /**
   * ログイン処理
   * @param string $userid
   * @param string $password
   * @return bool $result
   */
  public static function Login($userid, $password) 
  {
    $result = false;
    $user = self::getUserByIDname($userid);
    // var_dump($user);
    // return;
    // エラー分岐、IDが違う場合
    if (!$user) {
      $_SESSION['message'] = 'ID name dose not match';
      return $result;
    }
    
    // パスワード照会
    if (password_verify($password, $user['password'])) {
      // ログイン成功
      session_regenerate_id(true);
      $_SESSION['login_user'] = $user;
      $result = true;
      return $result;
    }
    
    $_SESSION['message'] = 'Password do not match';
    return $result;
  }

  /**
   * SQLからuserを取得
   * @param string $userid
   * @return array|bool $user|false
   */
  public static function getUserByIDname($userid) 
  {
    $sql = "SELECT * FROM users WHERE username = ?";
    
    $arr = [];
    $arr[] = $userid;

    try {
      $stmt = Database::connect()->prepare($sql); 
      $stmt->execute($arr);
      $user = $stmt->fetch();
      return $user; 
    } catch(PDOException $e) {
      return false; 
    }
  }

  /**
   * ログインチェック
   * @param void 
   * @return bool $result
   */
  public static function checkLogin()
  {
    $result = false;
    if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
      return $result = true;
    }
    return $result;
  }

  /**
   * ログアウト処理
   */
  public static function logout()
  {
    $result = false;
    $_SESSION = array();
    session_destroy();
    return $result = true;
  }

  /**
   * 退会処理
   * @param string $deleteuser
   * @return array|bool $user|false
   */
  public static function deleteuser() 
  {
    $result = false;
    if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] >0) {
      $arr = [];
      $loginuser = $_SESSION['login_user'];
      $arr[] = $loginuser['id'];
      // var_dump($arr);
      // exit;
      $sql = "DELETE FROM users WHERE id = ?";

      try {
        $stmt = Database::connect()->prepare($sql); 
        $stmt->execute($arr);
        $deleteuser = $stmt->fetch();
        $deleteuser = true;

        $_SESSION = array();
        session_destroy();
        return $deleteuser; 
      } catch(PDOException $e) {
        return false; 
      }
    }
  }
}
