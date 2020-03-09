<?php

if(isset($_POST['uid']) && ($_POST['gidNumber']) && ($_POST['uidNumber'])){
	echo("apd_dump_persistent_resources()");
	$ldaphost = "ldap://localhost";
	$ldappass = "fjeclot";
	$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 


	$ldapconn = ldap_connect($ldaphost) or die(header('Location: camposVacios.html'));

	ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
		
	echo $ldapconn;

	if ($ldapconn) {

	$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

	if($ldapbind) {
		

		$user=trim($_POST['uid']);
		$ou=trim($_POST['ou']);
		$gid=trim($_POST['gidNumber']);
		$uid=trim($_POST['uidNumber']);
		
		if($uid != NULL && $gid != NULL  ){

		$info["gidnumber"] = $gid;
		$info["uidnumber"] = $uid;
		
		$dn = "uid=".$user. ",ou=".$ou.",dc=fjeclot,dc=net";

		$modify = ldap_modify($ldapconn, "$dn", $info);

		echo $modify;
	}

	if($modify) {
		header('Location: modificadoBien.html'); 	
	}else {
		header('Location: errorModificar.html'); 	
	}
		ldap_close($ldapconn);
	} else {
		header('Location: errorModificar.html'); 	
	}

}

}else{
	
	header('Location: camposVacios.html'); 	
}
?>