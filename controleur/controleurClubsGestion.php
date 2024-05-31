<?php

if(isset($_POST["submitAjout"])){
	$_SESSION['club']= 0;
}


if(isset($_POST["submitEnreg"])){

	$unClub = new Club(0, $_POST["ligue"], $_POST["commune"], $_POST["nomClub"], $_POST["adresse"]);

	$reponseSGBD = ClubDAO::enregistrerClub($unClub);
	
	if($reponseSGBD){
		$_SESSION['club'] = $reponseSGBD;
	}

}

if(isset($_POST["submitSuppr"])){

	ClubDAO::supprimerClub($_SESSION['club'], $_POST["ligue"], $_POST["commune"]);
	$_SESSION['club'] = 0;

}


//echo $_SESSION['club']. ' ' .$_POST["ligue"];

if(isset($_POST["submitModif"])){
	
	$reponseSGBD = ClubDAO::modifierClub($_SESSION['club'], $_POST["ligue"], $_POST["commune"], $_POST["nomClub"], $_POST["adresse"]);

	if($reponseSGBD){
		$_SESSION['club'] = $reponseSGBD;
	}

}


/*****************************************************************************************************
 * Instancier un objet contenant la liste des clubs et le conserver dans une variable de session
 *****************************************************************************************************/
$_SESSION['listeClub'] = new Clubs(ClubDAO::AfficherClub());

/*****************************************************************************************************
 * Conserver dans une variable de session l'item actif du menu ligue
 *****************************************************************************************************/
if(isset($_GET['club'])){
	$_SESSION['club']= $_GET['club'];
}
else
{
	if(!isset($_SESSION['club'])){
		$_SESSION['club']="0";
	}
}

/*****************************************************************************************************
 * Créer un menu vertical à partir de la liste des clubs
 *****************************************************************************************************/
$menuClub = new Menu("menuClub");

foreach ($_SESSION['listeClub']->getClubs() as $unClub){
	$menuClub->ajouterComposant($menuClub->creerItemLien($unClub->getIdClub(), $unClub->getNomClub()));
}

$leMenuClub = $menuClub->creerMenu($_SESSION['club'],"club");


/*****************************************************************************************************
 * Récupérer la club sélectionnée
 *****************************************************************************************************/

