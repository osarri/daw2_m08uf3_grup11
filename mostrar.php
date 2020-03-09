<?php
if(isset ($_POST['uid']) && ($_POST['ou'])){
	$ldaphost = "ldap://localhost";
	$ldappass = "fjeclot";
	$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 


	$ldapconn = ldap_connect($ldaphost) or die(header('Location: errorMostrar.html'));

	ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

	if ($ldapconn) {

	$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

	if($ldapbind) {
		
		$search = ldap_search($ldapconn, "dc=fjeclot, dc=net","uid=".trim($_POST['uid']));
		
		if($search) {
			$info = ldap_get_entries($ldapconn, $search);
			
			if($info['count']==0){
			
			header('Location: errorMostrar.html'); 
		}else{
			for ($i=0; $i<$info["count"]; $i++)
			{
				echo "uid: ".$info[$i]["uid"][0]. "<br>";
				echo "ou: ".trim($_POST['ou'])."<br>";
				echo "cn: ".$info[$i]["cn"][0]. "<br>";
				echo "sn: ".$info[$i]["sn"][0]. "<br>";
				echo "Given Name: ".$info[$i]["givenname"][0]. "<br>";
				echo "Title: ".$info[$i]["title"][0]. "<br>";
				echo "Telephone Number: ".$info[$i]["telephonenumber"][0]. "<br>";
				echo "Mobile: ".$info[$i]["mobile"][0]. "<br>";
				echo "Postal Address: ".$info[$i]["postaladdress"][0]. "<br>";
				echo "Login Shell: ".$info[$i]["loginshell"][0]. "<br>";
				echo "Home Directory: ".$info[$i]["homedirectory"][0]. "<br>";
				echo "Description: ".$info[$i]["description"][0]. "<br>";
				//echo "Creators Name: ".$info[$i]["creatorsName"][0]. "<br>";
				//echo "Create Timestamp: ".$info[$i]["createTimestamp"][0]. "<br>";
				echo "gid number: ".$info[$i]["gidnumber"][0]. "<br>";
				echo "uid number: ".$info[$i]["uidnumber"][0]. "<br>";
				//echo "Modifiers Name: ".$info[$i]["modifiersName"][0]. "<br>";
				//echo "Modify Timestamp: ".$info[$i]["modifyTimestamp"][0]. "<br>";

			} 
		}
		
		}	
	
	} else {
		header('Location: errorMostrar.html'); 	
	}

	}

}else{
	header('Location: camposVacios.html'); 	
}
?>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>MOSTRANDO</title>
    <link rel="stylesheet" href="css.css">
    <link href="https://fonts.googleapis.com/css?family=Trade+Winds&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="p-3 mb-2 fondoCorrecto" style="color: white;">
    <a href="./opciones.html" class="btn btn-success">VOLVER</a>
</body>
</html>