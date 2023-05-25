<?php 
include 'header.php'; 

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stil.css">
    <title>Hastane Otomasyon</title>
</head>
<body>

<table>
    <tr>
        <th>Hastane</th>
        <th>Klinik</th>
        <th>Doktor</th>
        <th>Şehir</th>
        <th>Tarih</th>
    </tr>

    <?php 
    $randevusor = $db->prepare("SELECT * FROM randevu
    INNER JOIN kullanici ON randevu.randevu_hasta_id = kullanici.kullanici_id WHERE kullanici_tc=:kullanici_tc");
    $randevusor->execute([
        'kullanici_tc' => $_SESSION['userkullanici_tc']
    ]);
    while ($randevucek = $randevusor->fetch(PDO::FETCH_ASSOC)) { ?>

    <tr>
        <td><?php echo $randevucek['randevu_hastane']; ?></td>
        <td><?php echo $randevucek['randevu_klinik']; ?></td>
        <td><?php echo $randevucek['randevu_doktor']; ?></td>
        <td><?php echo $randevucek['randevu_sehir']; ?></td>
        <td><?php echo $randevucek['randevu_tarih']; ?></td>
    </tr>
    <?php } ?>
    </table>

    
</body>
</html>