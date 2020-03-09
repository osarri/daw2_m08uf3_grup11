<?php
	
	if(isset ($_POST['ou']) && ($_POST['uid']) && ($_POST['nom']) && ($_POST['cognom']) && ($_POST['givenName']) && ($_POST['title']) && ($_POST['telephoneNumber']) && ($_POST['mobile']) && ($_POST['postalAddress']) && ($_POST['gidNumber']) && ($_POST['uidNumber']) && ($_POST['description']) && ($_POST['homeDirectory']) && ($_POST['loginShell'])){
		$ldaphost = "ldap://localhost";
		$ldappass = "fjeclot";
		$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 

		$ldapconn = ldap_connect($ldaphost) or die(header('Location: errorLogin.html'));

		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

		if ($ldapconn) {

			$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

			if($ldapbind) {
				
				$info["objectclass"][0] = 'top';
				$info["objectclass"][1] = 'person';
				$info["objectclass"][2] = 'organizationalPerson';
				$info["objectclass"][3] = 'inetOrgPerson';
				$info["objectclass"][4] = 'posixAccount';
				$info["objectclass"][5] = 'shadowAccount';
				$info["uid"] = trim($_POST['uid']);
				$info["cn"] = $_POST['nom']." ".$_POST['cognom'];
				$info["sn"] = trim($_POST['cognom']);
				$info["givenname"] = trim($_POST['givenName']);
				$info["title"] = trim($_POST['title']);
				$info["telephonenumber"] = trim($_POST['telephoneNumber']);
				$info["mobile"] = trim($_POST['mobile']);
				$info["postaladdress"] = trim($_POST['postalAddress']);
				$info["loginshell"] = trim($_POST['loginShell']);
				$info["gidnumber"] = trim($_POST['gidNumber']);
				$info["uidnumber"] = trim($_POST['uidNumber']);
				$info["homedirectory"] = trim($_POST['homeDirectory']);
				$info["description"] = trim($_POST['description']);


				$dn = "uid=".trim($_POST['uid']).", ou=".trim($_POST['ou']).", dc=fjeclot, dc=net";
				$add = ldap_add($ldapconn, $dn, $info);
				
					if($add) {
						header('Location: creadoBien.html');
					}
					
					else {
						header('Location: errorCrear.html'); 
					}
				ldap_close($ldapconn);
			} else {
				header('Location: errorCrear.html'); 	
			}
		}
	}else{
		header('Location: camposVacios.html');
	}
?>
