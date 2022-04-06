<?php

class Task extends DB
{

	// Get data.
	function getTask()
	{
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do";
		// Mengeksekusi query
		return $this->execute($query);
	}

	// Add Task
	function addTask()
	{
		$name = $_POST['tname'];
		$deadline = $_POST['tdeadline'];
		$detail = $_POST['tdetails'];
		$subject = $_POST['tsubject'];
		$priority = $_POST['tpriority'];
		$query = "INSERT INTO tb_to_do (name_td, details_td, subject_td,
					priority_td, deadline_td, status_td) VALUES ('$name',
					'$detail', '$subject', '$priority', '$deadline', 'Belum')";

		return $this->execute($query);
	}

	// Update task Status
	function updateTaskStatus($id)
	{
		$query = "UPDATE tb_to_do SET status_td = 'Sudah' WHERE id = '$id'";
		return $this->execute($query);
	}

	// Delete data
	function deleteTask($id)
	{
		$query = "DELETE FROM tb_to_do WHERE id = '$id'";
		return $this->execute($query);
	}
}