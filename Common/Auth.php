<?php

function isAuthenticated() {
    if ((isset($_SESSION['username'])) && ($_SESSION['username']!='')) {
		return true;
	} else{
		return false;
    }
}

?> 