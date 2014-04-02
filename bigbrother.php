<?php
//Condition pour de connexion
if ($argc != 3) 
	exit;
//Connexion Mongodb
$mongo = new Mongo();
// Cree/Select BDD
$db = $mongo->selectDB('bigbrother');

date_default_timezone_set("Europe/Paris");
$login = $argv[2];

//Appel des fonctions
if ($argv[1] == 'add_student')
	$db->school->$login->insert(add_student($login));
else if ($argv[1] == 'del_student')
	del_student($db, $login);
else if ($argv[1] == 'show_student')
	show_student($db, $login);
else if ($argv[1] == 'add_comment')
	$db->school->$login->comments->insert(add_comment($add_comment));
else if (argv[1] == 'update_student')
	$db->school->$login->insert(update_student($login))

//Gestions des étudiants
function add_student($login)
{
	if ($db->school->$login->count() != 0)
	{
		echo "Cet étudiant est déjà enregistré.\n";
		return;
	}
	$question = array(
		'name' => "nom ?",
		'promo' => "promo ?",
		'email' => "email ?",
		'phone' => "téléphone ?", 
		);

	foreach ($question as $key => $value) 
	{
		echo  $value."\n";
		if (($line = readline(">")) != false)
		{
			$student[$key] = $line;
		}
	}
	echo "utilisateur enregistré\n";
	return($student);
}

function del_student($db, $login)
{
	if ($db->$school->$login->count() == 0) 
	{
		echo "Cet étudiant n'est pas enregistré\n";
		return;
	}
	echo "Etes-vous sur ?\n";
	$answer = readline();
	if ($answer == "oui")
	{
		$db->school->$login->remove();
		$db->school->$login->comments->remove();
		echo "utilisateur supprimé !\n";
	}
	else if ($answer == "non")
		echo "utilisateur non supprimé !\n";
	else
		echo "Votre réponse doit être oui ou non.\n";
}

function show_student($db, $login)
{
	$show = $db->school->$login->find();
	foreach ($show as $infos) {
		echo "login 		: ".$login."\n";
		echo "nom 		: ".$infos ['name']."\n";
		echo "promo 		: ".$infos ['promo']."\n";
		echo "email 		: ".$infos ['email']."\n";
		echo "téléphone	: ".$infos ['phone']."\n";
		echo "commentaire 	: "."\n";
	}
}

function add_comment($add_comment)
{
	$date = date("d F Y");
	echo "commentaire : "."\n";
	$comment = readline();
	$add_comment = array(
		'comment' => $date ." . ".$comment
		);
	echo "Commentaire ajouté.\n";
}

function show_comment()
{
	$date = date("d F Y");
	echo $date;
	echo $comment;
}

function update_student($db, $login)
{
	if ($db->school->$login->count() == 0)
	{
		echo "Cet étudiant n'est pas enregistré\n";
		return;
	}
	$update = $db->school->$login->findOne();
	$questionbis = $arrayName = array(
		'name' => "Modification du nom ?", 
		'promo' => "Modification de l'année de promo ?",
		'email' => "Modification de l'email ?",
		'phone' => "Modification du téléphone ?"
		);
	foreach ($questionbis as $keybis => $valuebis) 
	{
		echo  $valuebis."\n";
		if (($linebis = readline(">")) != false)
		{
			$studentbis[$keybis] = $linebis;
		}
	}
	echo "utilisateur modifié\n";
	return($studentbis);
}
