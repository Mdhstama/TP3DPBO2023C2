<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Club.php');
include('classes/Template.php');

$club = new Club($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$club->open();
$club->getClub();

// Search Data
if (isset($_POST['btn-cari'])) {
    $club->searchClub($_POST['cari']);
} else {
    $club->getClub();
}

//Add Data
if (!isset($_GET['id'])) {
    if (isset($_POST['submit_data'])) {
        if ($club->addClub($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'list_club.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'list_club.php';
            </script>";
        }
    }

    $btn = 'Add';
    $title = 'Add';
}

$view = new Template('templates/skintabel.html');

// View Data
$mainTitle = 'Team';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Name Club</th>
<th scope="row">Action</th>
</tr>';
$data = null;
$no = 1;

while ($div = $club->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['name_team'] . '</td>
    <td style="font-size: 22px;">
        <a href="list_club.php?id=' . $div['id_club'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="list_club.php?hapus=' . $div['id_club'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

//Update Data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit_data'])) {
            if (!empty($_POST['nama'])) {
                if ($club->updateClub($id, $_POST) > 0) {
                    echo "<script>
                    alert('Data berhasil diupdate!');
                    document.location.href = 'list_club.php';
                </script>";
                } else {
                    echo "<script>
                    alert('Data gagal diupdate!');
                    document.location.href = 'list_club.php';
                </script>";
                }
            } else {
                echo "<script>
                    alert('Data tidak boleh kosong!');
                    document.location.href = 'list_club.php';
                </script>";
            }
        }

        $club->getClubById($id);
        $row = $club->getResult();

        $dataUpdate2 = $row['name_team'];
        $btn = 'Update';
        $title = 'Edit';

        $view->replace('DATA_UPDATE', $dataUpdate2);
    }
}

// Delete Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($club->deleteClub($id) > 0) {
        echo "<script>
        if (confirm('Apakah Anda ingin menghapus data?')) {
            alert('Data berhasil dihapus!');
            document.location.href = 'list_club.php';
        } else {
            // Jika pengguna membatalkan penghapusan, arahkan kembali ke halaman sebelumnya
            history.back();
        }
    </script>";
    } else {
        echo "<script>
        alert('Data gagal dihapus!');
        document.location.href = 'list_club.php';
    </script>";
    }
}

$club->close();
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TABEL', $data);
$view->write();