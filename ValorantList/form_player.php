<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Player.php');
include('classes/Role.php');
include('classes/Club.php');
include('classes/Template.php');

$player = new Player($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$role = new Role($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$club = new Club($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$player->open();
$role->open();
$club->open();

$dataClub = null;
$dataRole = null;

if (isset($_POST['button_add'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if ($player->updatePlayer($id, $_POST, $_FILES) > 0) {
            echo "<script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'index.php';
                </script>";
        } else {
            echo "<script>
                    alert('Data gagal diubah!');
                    document.location.href = 'index.php';
                </script>";
        }
    } else {
        if ($player->addPlayer($_POST, $_FILES) > 0) {
            echo "<script>
                    alert('Data berhasil ditambah!');
                    document.location.href = 'index.php';
                </script>";
        } else {
            echo "<script>
                    alert('Data gagal ditambah!');
                    // document.location.href = 'index.php';
                </script>";
        }
    }
}

$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id) {
    $title = 'Edit';
} else {
    $title = 'Add';
}

$club->getClub();
$role->getRole();

$listClub = [];
while ($tempClub = $club->getResult()) {
    $dataClub .= '<option value="' . $tempClub['id_club'] . '">' . $tempClub['name_team'] . '</option>';
}

$listRole = [];
while ($tempRole = $role->getResult()) {
    $dataRole .= '<option value="' . $tempRole['id_role'] . '">' . $tempRole['type_role'] . ' - ' . $tempRole['name_role'] . '</option>';
}

$player->close();
$role->close();
$club->close();

$addEdit = new Template('templates/skinformplayer.html');
$addEdit->replace('DATA_TITLE', $title);
$addEdit->replace('DATA_CLUB', $dataClub);
$addEdit->replace('DATA_ROLE', $dataRole);
$addEdit->replace('DATA_CL', '');
$addEdit->replace('DATA_RL', '');
$addEdit->write();

?>