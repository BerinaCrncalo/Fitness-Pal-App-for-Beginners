<?php
require_once "BaseDao.class.php";
require_once "Roles.php";

class UserDao extends BaseDao {

  public function __construct(){
    parent::__construct("admin");
  }

  public function get_user_by_email($email){
    return $this->query("SELECT * FROM admin WHERE email = :email", ['email' => $email]);
  }

  public function insertUser($email, $password){
    $hashedPassword = md5($password);
    $sql = "INSERT INTO admin (email, password) VALUES (:email, :password)";
    $params = [
      'email' => $email,
      'password' => $hashedPassword
    ];
    return $this->execute($sql, $params);
  }
}

// Insert the test user (run once)
$userDao = new UserDao();
$inserted = $userDao->insertUser('testuser@fitnesspal.test', 'fitness123');

if ($inserted) {
    echo "Test user created successfully.";
} else {
    echo "Failed to create test user or user already exists.";
}
?>
