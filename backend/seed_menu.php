<?php
// Jalankan sekali untuk mengisi menu awal
$db = new PDO('sqlite:../data/nasipadang.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$menus = [
    ['Rendang',25000,'rendang.jpg'],
    ['Ayam Pop',18000,'ayampop.jpg'],
    ['Gulai Tunjang',22000,'tunjang.jpg'],
    ['Sate Padang',20000,'sate.jpg'],
    ['Dendeng Balado',23000,'dendeng.jpg'],
    ['Ikan Balado',21000,'ikan.jpg'],
    ['Telur Balado',9000,'telur.jpg'],
    ['Sambal Ijo',7000,'sambal.jpg'],
    ['Sayur Nangka',8000,'nangka.jpg'],
    ['Teh Manis',5000,'teh.jpg'],
    ['Es Jeruk',7000,'jeruk.jpg'],
    ['Air Mineral',4000,'air.jpg']
];
foreach($menus as $m) {
    $db->prepare('INSERT INTO menu (name,price,img) VALUES (?,?,?)')->execute($m);
}
echo "Menu seeded.";
