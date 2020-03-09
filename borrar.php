<?php
	if(isset ($_POST['uid']) && ($_POST['ou'])){
		$ldaphost = "ldap://localhost";
		$ldappass = "fjeclot";
		$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 


		$ldapconn = ldap_connect($ldaphost) or die(header('Location: errorBorrar.php'));

		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

		if ($ldapconn) {

		$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

		if($ldapbind) {
			
			$delete = ldap_delete($ldapconn, "uid=".trim($_POST['uid']).",ou=".trim($_POST['ou']).",dc=fjeclot, dc=net");
			
				if($delete) {
					header('Location: borradoBien.html');
				}
				
				else {
					header('Location: errorBorrar.html'); 
					}
			ldap_close($ldapconn);
		} else {
			header('Location: errorBorrar.html'); 	
		}

		}

	}else{
		header('Location: camposVacios.html');
	}
?>


