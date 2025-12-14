<?php
$db = new PDO('sqlite:../data/nasipadang.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
