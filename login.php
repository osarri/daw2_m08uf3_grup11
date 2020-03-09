<?php
session_start(); 
if(isset($_POST['password']) && ($_POST['user'])){

	$ldaphost = "ldap://localhost";
	$ldappass = trim($_POST['password']);
	$ldapadmin= "cn=".trim($_POST['user']).",dc=fjeclot,dc=net"; 

	$ldapconn = ldap_connect($ldaphost) or die(header('Location: errorLogin.php'));

	ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

	if ($ldapconn) {

		// realizando la autenticación
		
		$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

		// verificación del enlace
		if ($ldapbind) {
			echo header('Location: opciones.html');
		} else {
			header('Location: errorLogin.html'); 
		}

	}
}else{
	header('Location: errorLogin.html');
}
?>