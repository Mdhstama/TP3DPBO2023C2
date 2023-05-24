<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Player.php');
include('classes/Club.php');
include('classes/Role.php');
include('classes/Template.php');

$player = new Player($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$player->open();

$data = nulL;

// Delete Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($player->deletePlayer($id) > 0) {
        echo "<script>
        if (confirm('Apakah Anda ingin menghapus data?')) {
            alert('Data berhasil dihapus!');
            document.location.href = 'index.php';
        } else {
            // Jika pengguna membatalkan penghapusan, arahkan kembali ke halaman sebelumnya
            history.back();
        }
    </script>";
    } else {
        echo "<script>
        alert('Data gagal dihapus!');
        document.location.href = 'index.php';
    </script>";
    }
}

// View Data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $player->getHumanByIdJoin($id);
    $row = $player->getResult();

    $data .= '<div class="card-header text-center">
        <h3 class="my-0">' . $row['real_name'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/' . $row['img'] . '" class="img-thumbnail" alt="' . $row['img'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td>' . $row['real_name'] . '</td>
                                </tr>
                                <tr>
                                    <td>In-Game Nickname</td>
                                    <td>:</td>
                                    <td>' . $row['in_game_nickname'] . '</td>
                                </tr>
                                <tr>
                                    <td>Nationality</td>
                                    <td>:</td>
                                    <td>' . $row['nationality'] . '</td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td>' . $row['name_role'] . '</td>
                                </tr>
                                <tr>
                                    <td>role</td>
                                    <td>:</td>
                                    <td>' . $row['name_team'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="#"><button type="button" class="btn btn-success text-white">Update Data</button></a>
                <a href="detail_player.php?hapus=' . $row['id_player'] . '"><button type="button" class="btn btn-danger">Delete Data</button></a>
            </div>';
}


$player->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_PLAYER', $data);
$detail->write();