if($_SESSION['club'] !="0"){

	if(isset($_POST["submitModif"])){

		$_SESSION['clubActif'] = $_SESSION['listeClub']->chercheClub($_SESSION['club']);

		$formClubModif = new Formulaire("post", "index.php", "formClubModif", "ClubModif" );

		$formClubModif->ajouterComposantLigne($formClubModif->creerImage($_SESSION['clubActif']->getNomClub(),"imageClub"),1);
		$formClubModif->ajouterComposantTab();

		$formClubModif->ajouterComposantLigne($formClubModif ->creerLabel("Nom du club" , "inputNom"),1);
		$formClubModif->ajouterComposantLigne($formClubModif->creerInputTexte("nomClub", "nomClub", $_SESSION['clubActif']->getNomClub() , 0 , "", 0),1);
		$formClubModif->ajouterComposantTab();

		$formClubModif->ajouterComposantLigne($formClubModif ->creerLabel("Ligue" , "inputLigue"),1);
		$formClubModif->ajouterComposantLigne($formClubModif->creerInputTexte("ligue", "ligue", $_SESSION['clubActif']->getIdLigue() , 0 , "", 1),1);
		$formClubModif->ajouterComposantTab();

		$formClubModif->ajouterComposantLigne($formClubModif->creerLabel("Commune :" , "inputCommune") , 1);
		$formClubModif->ajouterComposantLigne($formClubModif->creerInputTexte("commune", "commune",$_SESSION['clubActif']->getIdCommune() , 0 , "", 1),1);
		$formClubModif->ajouterComposantTab();

		$formClubModif->ajouterComposantLigne($formClubModif->creerLabel("Adresse du Club :" , "inputAdresse") , 1);
		$formClubModif->ajouterComposantLigne($formClubModif->creerInputTexte("adresse", "adresse", $_SESSION['clubActif']->getAdresseClub() , 0 , "", 0),1);
		$formClubModif->ajouterComposantTab();

		$formClubModif->ajouterComposantLigne($formClubModif-> creerInputSubmit('submitModif', 'submitModif', 'Valider'),1);
		$formClubModif->ajouterComposantLigne($formClubModif-> creerInputSubmit('submitAnnuler', 'submitAnnuler', 'Annuler'),2);
		$formClubModif->ajouterComposantTab();	

		$formClubModif->creerFormulaire();

	}else{

		$_SESSION['clubActif'] = $_SESSION['listeClub']->chercheClub($_SESSION['club']);

		$formClubModif = new Formulaire("post", "index.php", "formClubModif", "ClubModif" );

		$formClubModif->ajouterComposantLigne($formClubModif->creerImage($_SESSION['clubActif']->getNomClub(),"imageClub"),1);
		$formClubModif->ajouterComposantTab();

		$formClubModif->ajouterComposantLigne($formClubModif ->creerLabel("Nom du club" , "inputNom"),1);
		$formClubModif->ajouterComposantLigne($formClubModif->creerInputTexte("nomClub", "nomClub", $_SESSION['clubActif']->getNomClub() , 0 , "", 1),1);
		$formClubModif->ajouterComposantTab();

		$formClubModif->ajouterComposantLigne($formClubModif ->creerLabel("Ligue " , "inputLigue"),1);
		$formClubModif->ajouterComposantLigne($formClubModif->creerInputTexte("ligue", "ligue", $_SESSION['clubActif']->getIdLigue() , 0 , "", 1),1);
		$formClubModif->ajouterComposantTab();

		$formClubModif->ajouterComposantLigne($formClubModif->creerLabel("Commune :" , "inputCommune") , 1);
		$formClubModif->ajouterComposantLigne($formClubModif->creerInputTexte("commune", "commune",$_SESSION['clubActif']->getIdCommune() , 0 , "", 1),1);
		$formClubModif->ajouterComposantTab();

		$formClubModif->ajouterComposantLigne($formClubModif->creerLabel("Adresse du Club :" , "inputAdresse") , 1);
		$formClubModif->ajouterComposantLigne($formClubModif->creerInputTexte("adresse", "adresse", $_SESSION['clubActif']->getAdresseClub() , 0 , "", 1),1);
		$formClubModif->ajouterComposantTab();

		$formClubModif->ajouterComposantLigne($formClubModif-> creerInputSubmit('submitSuppr', 'submitSuppr', 'Supprimer'),1);
		$formClubModif->ajouterComposantLigne($formClubModif-> creerInputSubmit('submitModif', 'submitModif', 'Modifier'),2);
		$formClubModif->ajouterComposantLigne($formClubModif-> creerInputSubmit('submitAjout', 'submitAjout', 'Ajouter'),3);
		$formClubModif->ajouterComposantTab();

		$formClubModif->creerFormulaire();		
	}
}else{

	if(isset($_POST["submitAjout"])){

		$_SESSION['clubActif'] = $_SESSION['listeClub']->chercheClub($_SESSION['club']);

		$formClubModif = new Formulaire("post", "index.php", "formClubModif", "ClubModif" );

		$formClubModif->ajouterComposantLigne($formClubModif->creerLabel("Nom du club" , "inputNom"),1);
		$formClubModif->ajouterComposantLigne($formClubModif->creerInputTexte("nomClub", "nomClub", "", 0 , "", 0),1);
		$formClubModif->ajouterComposantTab();

		$formClubModif->ajouterComposantLigne($formClubModif ->creerLabel("Ligue " , "inputLigue"),1);
		$formClubModif->ajouterComposantLigne($formClubModif->creerInputTexte("ligue", "ligue", "" , 0 , "", 0),1);
		$formClubModif->ajouterComposantTab();

		$formClubModif->ajouterComposantLigne($formClubModif->creerLabel("Commune :" , "inputCommune") , 1);
		$formClubModif->ajouterComposantLigne($formClubModif->creerInputTexte("commune", "commune","", 0 , "", 0),1);
		$formClubModif->ajouterComposantTab();

		$formClubModif->ajouterComposantLigne($formClubModif->creerLabel("Adresse du Club :" , "inputAdresse") , 1);
		$formClubModif->ajouterComposantLigne($formClubModif->creerInputTexte("adresse", "adresse", "" , 0 , "", 0),1);
		$formClubModif->ajouterComposantTab();

		$formClubModif->ajouterComposantLigne($formClubModif-> creerInputSubmit('submitEnreg', 'submitEnreg', 'Enregister'),1);
		$formClubModif->ajouterComposantLigne($formClubModif-> creerInputSubmit('submitAnnuler', 'submitAnnuler', 'Annuler'),2);
		$formClubModif->ajouterComposantTab();

		$formClubModif->creerFormulaire();	

	}else{

		$formClubModif = new Formulaire("post", "index.php", "formClubModif", "ClubModif" );		
		$formClubModif->ajouterComposantLigne($formClubModif->creerLabel("Veuillez sélectionner un club !", "titreClub"),1);
		$formClubModif->ajouterComposantTab();

		$formClubModif->creerFormulaire();	

	}

}

include_once 'vue/vueClubsGest.php' ;
