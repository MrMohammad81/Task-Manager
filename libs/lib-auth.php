<?php defined('BASE_PATH')  or die("Permision Denied");

# check Login
function isLogedIn()
{
  return isset($_SESSION['login']) ? true : false ;
}

# Get User Email
function getUserEmail($email)
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE Email = :email";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute([':email' => $email]);
    $records = $stmt -> fetchAll(PDO::FETCH_OBJ);
    return $records[0] ?? null;
}

# Login To Form
function login($email , $pass)
{
    $user = getUserEmail($email);
    if (is_null($user))
    {
        return false;
    }
   # check the password
    if (password_verify($pass , $user -> Password))
    {
        # Login Success
        $_SESSION['login'] = $user;
        return true;
    }
    return false;
}

# SingUp
function register($userData)
{
        global $pdo;
        $pass = $userData['password'];
        $passHash = password_hash($userData['password'], PASSWORD_BCRYPT);
        $sql = "INSERT INTO `users` (name,email,password) VALUES (:user_name,:email,:pass);";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_name' => $userData['fullname'], ':email' => $userData['email'], ':pass' => $passHash]);
        $result = $stmt -> rowCount();
        if ($result > 0)
        {
           Messeg("Your email is already registered");
           return $result = false;
        }
        return $result = true;
}
