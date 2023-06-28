<?php
include_once('header_costumer.php');
var_dump($_SESSION);

?>
<div id="companyListContainer" class='col-10 offset-1'>
    <h3 class='text-center'>all companies</h3>
    <div id="companyListGrid">
        <?php
        $sql = "SELECT * FROM users WHERE user_is_company = 1";
        $companies = $pdo->prepare($sql);

        try {
            $companies->execute(array());
            foreach ($companies as $company) {
                $company_id = $company['user_id'];
                ?>
                <div class="companyListBox">
                    <p>company name: <?=$company['user_name']?></p>
                    <p>region: <?=$company['user_region']?></p>
                    <p>location: <?=$company['user_location']?></p>
                    <form method="post">
                        <input type="hidden" name="id" value="<?=$company_id?>">
                        <input type="submit" value="follow" name="follow">
                    </form>
                </div>  
                <?php
            }
        }
    catch(PDOException $e) {
        echo "<br>$e";
    };
        ?>
    </div>
</div>
<?php
include_once("footer.php");

if (isset($_POST['follow']) ) {
    $sql = "SELECT * FROM follow_system WHERE costumer_id = :costumer_id AND company_id = :company_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            'costumer_id' => $_SESSION['id'],
            'company_id' => $_POST['id']
        )
    );
    $has_alreadyFollowed = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($has_alreadyFollowed) {
        
    }
    else {
        $sql = "INSERT INTO follow_system (costumer_id, company_id) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['id'], $_POST['id']]);
    }
}
?>