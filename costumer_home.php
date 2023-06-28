<?php
include_once('header_costumer.php');

$sql = "SELECT * FROM follow_system WHERE costumer_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(
    array(
        'user_id' => $_SESSION['id']
    )
);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($result);
$resultCount = count($result);

$sql = "SELECT * FROM users WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(
    array(
        'user_id' => $_SESSION['id']
    )
);
$currentUser = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<div id="likedCompanyContainer" class='col-5 offset-1'>
    <h2 class='text-center mb-3'>your liked companies</h2>
    <div id="likedCompanyGrid">
        <?php
        // function for printing all companies which the user has liked
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        try {
            for ($i = 0; $i < $resultCount; $i++) {
                $stmt->execute(
                    array(
                        'user_id' => $result[$i]['company_id']
                    )
                );
                $company = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($company) {
                    $company_id = $company['user_id'];
                    ?>
                    <div class="companyContainer">
                        <p>Company name: <?= $company['user_name'] ?></p>
                        <p>Region: <?= $company['user_region'] ?></p>
                        <p>Location: <?= $company['user_location'] ?></p>
                        <form method="post">
                            <input type="hidden" value="<?= $company_id ?>" name="id">
                            <input type="submit" value="Unfollow" name="unfollow">
                        </form>
                        <p id="farFromLocationMessage"></p>
                    </div> 
                    <?php
                    if ($company['user_region'] != $currentUser['user_region']) {
                        ?>
                        <script>
                            const locationMessage = document.getElementById('farFromLocationMessage');
                            locationMessage.innerHTML = "currently far from your location";
                        </script>
                        <?php
                    }
                }
            }
        } catch (PDOException $e) {
            echo "<br>" . $e;
        }
        ?>
    </div>
</div>
<form method="post" id="setLocation">
    <label for="region" class="mb-2">set your region</label><br>
    <input type="text" name="region"><br>
    <label for="location" class="mb-2">set your location</label><br>
    <input type="text" name="location" class="mb-4"><br>
    <input type="submit" value="save location" name="submit_location">
</form>
<?php
include_once("footer.php");

// function for unfollowing a company
if (isset($_POST['unfollow']) ) {
    $sql = "DELETE FROM follow_system WHERE costumer_id = :costumer_id AND company_id = :company_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            'costumer_id' => $_SESSION['id'],
            'company_id' => $_POST['id']
        )
    );
}

// function for updating your own location
if(isset($_POST['submit_location']) ) {
    $sql = "UPDATE users SET user_region = :user_region, user_location = :user_location WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            'user_region' => $_POST['region'],
            'user_location' => $_POST['location'],
            'user_id' => $_SESSION['id']
        )
    );
}
?>