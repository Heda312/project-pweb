<?php
header('Content-Type: application/json');
$db = new PDO('sqlite:../data/nasipadang.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$res = $db->query('SELECT * FROM menu')->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($res);
