<?php
session_start();
header('Content-Type: application/json');
if(!isset($_SESSION['user_id'])) { http_response_code(401); echo json_encode(['error'=>'Unauthorized']); exit; }
$db = new PDO('sqlite:../data/nasipadang.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$user_id = $_SESSION['user_id'];
$action = $_GET['action'] ?? '';
if($action==='get') {
    $cart = $db->prepare('SELECT c.id, m.name, m.price, m.img, c.qty, c.notes FROM cart c JOIN menu m ON c.menu_id=m.id WHERE c.user_id=?');
    $cart->execute([$user_id]);
    echo json_encode($cart->fetchAll(PDO::FETCH_ASSOC));
    exit;
}
if($action==='add') {
    $menu_id = (int)($_POST['menu_id'] ?? 0);
    $qty = (int)($_POST['qty'] ?? 1);
    $notes = $_POST['notes'] ?? '';
    if($menu_id) {
        $exists = $db->prepare('SELECT id FROM cart WHERE user_id=? AND menu_id=?');
        $exists->execute([$user_id,$menu_id]);
        if($row=$exists->fetch()) {
            if($qty > 0) {
                $db->prepare('UPDATE cart SET qty=?, notes=? WHERE id=?')->execute([$qty,$notes,$row['id']]);
            } else {
                $db->prepare('DELETE FROM cart WHERE id=?')->execute([$row['id']]);
            }
        } else {
            $db->prepare('INSERT INTO cart (user_id,menu_id,qty,notes) VALUES (?,?,?,?)')->execute([$user_id,$menu_id,$qty,$notes]);
        }
        echo json_encode(['success'=>true]);
        exit;
    }
}
if($action==='remove') {
    $cart_id = (int)($_POST['cart_id'] ?? 0);
    if($cart_id) {
        $db->prepare('DELETE FROM cart WHERE id=? AND user_id=?')->execute([$cart_id,$user_id]);
        echo json_encode(['success'=>true]);
        exit;
    }
}
echo json_encode(['error'=>'Invalid action']);
