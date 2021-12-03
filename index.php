<?php
    error_reporting(0);
    require_once './connection.php';

    $nik = $_GET['nik'];

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
        $arr = $query->fetch_assoc();
        
        $firstValidate = !is_null($arr) && $day < 72 && $month < 13 && $uniq < 30;
        $secondValidate = $year < $_timeLess16 || $year > $_timeMore70;

        if($firstValidate && $secondValidate) {
            header("HTTP/1.1 200 OK");
        }else{
            header("HTTP/1.1 500");
            exit();
        }
    }else {
        header("HTTP/1.1 404 Not Found");
        exit();
    }
?>