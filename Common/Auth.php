<?php

function isAuthenticated() {
    if ((isset($_SESSION['username'])) && ($_SESSION['username']!='')) {
		return true;
	} else{
		return false;
    }
}

function es_registrado() {
	return $_SESSION['rol'] === 'registrado';
}

function es_resp_edificio() {
	return $_SESSION['rol'] === 'edificio';
}

function es_resp_organizacion() {
	return $_SESSION['rol'] === 'organizacion';
}

function es_admin() {
	return $_SESSION['rol'] === 'administrador';
}

function getUser() {
	return $_SESSION['username'];
}

?> 