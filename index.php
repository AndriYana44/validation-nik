<?php
    error_reporting(0);
    require_once './connection.php';

    if(isset($_POST['cek'])) {
        $nik = $_POST['nik'];

        $_timeLess16 = substr(date("Y", strtotime("-16 year")), 2, 2);
        $_timeMore70 = substr(date('Y', strtotime("-60 year")), 2, 2);

        $districts = substr($nik, 0, 6);
        $day = substr($nik, 6, 2);
        $month = substr($nik, 8, 2);
        $year = substr($nik, 10, 2);
        $uniq = substr($nik, 12, 4);

        if(strlen($nik) < 17 && strlen($nik) > 15) {
            $sql = "SELECT * FROM districts WHERE code = '$districts'";
            $query = $conn->query($sql);
            $result = $query->fetch_assoc();
            
            $firstValidate = !is_null($result) && $day < 72 && $month < 13 && $uniq < 30;
            $secondValidate = $year < $_timeLess16 || $year > $_timeMore70;

            if($firstValidate && $secondValidate) {
                var_dump($result);
                // controlling censor mlx
            }else{
                // indikator error HIGH
            }
        }else {
            // indikator error HIGH
        }
    }
?>

<form action="" method="post" id="form-nik">
    <input type="number" name="nik" placeholder="Masukan NIK" autocomplete="off">
    <button type="submit" name="cek">Cek</button>
</form>