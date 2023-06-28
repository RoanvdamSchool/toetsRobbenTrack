<?php
include_once("header.php");
?>

<div id="loginAndSignUpContainer" class="col-6 offset-3">
    <h2 class="loginAndSignUpText">login</h2>
    <form method="post">
        <label for="username" class="inputLabel mb-2">username:</label><br>
        <input type="text" name="username" class="inputField col-8 offset-2"><br>
        <label for="password" class="inputLabel mb-2">password:</label><br>
        <input type="password" name="password" class="inputField col-8 offset-2"><br>
        <input type="submit" value="login" name="login" class="col-4 offset-4 mt-4 mb-4">
    </form>
    <a href="sign_up.php" class="offset-8">or sign up here</a>
</div>

<?php
include_once("footer.php");

if (isset($_POST['login']) ) {
    $sql = 'SELECT * FROM users WHERE user_name = :user_name';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            'user_name' => $_POST['username']
        )
    );
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($_POST['password'], $user["password"])) {
        $_SESSION['id'] = $user['user_id'];
        $_SESSION['name'] = $user['user_name'];
        $_SESSION['is_company'] = $user['user_is_company'];
        
        
        if ($user['user_is_company'] == 0) {
            header('location:costumer_home.php');
        }   
        if ($user['user_is_company'] == 1) {
            header('location:company_home.php');
        }   
    }
    var_dump($user);
}
/*
$password = $_POST["password"];
            $query = "SELECT * FROM user WHERE username = :username";
            $stm = $conn->prepare($query);
            $stm->execute(
                array(
                    'username' => $_POST["username"]
                )
            );
            
            $user = $stm->fetch();
*/
?>