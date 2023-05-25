<?php 
ob_start();
session_start();
include 'baglan.php';

if(isset($_POST['kullanicikaydet'])) {
    $kullanici_tc = isset($_POST['kullanici_tc']) ? $_POST['kullanici_tc'] : null;
    $kullanici_adsoyad = isset($_POST['kullanici_adsoyad']) ? $_POST['kullanici_adsoyad'] : null;
    $kullanici_password = isset($_POST['kullanici_password']) ? $_POST['kullanici_password'] : null;

    //veritabanı ekleme İşlemi
    $sorgu = $db->prepare('INSERT INTO kullanici SET
        kullanici_tc = ?,
        kullanici_adsoyad = ?,
        kullanici_password = ?');

        $ekle = $sorgu->execute([
            $kullanici_tc, $kullanici_adsoyad, $kullanici_password
        ]);
        if($ekle) {
            header('location: index.php?durum=basarili');
        } else{
           $hata = $sorgu->errorInfo();
           echo 'mysql hatası' .$hata[2];
        }
}

if(isset($_POST['giris_yap'])) {
    $kullanici_tc = $_POST['kullanici_tc'];
    $kullanici_password = $_POST['kullanici_password'];

    $kullanicisor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_tc=:kullanici_tc and 
    kullanici_password=:kullanici_password");
    $kullanicisor->execute([
        'kullanici_tc' => $kullanici_tc,
        'kullanici_password' => $kullanici_password
    ]);

    $say = $kullanicisor->rowCount();

    if ($say==1) {
        $_SESSION['userkullanici_tc']=$kullanici_tc;
        header('location: anasayfa.php?durum=girisbasarili');
        exit;
    } else{
        header('location: index.php?durum=basarisizgiriş');
        exit;
    }
}

if(isset($_POST['randevukaydet'])) {
    $randevu_sehir = isset($_POST['randevu_sehir']) ? $_POST['randevu_sehir'] : null;
    $randevu_hastane = isset($_POST['randevu_hastane']) ? $_POST['randevu_hastane'] : null;
    $randevu_doktor = isset($_POST['randevu_doktor']) ? $_POST['randevu_doktor'] : null;
    $randevu_tarih = isset($_POST['randevu_tarih']) ? $_POST['randevu_tarih'] : null;
    $randevu_klinik = isset($_POST['randevu_klinik']) ? $_POST['randevu_klinik'] : null;
    $randevu_hasta_id = isset($_POST['kullanici_id']) ? $_POST['kullanici_id'] : null;
     
    //veritabanı ekleme işlemi
    $kaydet=$db->prepare('INSERT INTO randevu SET
        randevu_sehir = ?,
        randevu_hastane = ?,
        randevu_doktor = ?,
        randevu_tarih = ?,
        randevu_klinik = ?,
        randevu_hasta_id = ?
    ');

    $insert=$kaydet->execute([
        $randevu_sehir, $randevu_hastane, $randevu_doktor, $randevu_tarih, $randevu_klinik, $randevu_hasta_id
    ]);
    if($insert) {
        header("location:anasayfa.php?basarili_kayit");
    } else{
      header("location:anasayfa.php?basarisiz_kayit");
    }

}



?>

