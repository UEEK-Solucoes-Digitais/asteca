<?php

function saveData($data)
{

	$pdo = array(
		'id'       => $data->id,
		'name'     => $data->name,
		'email'    => $data->email,
		'password' => $data->password,
	);

	saveAdmin($pdo);
}

function saveAdmin(array $data)
{

	control();
	$_SESSION['Admin'] = $data;
}

function control()
{

	if (!isset($_SESSION)) {

		session_start();
	}
}

function getAdmin($info)
{

	control();

	if (isset($_SESSION['Admin'][$info])) {
		return $_SESSION['Admin'][$info];
	}
}


function hasAdmin()
{

	control();

	if (isset($_SESSION['Admin'])) {
		return true;
	}

	return false;
}

function deleteAdmin()
{

	control();
	unset($_SESSION['Admin']);
}
