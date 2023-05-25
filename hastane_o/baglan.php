<?php

try {
    $db = new PDO("mysql:host=localhost; dbname=hastane_otomasyon; charest=utf8", 'root', '29615968');
    //echo 'veritabanı bağlantısı başarılı';
} catch (Exception $e) {
    echo $e->getMessage();
}


?>