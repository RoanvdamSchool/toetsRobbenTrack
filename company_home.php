<?php
include_once('header_company.php');
?>
<div id="likedCompanyContainer" class='col-5 offset-1'>
    <h2 class='text-center mb-3'>your costumers</h2>
    <div id="likedCompanyGrid">
        <div class="companyContainer">
            <p>name: costumer_name</p>
            <p>region: costumer_region</p>
        </div>
        
        <div class="companyContainer">
        
        </div>
        
        <div class="companyContainer">
        
        </div>
        
        <div class="companyContainer">
        
        </div>
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