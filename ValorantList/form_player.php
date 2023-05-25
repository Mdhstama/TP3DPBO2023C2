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

// Add Data
if (isset($_POST['button_add'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if ($player->updatePlayer($id, $_POST, $_FILES) > 0) {
            echo "<script>
                    alert('Data berhasil diupdate!');
                    document.location.href = 'index.php';
                </script>";
        } else {
            echo "<script>
                    alert('Data gagal diupdate!');
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
    $dataRole .= '<option value="' . $tempRole['id_role'] . '">' . $tempRole['name_role'] . '</option>';
}

// Update Player 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $player->getHumanByIdJoin($id);
        $row = $player->getResult();

        $name_update = $row['real_name'];
        $nick_update = $row['in_game_nickname'];
        $nation_update = $row['nationality'];
        $club_update = $row['id_club'];
        $role_update = $row['id_role'];

        $dataClubOptions = NULL;
        $club->getClub();
        while ($tempClub = $club->getResult()) {
            $selected = ($club_update == $tempClub['id_club'] ? 'selected' : '');
            $dataClubOptions .= "<option value=" . $tempClub['id_club'] . " " . $selected . ">" . $tempClub['name_team'] . "</option>";
        }

        $dataRoleOptions = NULL;
        $role->getRole();
        while ($tempRole = $role->getResult()) {
            $selectedRole = ($role_update == $tempRole['id_role'] ? 'selected' : '');
            $dataRoleOptions .= '<option value="' . $tempRole['id_role'] . '" ' . $selectedRole . '>' . $tempRole['name_role'] . '</option>';
        }

        $player->close();
        $role->close();
        $club->close();

        $tambah = new Template('templates/skinformplayer.html');
        $tambah->replace('DATA_TITLE', $title);
        $tambah->replace('DATA_REAL_NAME', $name_update);
        $tambah->replace('DATA_IN_GAME_NICKNAME', $nick_update);
        $tambah->replace('DATA_NATIONALITY', $nation_update);
        $tambah->replace('DATA_CL', $dataClubOptions);
        $tambah->replace('DATA_VAL_RL', $dataRoleOptions);
        $tambah->write();
        exit();
    }
}

$player->close();
$role->close();
$club->close();

$addEdit = new Template('templates/skinformplayer.html');
$addEdit->replace('DATA_TITLE', $title);
$addEdit->replace('DATA_CLUB', $dataClub);
$addEdit->replace('DATA_ROLE', $dataRole);
$addEdit->replace('DATA_CL', '');
$addEdit->replace('DATA_VAL_RL', '');
$addEdit->write();

?>