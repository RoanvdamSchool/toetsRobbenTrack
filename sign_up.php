<?php
include_once("header.php");
?>

<div id="loginAndSignUpContainer" class="col-6 offset-3">
    <h2 class="loginAndSignUpText">sign up</h2>
    <form method="post">
        <label for="username" class="inputLabel mb-2">username:</label><br>
        <input type="text" name="username" class="inputField col-8 offset-2 mb-3"><br>
        <h3 class="text-center">I am a:</h3>
        <section id="roleSelection">
            <input type="radio" name="role" id="costumer" value="0" checked='checked'>
            <label for="costumer">costumer</label><br>
            <input type="radio" name="role" id="company" value="1">
            <label for="company">company</label><br>
        </section>
        <label for="password" class="inputLabel mb-2">password:</label><br>
        <input type="password" name="password" class="inputField col-8 offset-2"><br>
        <input type="submit" value="sign up" name="sign_up" class="col-4 offset-4 mt-4 mb-4">
    </form>
    <a href="index.php" class="offset-8">or login here</a>
</div>

<?php
include_once("footer.php");    

var_dump($_POST);
if (isset($_POST['sign_up'])) {
    $sql = "INSERT INTO users (user_name, password, user_is_company) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT), intval($_POST['role'])]);
    
    $sql = 'SELECT * FROM users WHERE user_name = :user_name';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            'user_name' => $_POST['username']
        )
    );
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $_SESSION['id'] = $user['user_id'];
    $_SESSION['name'] = $_POST['username'];
    $_SESSION['is_company'] = intval($_POST['role']); 
    
    if ($_SESSION['is_company'] == 0) {
        header("location:costumer_home.php");
    }
    if ($_SESSION['is_company'] == 1) {
        header("location:company_home.php");
    }
}

/*
INSERT INTO Customers (CustomerName, ContactName, Address, City, PostalCode, Country)
VALUES ('Cardinal', 'Tom B. Erichsen', 'Skagen 21', 'Stavanger', '4006', 'Norway');
else {
            createAccount($_POST["email"], $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["password"] = $user["password"];
            if (isset($_SESSION["username"]) ) {
                header("location: home.php");
            }
        }
    }
}

// function that inserts all input fields to the database
function createAccount($email, $username, $password) {
    $conn = connectDatabase("netfish");
    $pdo = "INSERT INTO user (username, email, password, is_admin)
            VALUES (:username, :email, :password, 0)";
    $stm = $conn->prepare($pdo);
    
    $stm->bindParam(':username', $username);
    $stm->bindParam(':email', $email);
    $stm->bindParam(':password', $password);
    
    $stm->execute();
    $user = $stm->fetch();
    return $user;
}
*/
?>