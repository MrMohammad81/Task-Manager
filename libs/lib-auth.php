<?php defined('BASE_PATH')  or die("Permision Denied");

/*------------------- check Login ------------*/
function isLogedIn()
{
  return isset($_SESSION['login']) ? true : false ;
}

/*------------ get User Id-------------*/
function getCurrentUserId()
{
   return getLoggedInUser() -> ID ?? 0;
}

# get user info

function getLoggedInUser()
{
    return $_SESSION['login'] ?? null ;
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
        $user -> img = $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim($user -> Email)));
        $_SESSION['login'] = $user;
        return true;
    }
    return false;
}

# check email register
function isEmailRegister($email)
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE Email = :email";
    $stmt = $pdo -> prepare($sql);
    $stmt ->execute(['email' => $email]);
    return $stmt ;

}

# SingUp
function register($userData)
{
        global $pdo;
        $pass = $userData['password'];
        $passHash = password_hash($userData['password'], PASSWORD_BCRYPT);
        $sql = "INSERT INTO `users` (name,email,password) VALUES (:user_name,:email,:pass);";
        $stmt = $pdo->prepare($sql);
    if (isEmailRegister($userData['email']) -> rowCount() > 0)
    {
        Messeg("This email has already been registered");
        return false;
    }
        $stmt->execute([':user_name' => $userData['fullname'], ':email' => $userData['email'], ':pass' => $passHash]);

        return $result = true;
}


/*------- Log out -------------*/
function loggedOut()
{
    unset($_SESSION['login']);
}

/*--------- Redirect ---------*/
function redirect($url)
{
    header("Location: $url");
    die();
}