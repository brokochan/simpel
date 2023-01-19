<?php 
include "koneksi.php"; 
$kec = $koneksi->query("
SELECT count(*) as total, kecamatan.id_kecamatan, kecamatan FROM `minat_investasi` 
left join kecamatan on minat_investasi.id_kecamatan = kecamatan.id_kecamatan 
GROUP BY minat_investasi.id_kecamatan");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>SIM</title>
</head>
<body>
    <div class="wrapper">
        <div class="salam">
            <div class="animate__animated animate__backInDown">
                Izin OSS dan Non-OSS <br> 
                <div class="sub-salam">
                    Per Kecamatan <br>
                    Kabupaten Garut <br>
                </div>
            </div>
        </div>
        <div class="peta animate__animated animate__fadeInDown animate__delay-1s slow">
            <div class="sub-peta">
                <img src="assets/img/peta-garut.png" alt="peta garut" width="600px" class="gambar-peta">

                <?php 
                while($tkec = $kec->fetch_assoc()) {
                    if ($tkec['kecamatan'] == 'Blubur Limbangan'){
                        $tkec['kecamatan'] = 'bllimbangan';
                    } elseif ($tkec['kecamatan'] == 'Selaawi'){
                        $tkec['kecamatan'] = 'selawi';
                    }
                    $kecamatan = strtolower(str_replace(' ','_',$tkec['kecamatan']));
                ?>
                <!-- banjarwangi -->
                <img src="assets/img/direction.png" tabindex="0" data-container="body" class="titik <?php echo $kecamatan; ?> animate__animated animate__zoomInUp animate__delay-1s animate__slow" data-placement="top" data-toggle="popover" title="<?php echo $tkec['kecamatan']; ?>" data-html="true" data-content="Izin OSS = <?php echo $tkec['total']; ?> NIB <br/> Izin Non-OSS = 20 <br/> <a id='brem' href='detail.php?kec=<?php echo $tkec['id_kecamatan']; ?>'>Selengkapnya</a>">
                <?php } ?>


            </div>
        </div>
    </div>

</body>
<script>
  $(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $('.titik').on('hidden.bs.popover', function () {
     
    });
  });
</script>
</html>