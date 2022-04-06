<?php

// Include file.
include("conf.php");
include("DB.php");
include("Task.php");
include("Template.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// "ADD" Action
if (isset($_POST['add'])) {
	$otask->addTask();
}

// "SELESAI" Action
if (isset($_GET['id_status'])) {
	$otask->updateTaskStatus($_GET["id_status"]);
}
// "HAPUS" Action
if (isset($_GET['id_hapus'])) {
	$otask->deleteTask($_GET['id_hapus']);
}

// Tampilkan data Task
$otask->getTask();

// Fill in table with data.
$data = null;
$no = 1;

while (list($id, $tname, $tdetails, $tsubject, $tpriority, $tdeadline, $tstatus) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if ($tstatus == "Sudah") {
		$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $tname . "</td>
			<td>" . $tdetails . "</td>
			<td>" . $tsubject . "</td>
			<td>" . $tpriority . "</td>
			<td>" . $tdeadline . "</td>
			<td>" . $tstatus . "</td>
			<td>
			<button name='delete' class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
			</td>
			</tr>";
		$no++;
	}
	// Tampilan jika status task nya belum dikerjakan
	else {
		$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $tname . "</td>
			<td>" . $tdetails . "</td>
			<td>" . $tsubject . "</td>
			<td>" . $tpriority . "</td>
			<td>" . $tdeadline . "</td>
			<td>" . $tstatus . "</td>
			<td>
			<button name='delete' class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
			<button name='done' class='btn btn-success' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
			</td>
			</tr>";
		$no++;
	}
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");
// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);
// Menampilkan ke layar
$tpl->write();