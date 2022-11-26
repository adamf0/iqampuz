<?php
set_time_limit(0);

require "koneksi.php";
// header('Content-Type: application/json');

function get_url($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    $result = json_decode($output);
    curl_close($ch);
    return $result;
}

$cs = get_url("https://dev-api.p2k.co.id/kpi/list?divisi=cs");
$unit = get_url("https://dev-api.p2k.co.id/kpi/list?divisi=unit");
$cs = $cs->listdata->datanya;
$unit = $unit->listdata->datanya;


if (isset($_POST['submit'])) {
    // mysqli_query($conn, "ALTER TABLE `kpi-kompetensi` AUTO_INCREMENT = 1");
    // mysqli_query($conn, "ALTER TABLE `closing` AUTO_INCREMENT = 1");


    // MASUKAN DATA DARI API KE DATABASE 
    // DIVISI CS
    function insertcs()
    {

        global $cs, $conn;
        $results_kpi_kom = mysqli_query($conn, "SELECT `minggu`,`nik`,`kategori`,`nilai` FROM `kpi-kompetensi`");
        $results_closing = mysqli_query($conn, "SELECT `bulan`,`nik`,`kategori`,`nilai`,`tahun` FROM `closing`");
        $cek_kpi_kom = array();
        $cek_closing = array();
        foreach ($results_kpi_kom as $result_kpi_kom) {
            $cek_kpi_kom[$result_kpi_kom['nik'] . "#" . $result_kpi_kom['minggu'] . "#" . $result_kpi_kom['kategori']] = $result_kpi_kom['nilai'];
        }
        foreach ($results_closing as $result_closing) {
            $cek_closing[$result_closing['nik'] . "#" . $result_closing['tahun'] . "#" . $result_closing['bulan'] . "#" . $result_closing['kategori']] = $result_closing['nilai'];
        }

        foreach ($cs as $dd) {
            // $nik = 'GG.2007.041083';
            // $closing = '321321';
            // $tahunClosing = '2022';
            // $bulanClosing = '1';

            // mysqli_query($conn, "UPDATE `closing` SET `nilai` = '$closing' WHERE `nik` = '$nik' AND `tahun` = '$tahunClosing' AND `bulan` = '$bulanClosing' AND `kategori` = 'CLOSING' ");

            // die;



            // foreach ($dd->kpi as $mingguKpi => $kpi) {

            //     if (isset($cek_kpi_kom[$dd->nik . "#" . $mingguKpi .  "#KPI"])) {

            //         if ($cek_kpi_kom[$dd->nik . "#" . $mingguKpi .  "#KPI"] == $kpi->nilai) {
            //             // KALO NILAI SAMA DI SKIP
            //         } else {
            //             mysqli_query($conn, "UPDATE `kpi-kompetensi` SET `nilai` = '$kpi->nilai', `grade` = '$kpi->grade' WHERE nik = '$dd->nik' AND minggu = '$mingguKpi' AND kategori = 'KPI'");
            //         }
            //     } else {
            //         // mysqli_query($conn, "INSERT INTO `kpi-kompetensi` VALUES ('KPI','','$dd->nik','$dd->nama','$kpi->nilai','$kpi->grade','$mingguKpi','2022','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','CS') ");
            //         mysqli_query($conn, "INSERT INTO `kpi-kompetensi` (`kategori`,`nik`,`nama`,`nilai`,`grade`,`minggu`,`tahun`,`jabatan`,`tingkat_jabatan`,`kelompok`,`status_karyawan`,`tanggal_masuk`,`divisi`) VALUES ('KPI','$dd->nik','$dd->nama','$kpi->nilai','$kpi->grade','$mingguKpi','2022','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','CS')");
            //     }
            // }

            // die;

            // foreach ($dd->kompetensi as $mingguKompetensi => $kompetensi) {
            //     if (isset($cek_kpi_kom[$dd->nik . "#" . $mingguKompetensi . "#KOMPETENSI"])) {
            //         if ($cek_kpi_kom[$dd->nik . "#" . $mingguKompetensi . "#KOMPETENSI"] == $kompetensi->nilai) {
            //         } else {
            //             mysqli_query($conn, "UPDATE `kpi-kompetensi` SET `nilai` = '$kompetensi->nilai', `grade` = '$kompetensi->grade' WHERE nik = '$dd->nik' AND minggu = '$mingguKompetensi' AND kategori = 'KOMPETENSI'");
            //         }
            //     } else {
            //         // mysqli_query($conn, "INSERT INTO `kpi-kompetensi` VALUES ('KOMPETENSI','','$dd->nik','$dd->nama','$kompetensi->nilai','$kompetensi->grade','$mingguKompetensi','2022','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','CS') ");
            //         mysqli_query($conn, "INSERT INTO `kpi-kompetensi` (`kategori`,`nik`,`nama`,`nilai`,`grade`,`minggu`,`tahun`,`jabatan`,`tingkat_jabatan`,`kelompok`,`status_karyawan`,`tanggal_masuk`,`divisi`) VALUES ('KOMPETENSI','$dd->nik','$dd->nama','$kompetensi->nilai','$kompetensi->grade','$mingguKompetensi','2022','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','CS')");
            //     }


            //     // mysqli_query($conn, "INSERT INTO `kpi-kompetensi` VALUES ('KOMPETENSI','','$dd->nik','$dd->nama','$kompetensi->nilai','$kompetensi->grade','$mingguKompetensi','2022','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','CS') ");
            // }

            // die;

            foreach ($dd->closing as $tahunClosing => $closings) {

                foreach ($closings as $bulanClosing => $closing) {

                    if (isset($cek_closing[$dd->nik . "#" . $tahunClosing . "#" . $bulanClosing . "#CLOSING"])) {
                        // echo "masuk";
                        // die;
                        if ($cek_closing[$dd->nik . "#" . $tahunClosing . "#" . $bulanClosing . "#CLOSING"] == $closing) {
                            // SKIP
                        } else {
                            mysqli_query($conn, "UPDATE `closing` SET `nilai` = '$closing' WHERE `nik` = '$dd->nik' AND `tahun` = '$tahunClosing' AND `bulan` = '$bulanClosing' AND `kategori` = 'CLOSING'");
                        }
                    } else {
                        // mysqli_query($conn, "INSERT INTO `closing` VALUES ('CLOSING','','$dd->nik','$dd->nama','$closing','$bulanClosing','$tahunClosing','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','CS') ");
                        echo "INSERT INTO `closing` (`kategori`,`nik`,`nama`,`nilai`,`bulan`,`tahun`,`jabatan`,`tingkat_jabatan`,`kelompok`,`status_karyawan`,`tanggal_masuk`,`divisi`) VALUES ('CLOSING','$dd->nik','$dd->nama','$closing','$bulanClosing','$tahunClosing','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','UNIT')";
                        mysqli_query($conn, "INSERT INTO `closing` (`kategori`,`nik`,`nama`,`nilai`,`bulan`,`tahun`,`jabatan`,`tingkat_jabatan`,`kelompok`,`status_karyawan`,`tanggal_masuk`,`divisi`) VALUES ('CLOSING','$dd->nik','$dd->nama','$closing','$bulanClosing','$tahunClosing','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','UNIT')");
                    }
                }
            }
        }

        // print_r($tahunClosing);
        // mysqli_query($conn, "INSERT INTO `closing` VALUES ('CLOSING','','$dd->nik','$dd->nama','$closing','$bulanClosing','$tahunClosing','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','CS') ");

        // echo mysqli_affected_rows($conn) > 0 ? '<script> alert("DATA CS BERHASIL DI INPUT") </script>' : '<script> alert("DATA CS GAGAL DI INPUT") </script>';

    }



    // MASUKAN DATA DARI API KE DATABASE 
    // DIVISI UNIT
    // function insertunit()
    // {
    //     global $unit, $conn;

    //     foreach ($unit as $dd) {
    //         // print_r($dd);
    //         // print_r($dd->kpi);
    //         foreach ($dd->kpi as $mingguKpi => $kpi) {
    //             // print_r($dd->tanggal_masuk . "<br>");
    //             mysqli_query($conn, "INSERT INTO `kpi-kompetensi` VALUES ('KPI','','$dd->nik','$dd->nama','$kpi->nilai','$kpi->grade','$mingguKpi','2022','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','UNIT') ");
    //         }

    //         foreach ($dd->kompetensi as $mingguKompetensi => $kompetensi) {
    //             // print_r($dd->tanggal_masuk . "<br>");
    //             mysqli_query($conn, "INSERT INTO `kpi-kompetensi` VALUES ('KOMPETENSI','','$dd->nik','$dd->nama','$kompetensi->nilai','$kompetensi->grade','$mingguKompetensi','2022','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','UNIT') ");
    //         }

    //         foreach ($dd->closing as $tahunClosing => $closings) {
    //             foreach ($closings as $bulanClosing => $closing) {
    //                 // print_r($tahunClosing);
    //                 mysqli_query($conn, "INSERT INTO `closing` VALUES ('CLOSING','','$dd->nik','$dd->nama','$closing','$bulanClosing','$tahunClosing','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','UNIT') ");
    //             }
    //         }
    //     }
    //     echo mysqli_affected_rows($conn) > 0 ? '<script> alert("DATA UNIT BERHASIL DI INPUT") </script>' : '<script> alert("DATA UNIT GAGAL DI INPUT") </script>';
    // }

    // echo mysqli_affected_rows($conn) > 0 ? '<script> alert("DATA BERHASIL DIUPDATE") </script>' : '<script> alert("DATA GAGAL DIUPDATE") </script>';

    insertcs();
    // insertunit();
}


