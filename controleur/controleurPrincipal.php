<?php

$messageErreurConnexion = "";

if(isset($_POST["submitConnex"])){

	$unUtilisateur = new Utilisateur(null,$_POST["login"],$_POST["mdp"],null);
	$_SESSION['identification'] = UtilisateurDAO::verification($unUtilisateur);
	if(!$_SESSION['identification']){
		$messageErreurConnexion = "Login ou mot de passe incorrect";
	}
	else{
		$_SESSION['m2lMP']="accueil";
	}
}
else{
	if (!isset($_SESSION['identification'])){
		$_SESSION['identification'] = false;
	}
}



if(isset($_GET['m2lMP'])){
	$_SESSION['m2lMP']= $_GET['m2lMP'];
}
else
{
	if(!isset($_SESSION['m2lMP'])){
		$_SESSION['m2lMP']="accueil";
	}
}

//Tester la connexion 

$m2lMP = new Menu("m2lMP");

$m2lMP->ajouterComposant($m2lMP->creerItemLien("accueil", "Accueil"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("services", "Services"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("locaux", "Locaux"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("ligues", "Ligues"));



if (!isset($_SESSION['identification'])){
    $_SESSION['identification'] = false;
}
else if(isset($_SESSION['identification']['STATUT'])){
    if($_SESSION['identification']['STATUT'] == "Secrétaire"){
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("liguesGestion", "Gestion Ligues"));
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("clubsGestion", "Gestion Clubs"));
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Se déconnecter"));
    }
    else if($_SESSION['identification']['STATUT'] == "Responsable RH"){
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("contrat", "Mes Contrats"));
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("informationInter", "Informations Intervenant"));
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("information", "Mes informations"));
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Se déconnecter"));

    }
    else if($_SESSION['identification']['STATUT'] == "Responsable Formation"){
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("contrat", "Mes Contrats"));
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("information", "Mes informations"));
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Se déconnecter"));

    }
    else if($_SESSION['identification']['STATUT'] == "Salarié"){
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("contrat", "Mes Contrats"));
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("information", "Mes informations"));
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Se déconnecter"));

    }
    else if($_SESSION['identification']['STATUT'] == "Bénévole"){
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("information", "Mes informations"));
		$m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Se déconnecter"));

    }
    else{
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Se connecter"));
    }
}
else{
    $m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Se connecter"));
}

$menuPrincipalM2L = $m2lMP->creerMenu($_SESSION['m2lMP'], 'm2lMP');


include_once dispatcher::dispatch($_SESSION['m2lMP']);
