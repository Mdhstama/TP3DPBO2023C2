<?php

include('config/db.php');
include('classes/DB.php');
include('classes/role.php');
include('classes/Template.php');

$role = new role($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$role->open();
$role->getrole();

// if (!isset($_GET['id'])) {
//     if (isset($_POST['submit'])) {
//         if ($divisi->addDivisi($_POST) > 0) {
//             echo "<script>
//                 alert('Data berhasil ditambah!');
//                 document.location.href = 'list_role.php';
//             </script>";
//         } else {
//             echo "<script>
//                 alert('Data gagal ditambah!');
//                 document.location.href = 'list_role.php';
//             </script>";
//         }
//     }

//     $btn = 'Tambah';
//     $title = 'Tambah';
// }

$view = new Template('templates/skintabel.html');

$mainTitle = 'Role';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Type Role</th>
<th scope="row">Name Role</th>
<th scope="row">Action</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'divisi';

while ($div = $role->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['type_role'] . '</td>
    <td>' . $div['name_role'] . '</td>
    <td style="font-size: 22px;">
        <a href="list_role.php?id=' . $div['id_role'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="list_role.php?hapus=' . $div['id_role'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}


// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
//     if ($id > 0) {
//         if (isset($_POST['submit'])) {
//             if ($role->updaterole($id, $_POST) > 0) {
//                 echo "<script>
//                 alert('Data berhasil diubah!');
//                 document.location.href = 'divisi.php';
//             </script>";
//             } else {
//                 echo "<script>
//                 alert('Data gagal diubah!');
//                 document.location.href = 'divisi.php';
//             </script>";
//             }
//         }

//         $divisi->getDivisiById($id);
//         $row = $divisi->getResult();

//         $dataUpdate = $row['divisi_nama'];
//         $btn = 'Simpan';
//         $title = 'Ubah';

//         $view->replace('DATA_VAL_UPDATE', $dataUpdate);
//     }
// }

// if (isset($_GET['hapus'])) {
//     $id = $_GET['hapus'];
//     if ($id > 0) {
//         if ($divisi->deleteDivisi($id) > 0) {
//             echo "<script>
//                 alert('Data berhasil dihapus!');
//                 document.location.href = 'divisi.php';
//             </script>";
//         } else {
//             echo "<script>
//                 alert('Data gagal dihapus!');
//                 document.location.href = 'divisi.php';
//             </script>";
//         }
//     }
// }

$role->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
// $view->replace('DATA_TITLE', $title);
// $view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();