// UPDATE CS
if (isset($_POST['update'])) {

    function update()
    {
        global $conn, $cs, $unit;


        if (mysqli_query($conn, "DELETE FROM `kpi-kompetensi`") and mysqli_query($conn, "DELETE FROM `closing`")) {
            // mysqli_query($conn, "INSERT INTO `kpi-kompetensi` (`kategori`) VALUES ('ok')");
            // mysqli_query($conn, "INSERT INTO `kpi-kompetensi` (`kategori`,`nik`,`nama`,`nilai`,`grade`,`minggu`,`tahun`,`jabatan`,`tingkat_jabatan`,`kelompok`,`status_karyawan`,`tanggal_masuk`,`divisi`) VALUES ('ok','ok','ok')");
            // mysqli_query($conn, "INSERT INTO `kpi-kompetensi` (`kategori`,`nik`,`nama`,`nilai`,`grade`) VALUES ('ok','ok','ok','12','DDD')");

            // die;

            mysqli_query($conn, "ALTER TABLE `kpi-kompetensi` AUTO_INCREMENT = 1");
            mysqli_query($conn, "ALTER TABLE `closing` AUTO_INCREMENT = 1");

            foreach ($cs as $dd) {

                foreach ($dd->kpi as $mingguKpi => $kpi) {
                    mysqli_query($conn, "INSERT INTO `kpi-kompetensi` (`kategori`,`nik`,`nama`,`nilai`,`grade`,`minggu`,`tahun`,`jabatan`,`tingkat_jabatan`,`kelompok`,`status_karyawan`,`tanggal_masuk`,`divisi`) VALUES ('KPI','$dd->nik','$dd->nama',$kpi->nilai,'$kpi->grade',$mingguKpi,'2022','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','CS')");
                    // mysqli_query($conn, "INSERT INTO `kpi-kompetensi` VALUES ('KPI','','$dd->nik','$dd->nama',$kpi->nilai,'$kpi->grade',$mingguKpi,2022,'$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','CS') ");
                }




                foreach ($dd->kompetensi as $mingguKompetensi => $kompetensi) {

                    // mysqli_query($conn, "INSERT INTO `kpi-kompetensi` VALUES ('KOMPETENSI','','$dd->nik','$dd->nama',$kompetensi->nilai,'$kompetensi->grade',$mingguKompetensi,2022,'$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','CS') ");
                    mysqli_query($conn, "INSERT INTO `kpi-kompetensi` (`kategori`,`nik`,`nama`,`nilai`,`grade`,`minggu`,`tahun`,`jabatan`,`tingkat_jabatan`,`kelompok`,`status_karyawan`,`tanggal_masuk`,`divisi`) VALUES ('KOMPETENSI','$dd->nik','$dd->nama',$kompetensi->nilai,'$kompetensi->grade',$mingguKompetensi,2022,'$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','CS')");
                }

                foreach ($dd->closing as $tahunClosing => $closings) {
                    foreach ($closings as $bulanClosing => $closing) {
                        mysqli_query($conn, "INSERT INTO `closing` (`kategori`,`nik`,`nama`,`nilai`,`bulan`,`tahun`,`jabatan`,`tingkat_jabatan`,`kelompok`,`status_karyawan`,`tanggal_masuk`,`divisi`) VALUES ('CLOSING','$dd->nik','$dd->nama','$closing','$bulanClosing','$tahunClosing','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','CS')");
                        // mysqli_query($conn, "INSERT INTO `closing` VALUES ('CLOSING','','$dd->nik','$dd->nama','$closing','$bulanClosing','$tahunClosing','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','CS') ");
                    }
                }
            }





            foreach ($unit as $dd) {

                foreach ($dd->kpi as $mingguKpi => $kpi) {
                    // mysqli_query($conn, "INSERT INTO `kpi-kompetensi` VALUES ('KPI','','$dd->nik','$dd->nama','$kpi->nilai','$kpi->grade','$mingguKpi','2022','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','UNIT') ");
                    mysqli_query($conn, "INSERT INTO `kpi-kompetensi` (`kategori`,`nik`,`nama`,`nilai`,`grade`,`minggu`,`tahun`,`jabatan`,`tingkat_jabatan`,`kelompok`,`status_karyawan`,`tanggal_masuk`,`divisi`) VALUES ('KPI','$dd->nik','$dd->nama','$kpi->nilai','$kpi->grade','$mingguKpi','2022','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','UNIT')");
                }

                foreach ($dd->kompetensi as $mingguKompetensi => $kompetensi) {
                    // mysqli_query($conn, "INSERT INTO `kpi-kompetensi` VALUES ('KOMPETENSI','','$dd->nik','$dd->nama','$kompetensi->nilai','$kompetensi->grade','$mingguKompetensi','2022','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','UNIT') ");
                    mysqli_query($conn, "INSERT INTO `kpi-kompetensi` (`kategori`,`nik`,`nama`,`nilai`,`grade`,`minggu`,`tahun`,`jabatan`,`tingkat_jabatan`,`kelompok`,`status_karyawan`,`tanggal_masuk`,`divisi`) VALUES ('KOMPETENSI','$dd->nik','$dd->nama','$kompetensi->nilai','$kompetensi->grade','$mingguKompetensi','2022','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','UNIT')");
                }

                foreach ($dd->closing as $tahunClosing => $closings) {
                    foreach ($closings as $bulanClosing => $closing) {
                        // mysqli_query($conn, "INSERT INTO `closing` VALUES ('CLOSING','','$dd->nik','$dd->nama','$closing','$bulanClosing','$tahunClosing','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','UNIT') ");
                        mysqli_query($conn, "INSERT INTO `closing` (`kategori`,`nik`,`nama`,`nilai`,`bulan`,`tahun`,`jabatan`,`tingkat_jabatan`,`kelompok`,`status_karyawan`,`tanggal_masuk`,`divisi`) VALUES ('CLOSING','$dd->nik','$dd->nama','$closing','$bulanClosing','$tahunClosing','$dd->jabatan','$dd->tingkat','$dd->kelompok','$dd->status_karyawan','$dd->tanggal_masuk','UNIT')");
                    }
                }
            }
            echo mysqli_affected_rows($conn) > 0 ? '<script> alert("DATA BERHASIL DIUPDATE") </script>' : '<script> alert("DATA GAGAL DIUPDATE") </script>';
        } else {
            echo "UPDATE DATA GAGAL... KLIK UPDATE KEMBALI DAN PASTIKAN INTERNET ANDA STABIL";
        }
    }

    update();

    header('Location: get_all_data.php');
}

$cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `kpi-kompetensi`"));



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">

            <div class="col-6">
                <form action="" method="post">
                    <button type="submit" name="update" class="btn btn-primary w-100 bg-gradient p-4 fw-semibold my-5 shadow-sm fs-3">Update data</button>
                </form>
            </div>

            <!-- <?php if ($cek == 0) { ?>
                <div class="col-6">
                    <form action="" method="post">
                        <button type="submit" name="submit" class="btn btn-success w-100 bg-gradient p-4 fw-semibold my-5 shadow-sm fs-3">Ambil data dari API</button>
                    </form>
                </div>
            <?php } else { ?>

                <div class="col-6">
                    <form action="" method="post">
                        <button type="submit" name="submit" class="btn btn-success w-100 bg-gradient p-4 fw-semibold my-5 shadow-sm fs-3" disabled>Ambil data dari API</button>
                    </form>
                </div>
            <?php } ?> -->

            <div class="col-6">
                <form action="" method="post">
                    <button type="submit" name="submit" class="btn btn-success w-100 bg-gradient p-4 fw-semibold my-5 shadow-sm fs-3">Ambil data dari API</button>
                </form>
            </div>


        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>