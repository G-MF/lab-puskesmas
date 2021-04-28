<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

// Simpan
if (isset($_POST['tambah'])) {
    $id_pemeriksaan = strip_tags($_POST['id_pemeriksaan']);
    $no_antri       = strip_tags($_POST['no_antri']);
    $nama           = strip_tags($_POST['nama']);
    $nama_dokter    = strip_tags($_POST['nama_dokter']);
    $keterangan     = strip_tags($_POST['keterangan']);
    $tgl_periksa    = $_POST['tgl_periksa'];

    $leucosit       = $_POST['leucosit'];
    $trombosit      = $_POST['trombosit'];
    $malaria        = $_POST['malaria'];
    $rapid_covid    = $_POST['rapid_covid'];
    $gds            = $_POST['gds'];
    $gdp            = $_POST['gdp'];
    $cholesterol    = $_POST['cholesterol'];
    $trigliserida   = $_POST['trigliserida'];
    $protein        = $_POST['protein'];
    $golongan_darah = $_POST['golongan_darah'];
    $biaya          = str_replace('.', '', $_POST['biaya']);
    $kesimpulan     = $_POST['kesimpulan'];
    $tgl_hasil      = $_POST['tgl_hasil'];

    $ambil_id_antri = $koneksi->query("SELECT * FROM pemeriksaan pm INNER JOIN penerimaan p ON pm.id_pemeriksaan = p.id_penerimaan WHERE pm.id_pemeriksaan = '$id_pemeriksaan'")->fetch_array();

    $cek  = $koneksi->query("SELECT * FROM hasil_pemeriksaan WHERE id_pemeriksaan = '$id_pemeriksaan' AND tgl_hasil = '$tgl_hasil'")->fetch_array();
    if ($cek) {
        $_SESSION['alert'] = 'ID Pemeriksaan Sudah Ada!';
        $_SESSION['valid'] = [
            'id_pemeriksaan' => $id_pemeriksaan,
            'no_antri'       => $no_antri,
            'nama'           => $nama,
            'nama_dokter'    => $nama_dokter,
            'keterangan'     => $keterangan,
            'tgl_periksa'    => $tgl_periksa,
            'leucosit'       => $leucosit,
            'trombosit'      => $trombosit,
            'malaria'        => $malaria,
            'rapid_covid'    => $rapid_covid,
            'gds'            => $gds,
            'gdp'            => $gdp,
            'cholesterol'    => $cholesterol,
            'trigliserida'   => $trigliserida,
            'protein'        => $protein,
            'golongan_darah' => $golongan_darah,
            'kesimpulan'     => $kesimpulan,
            'tgl_hasil'      => $tgl_lahir,
            'biaya'          => $biaya,
        ];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        $submit = $koneksi->query("INSERT INTO hasil_pemeriksaan VALUES(
            NULL, '$id_pemeriksaan', '$leucosit', '$trombosit', '$malaria', '$rapid_covid', '$gds', '$gdp', '$cholesterol', '$trigliserida', '$protein', '$golongan_darah', '$biaya', '$kesimpulan', '$tgl_hasil'
            )");

        if ($submit) {
            $_SESSION['alert'] = "Data Berhasil Disimpan";
            $koneksi->query("UPDATE nomor_antri set status = 'Selesai' WHERE id_antri = '$ambil_id_antri[id_antri]'");
            unset($_SESSION['valid']);
            header("location: ../hasil-pemeriksaan", true, 301);
        } else {
            $_SESSION['alert'] = 'Data Gagal Disimpan!';
            $_SESSION['valid'] = [
                'id_pemeriksaan' => $id_pemeriksaan,
                'no_antri'       => $no_antri,
                'nama'           => $nama,
                'nama_dokter'    => $nama_dokter,
                'keterangan'     => $keterangan,
                'tgl_periksa'    => $tgl_periksa,
                'leucosit'       => $leucosit,
                'trombosit'      => $trombosit,
                'malaria'        => $malaria,
                'rapid_covid'    => $rapid_covid,
                'gds'            => $gds,
                'gdp'            => $gdp,
                'cholesterol'    => $cholesterol,
                'trigliserida'   => $trigliserida,
                'protein'        => $protein,
                'golongan_darah' => $golongan_darah,
                'kesimpulan'     => $kesimpulan,
                'tgl_hasil'      => $tgl_hasil,
                'biaya'          => $biaya,
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
} else

    // Edit
    if (isset($_POST['edit'])) {
        $id_hasil       = strip_tags($_POST['id_hasil']);
        $id_pemeriksaan = strip_tags($_POST['id_pemeriksaan']);
        $no_antri       = strip_tags($_POST['no_antri']);
        $nama           = strip_tags($_POST['nama']);
        $keterangan     = strip_tags($_POST['keterangan']);
        $tgl_periksa    = $_POST['tgl_periksa'];

        $leucosit       = $_POST['leucosit'];
        $trombosit      = $_POST['trombosit'];
        $malaria        = $_POST['malaria'];
        $rapid_covid    = $_POST['rapid_covid'];
        $gds            = $_POST['gds'];
        $gdp            = $_POST['gdp'];
        $cholesterol    = $_POST['cholesterol'];
        $trigliserida   = $_POST['trigliserida'];
        $protein        = $_POST['protein'];
        $golongan_darah = $_POST['golongan_darah'];
        $biaya          = str_replace('.', '', $_POST['biaya']);
        $kesimpulan     = $_POST['kesimpulan'];
        $tgl_hasil      = $_POST['tgl_hasil'];


        $cek  = $koneksi->query("SELECT * FROM hasil_pemeriksaan WHERE id_hasil != '$id_hasil' AND tgl_hasil = '$tgl_hasil'")->fetch_array();
        if ($cek['id_pemeriksaan'] == $id_pemeriksaan) {
            $_SESSION['alert'] = 'ID Pemeriksaan Sudah Ada!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {

            $submit = $koneksi->query("UPDATE hasil_pemeriksaan SET
                    id_pemeriksaan = '$id_pemeriksaan', 
                    leucosit       = '$leucosit', 
                    trombosit      = '$trombosit', 
                    malaria        = '$malaria', 
                    rapid_covid    = '$rapid_covid', 
                    gds            = '$gds', 
                    gdp            = '$gdp', 
                    cholesterol    = '$cholesterol',
                    trigliserida   = '$trigliserida', 
                    protein        = '$protein', 
                    golongan_darah = '$golongan_darah', 
                    biaya          = '$biaya', 
                    kesimpulan     = '$kesimpulan', 
                    tgl_hasil      = '$tgl_hasil'
                    WHERE id_hasil = '$id_hasil'
                ");

            if ($submit) {
                $_SESSION['alert'] = "Data Berhasil Diubah";
                unset($_SESSION['valid']);
                header("location: ../hasil-pemeriksaan", true, 301);
            } else {
                $_SESSION['alert'] = 'Data Gagal Diubah!';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    } else

        // Hapus
        if (isset($_GET['id'])) {
            $hapus = $koneksi->query("DELETE FROM hasil_pemeriksaan WHERE id_hasil = '$_GET[id]'");

            if ($hapus) {
                $_SESSION['alert'] = "Data Berhasil Dihapus";
                header("location: ../hasil-pemeriksaan", true, 301);
            }
        }

// Ambil Data Nomor Antrian
if (isset($_POST['id_pemeriksaan'])) {
    $id_pemeriksaan = $_POST['id_pemeriksaan'];
    $data          = $koneksi->query("SELECT * FROM pemeriksaan pm INNER JOIN penerimaan p ON pm.id_penerimaan = p.id_penerimaan INNER JOIN nomor_antri n ON p.id_antri = n.id_antri INNER JOIN pasien pn ON n.id_pasien = pn.id_pasien INNER JOIN dokter d ON pm.id_dokter = d.id_dokter WHERE pm.id_pemeriksaan = '$id_pemeriksaan'")->fetch_array();

    echo json_encode($data);
}
