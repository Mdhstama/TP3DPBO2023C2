<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Player.php');
include('classes/Template.php');

// buat instance pengurus
$listPlayer = new Player($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listPlayer->open();

// tampilkan data pengurus
$listPlayer->getHumanJoin();

// cari pengurus
if (isset($_POST['btn-cari'])) {
    // methode mencari data pengurus
    $listPlayer->searchPlayer($_POST['cari']);
} else {
    // method menampilkan data pengurus
    $listPlayer->getHumanJoin();
}

$data = null;

// ambil data player
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listPlayer->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card m-2 pt-4 px-2 pengurus-thumbnail">
        <a href="detail_player.php?id=' . $row['id_player'] . '">
            <div class="row justify-content-center">
                <img src="assets/' . $row['img'] . '" class="card-img-top" alt="' . $row['img'] . '">
            </div>
            <div class="card-body">
                <p class="card-text pengurus-nama my-0">' . $row['in_game_nickname'] . '</p>
                <p class="card-text divisi-nama">' . $row['name_role'] . '</p>
                <p class="card-text jabatan-nama my-0">' . $row['name_team'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listPlayer->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_PLAYER', $data);
$home->write();