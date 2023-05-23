<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Club.php');
include('classes/Template.php');

$club = new Club($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$club->open();
$club->getClub();

$view = new Template('templates/skintabel.html');

$mainTitle = 'Team';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Logo</th>
<th scope="row">Name Club</th>
<th scope="row">Region</th>
<th scope="row">Location</th>
<th scope="row">Action</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'divisi';

while ($div = $club->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td><img src="assets/' . $div['logo_img'] . '" class="card-img-top" alt="' . $div['logo_img'] . '"></td>
    <td>' . $div['name_team'] . '</td>
    <td>' . $div['region_team'] . '</td>
    <td>' . $div['nation_team'] . '</td>
    <td style="font-size: 22px;">
        <a href="list_club.php?id=' . $div['id_club'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="list_club.php?hapus=' . $div['id_club'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

$club->close();
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();