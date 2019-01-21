<?php

$pdo = new PDO('mysql:host=mysql:3306;dbname=base_database', 'root', '');
$result = $pdo->query("SELECT * FROM base_table")->fetch();
echo sprintf("%s [Installed %s]", $result['info'], $result['created_at']);