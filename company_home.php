<?php
include_once('header_company.php');

$sql = "SELECT * FROM follow_system WHERE company_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(
    array(
        'user_id' => $_SESSION['id']
    )
);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($result);
$resultCount = count($result);

?>
<div id="likedCompanyContainer" class='col-5 offset-1'>
    <h2 class='text-center mb-3'>your costumers</h2>
    <div id="likedCompanyGrid">
        <?php
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        try {
            for ($i = 0; $i < $resultCount; $i++) {
                $stmt->execute(
                    array(
                        'user_id' => $result[$i]['costumer_id']
                    )
                );
                $costumers = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($costumers) {
                    ?>
                    <div class="companyContainer">
                        <p>name: <?=$costumers['user_name']?></p>
                        <p>region: <?=$costumers['user_region']?></p>
                    </div>
                    <?php
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
var_dump($_SESSION['id']);
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