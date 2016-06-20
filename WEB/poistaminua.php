<?php

error_reporting(E_ALL ^ ( E_NOTICE | E_WARNING | E_DEPRECATED | E_STRICT));

$mysql['database'] =		"miinus";
$mysql['server'] =		"localhost";
$mysql['username'] =		"root";
$mysql['password'] =		"";
//

	//$con = new mysqli($mysql['server'], $mysql['username'], $mysql['password'], $mysql['database']);
	$con = mysql_connect($mysql['server'], $mysql['username'], $mysql['password']);

	if (!$con)
		{
		die('Could not connect: ' . mysql_error());
		}

	$dbname = $mysql['database'];
	mysql_select_db($dbname, $con);



//WHERE tuote_id < 200

$sql = mysql_query("
	SELECT suola,id FROM viivakoodi
	WHERE id < 3706	
") or die (mysql_error());


	while($row = mysql_fetch_array($sql))
	{

		echo ((float)$row['suola']/1000).'<br>';
		$val = 0;
		$val = ((float)$row['suola']/1000);
		mysql_query("update viivakoodi SET suola='".$val."' WHERE id='".$row['id']."' ");
	}


/*
error_reporting(E_ALL ^ ( E_NOTICE | E_WARNING | E_DEPRECATED | E_STRICT));

$mysql['database'] =		"miinus";
$mysql['server'] =		"localhost";
$mysql['username'] =		"root";
$mysql['password'] =		"";
//

	//$con = new mysqli($mysql['server'], $mysql['username'], $mysql['password'], $mysql['database']);
	$con = mysql_connect($mysql['server'], $mysql['username'], $mysql['password']);

	if (!$con)
		{
		die('Could not connect: ' . mysql_error());
		}

	$dbname = $mysql['database'];
	mysql_select_db($dbname, $con);



//WHERE tuote_id < 200

$sql = mysql_query("
		SELECT * FROM temp_tuote 
") or die (mysql_error());


	while($row = mysql_fetch_array($sql))
	{



	$nimike = array();
	$annoskoko = array();

		echo '<b>'.$row['tuote'].'</b><br>';



		$sql2 = mysql_query("
			SELECT * FROM temp_component
			WHERE tuote_id='".$row['tuote_id']."'
		") or die (mysql_error());
		while($row2 = mysql_fetch_array($sql2))
		{
		   $nimike[$row2['nimike']] = $row2['arvo'];
		}

		$sql3 = mysql_query("
			SELECT * FROM temp_annoskoko
			WHERE tuote_id='".$row['tuote_id']."'
		") or die (mysql_error());
		while($row3 = mysql_fetch_array($sql3))
		{
		   $annoskoko[$row3['annoskoko']] = $row3['massa'];
		}

	echo '--------------------------<br>';


//echo '<pre>';
//print_r($annoskoko);
//echo '</pre>';

$tuoteen_tyyppi = 'Juoma//Ruoanvalmistus ja leivonta//Valmisruoka';

	mysql_query("
	INSERT INTO 
	viivakoodi (

		annoskoko,
		ravinto_sis,
		status,
		tuoteen_tyyppi,
		tuote_nimi,
		energia_kj,
		energia_kcal,
		proteiini,
		hiilihydraatti,
		rasva,
		alkoholi,
		kuitu,
		sokerit,
		tyydyttyneet_rasvat,
		yksityistyydyttymattomat_rasvat,
		monityydyttymattomat_rasvat,
		transrasvahapot,
		suola,
		natrium,
		kalsium,
		magnesium,
		rauta,
		sinkki,
		c_vitamiini,
		d_vitamiini,
		rv_desilitra,
		rv_ruokalusikka,
		rv_teelusikka,
		rv_kilogramma,
		rv_pieni_kpl,
		rv_keskikokoinen_kpl,
		rv_iso_kpl,
		rv_valmistaja_kpl	,
		rv_pieni_annos,
		rv_keskikokoinen_annos,
		rv_iso_annos,
		rv_elintarviketaulukossa_oleva_annos,
		rv_kappaletta_annosta
	)

	VALUES(	

		'100',
		'1',
		'1',
		'".$tuoteen_tyyppi."',
		'".$row['tuote']."',
		'".str_replace(",",".",$nimike['ENERC'])."',
		'".(str_replace(",",".",$nimike['ENERC'])/4.1868)."',
		'".str_replace(",",".",$nimike['PROT'])."',
		'".str_replace(",",".",$nimike['CHOAVL'])."',
		'".str_replace(",",".",$nimike['FAT'])."',
		'".str_replace(",",".",$nimike['ALC'])."',
		'".str_replace(",",".",$nimike['FIBC'])."',
		'".str_replace(",",".",$nimike['SUGAR'])."',
		'".str_replace(",",".",$nimike['FASAT'])."',
		'".str_replace(",",".",$nimike['FAMCIS'])."',
		'".str_replace(",",".",$nimike['FAPU'])."',
		'".str_replace(",",".",$nimike['FATRN'])."',
		'".str_replace(",",".",$nimike['NACL'])."',
		'".str_replace(",",".",$nimike['NA'])."',
		'".str_replace(",",".",$nimike['CA'])."',
		'".str_replace(",",".",$nimike['MG'])."',
		'".str_replace(",",".",$nimike['FE'])."',
		'".str_replace(",",".",$nimike['ZN'])."',
		'".str_replace(",",".",$nimike['VITC'])."',
		'".str_replace(",",".",$nimike['VITD'])."',
		'".str_replace(",",".",$annoskoko['DL'])."',
		'".str_replace(",",".",$annoskoko['RKL'])."',
		'".str_replace(",",".",$annoskoko['TL'])."',
		'".str_replace(",",".",$annoskoko['KG'])."',
		'".str_replace(",",".",$annoskoko['KPL_S'])."',
		'".str_replace(",",".",$annoskoko['KPL_M'])."',
		'".str_replace(",",".",$annoskoko['KPL_L'])."',
		'".str_replace(",",".",$annoskoko['KPL_VALM'])."',
		'".str_replace(",",".",$annoskoko['PORTS'])."',
		'".str_replace(",",".",$annoskoko['PORTM'])."',
		'".str_replace(",",".",$annoskoko['PORTL'])."',
		'".str_replace(",",".",$annoskoko['PORTTBL'])."',
		'".str_replace(",",".",$annoskoko['SPLPORT'])."'

	)
	");


	//exit; // haluan yhden



	}

*/
?>











