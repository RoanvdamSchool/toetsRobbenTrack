<?php

$serverName = "localhost";
$user = "root";
$password = "";
$dbname = "track_and_treat";

try {
  $pdo = new PDO("mysql:host=$serverName;dbname=$dbname", $user, $password);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$sql = "CREATE TABLE IF NOT EXISTS users (
    user_id mediumint AUTO_INCREMENT PRIMARY KEY,
    user_name varchar(30),
    password varchar(255),
    user_is_company int(1),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_region varchar(50),
    user_location varchar(255)
)
";
$pdo->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS follow_system (
    follow_system_id bigint AUTO_INCREMENT PRIMARY KEY,
    costumer_id mediumint,
    company_id mediumint,
    FOREIGN KEY (costumer_id) REFERENCES users(user_id),
    FOREIGN KEY (company_id) REFERENCES users(user_id)
)
";
$pdo->exec($sql);