<?php

if(isset($_POST["submitAjout"])){
	$_SESSION['ligue']= 0;
}


if(isset($_POST["submitEnreg"])){

	$uneLigue = new Ligue(0, $_POST["commune"], $_POST["nomLigue"], $_POST["site"], $_POST["descriptif"]);

	$reponseSGBD = LigueDAO::enregistrerLigue($uneLigue);
	
	if($reponseSGBD){
		$_SESSION['ligue'] = $reponseSGBD;
	}

}

if(isset($_POST["submitSuppr"])){

	LigueDAO::supprimerLigue($_SESSION['ligue'], $_POST["commune"]);
	$_SESSION['ligue'] = 0;

}


if(isset($_POST["submitModif"])){
	
	$reponseSGBD = LigueDAO::modifierLigue($_SESSION['ligue'], $_POST["commune"], $_POST["nomLigue"], $_POST["site"], $_POST["descriptif"]);

	if($reponseSGBD){
		$_SESSION['ligue'] = $reponseSGBD;
	}

}


/*****************************************************************************************************
 * Instancier un objet contenant la liste des Ligues et le conserver dans une variable de session
 *****************************************************************************************************/
$_SESSION['listeLigue'] = new Ligues(LigueDAO::lesLigues());


/*****************************************************************************************************
 * Conserver dans une variable de session l'item actif du menu ligue
 *****************************************************************************************************/
if(isset($_GET['ligue'])){
	$_SESSION['ligue']= $_GET['ligue'];
}
else
{
	if(!isset($_SESSION['ligue'])){
		$_SESSION['ligue']="0";
	}
}


/*****************************************************************************************************
 * Créer un menu vertical à partir de la liste des ligues
 *****************************************************************************************************/
$menuLigue = new Menu("menuLigue");


foreach ($_SESSION['listeLigue']->getLigues() as $uneLigue){
	$menuLigue->ajouterComposant($menuLigue->creerItemLien($uneLigue->getIdLigue(), $uneLigue->getNomLigue()));
}

$leMenuLigue = $menuLigue->creerMenu($_SESSION['ligue'],"ligue");


/*****************************************************************************************************
 * Récupérer la ligue sélectionnée
 *****************************************************************************************************/


if($_SESSION['ligue'] !="0"){

	if(isset($_POST["submitModif"])){

		$_SESSION['ligueActive'] = $_SESSION['listeLigue']->chercheLigue($_SESSION['ligue']);

		$formLigueModif = new Formulaire("post", "index.php", "formLigueModif", "LigueModif" );

		$formLigueModif->ajouterComposantLigne($formLigueModif->creerImage($_SESSION['ligueActive']->getNomLigue(),"imageLigue"),1);
		$formLigueModif->ajouterComposantTab();

		$formLigueModif->ajouterComposantLigne($formLigueModif ->creerLabel("Nom de la Ligue" , "inputNom"),1);
		$formLigueModif->ajouterComposantLigne($formLigueModif->creerInputTexte("nomLigue", "nomLigue", $_SESSION['ligueActive']->getNomLigue() , 0 , "", 0),1);
		$formLigueModif->ajouterComposantTab();

		$formLigueModif->ajouterComposantLigne($formLigueModif ->creerLabel("Commune du Siège" , "inputCommune"),1);
		$formLigueModif->ajouterComposantLigne($formLigueModif->creerInputTexte("commune", "commune", $_SESSION['ligueActive']->getIdCommune() , 0 , "", 1),1);
		$formLigueModif->ajouterComposantTab();

		$formLigueModif->ajouterComposantLigne($formLigueModif->creerLabel("Site :" , "inputSite") , 1);
		$formLigueModif->ajouterComposantLigne($formLigueModif->creerInputTexte("site", "site",$_SESSION['ligueActive']->getSite() , 0 , "", 0),1);
		$formLigueModif->ajouterComposantTab();

		$formLigueModif->ajouterComposantLigne($formLigueModif->creerLabel("Descriptif :" , "inputDescriptif") , 1);
		$formLigueModif->ajouterComposantLigne($formLigueModif->creerInputTexte("descriptif", "descriptif", $_SESSION['ligueActive']->getDescriptif() , 0 , "", 0),1);
		$formLigueModif->ajouterComposantTab();

		$formLigueModif->ajouterComposantLigne($formLigueModif-> creerInputSubmit('submitModif', 'submitModif', 'Valider'),1);
		$formLigueModif->ajouterComposantLigne($formLigueModif-> creerInputSubmit('submitAnnuler', 'submitAnnuler', 'Annuler'),2);
		$formLigueModif->ajouterComposantTab();	

		$formLigueModif->creerFormulaire();

	}else{

		$_SESSION['ligueActive'] = $_SESSION['listeLigue']->chercheLigue($_SESSION['ligue']);

		$formLigueModif = new Formulaire("post", "index.php", "formLigueModif", "LigueModif" );

		$formLigueModif->ajouterComposantLigne($formLigueModif->creerImage($_SESSION['ligueActive']->getNomLigue(),"imageLigue"),1);
		$formLigueModif->ajouterComposantTab();

		$formLigueModif->ajouterComposantLigne($formLigueModif ->creerLabel("Nom de la Ligue" , "inputNom"),1);
		$formLigueModif->ajouterComposantLigne($formLigueModif->creerInputTexte("nomLigue", "nomLigue", $_SESSION['ligueActive']->getNomLigue() , 0 , "", 1),1);
		$formLigueModif->ajouterComposantTab();

		$formLigueModif->ajouterComposantLigne($formLigueModif ->creerLabel("Commune du Siège" , "inputCommune"),1);
		$formLigueModif->ajouterComposantLigne($formLigueModif->creerInputTexte("commune", "commune", $_SESSION['ligueActive']->getIdCommune() , 0 , "", 1),1);
		$formLigueModif->ajouterComposantTab();

		$formLigueModif->ajouterComposantLigne($formLigueModif->creerLabel("Site :" , "inputSite") , 1);
		$formLigueModif->ajouterComposantLigne($formLigueModif->creerInputTexte("site", "site",$_SESSION['ligueActive']->getSite() , 0 , "", 1),1);
		$formLigueModif->ajouterComposantTab();

		$formLigueModif->ajouterComposantLigne($formLigueModif->creerLabel("Descriptif :" , "inputDescriptif") , 1);
		$formLigueModif->ajouterComposantLigne($formLigueModif->creerInputTexte("descriptif", "descriptif", $_SESSION['ligueActive']->getDescriptif() , 0 , "", 1),1);
		$formLigueModif->ajouterComposantTab();

		$formLigueModif->ajouterComposantLigne($formLigueModif-> creerInputSubmit('submitSuppr', 'submitSuppr', 'Supprimer'),1);
		$formLigueModif->ajouterComposantLigne($formLigueModif-> creerInputSubmit('submitModif', 'submitModif', 'Modifier'),2);
		$formLigueModif->ajouterComposantLigne($formLigueModif-> creerInputSubmit('submitAjout', 'submitAjout', 'Ajouter'),3);
		$formLigueModif->ajouterComposantTab();

		$formLigueModif->creerFormulaire();		
	}
}else{

	if(isset($_POST["submitAjout"])){

		$formLigueModif = new Formulaire("post", "index.php", "formLigueModif", "LigueModif" );

		$formLigueModif->ajouterComposantLigne($formLigueModif ->creerLabel("Nom de la Ligue" , "inputNom"),1);
		$formLigueModif->ajouterComposantLigne($formLigueModif->creerInputTexte("nomLigue", "nomLigue", "" , 0 , "", 0),1);
		$formLigueModif->ajouterComposantTab();

		$formLigueModif->ajouterComposantLigne($formLigueModif ->creerLabel("Commune du Siège" , "inputCommune"),1);
		$formLigueModif->ajouterComposantLigne($formLigueModif->creerInputTexte("commune", "commune", "" , 0 , "", 0),1);
		$formLigueModif->ajouterComposantTab();


		$formLigueModif->ajouterComposantLigne($formLigueModif->creerLabel("Site :" , "inputSite") , 1);
		$formLigueModif->ajouterComposantLigne($formLigueModif->creerInputTexte("site", "site", "", 0 , "", 0),1);
		$formLigueModif->ajouterComposantTab();

		$formLigueModif->ajouterComposantLigne($formLigueModif->creerLabel("Descriptif :" , "inputDescriptif") , 1);
		$formLigueModif->ajouterComposantLigne($formLigueModif->creerInputTexte("descriptif", "descriptif", "" , 0 , "", 0),1);
		$formLigueModif->ajouterComposantTab();		

		$formLigueModif->ajouterComposantLigne($formLigueModif-> creerInputSubmit('submitEnreg', 'submitEnreg', 'Enregister'),1);
		$formLigueModif->ajouterComposantLigne($formLigueModif-> creerInputSubmit('submitAnnuler', 'submitAnnuler', 'Annuler'),2);
		$formLigueModif->ajouterComposantTab();

		$formLigueModif->creerFormulaire();	

	}else{

		$formLigueModif = new Formulaire("post", "index.php", "formLigueModif", "LigueModif" );		
		$formLigueModif->ajouterComposantLigne($formLigueModif->creerLabel("Veuillez sélectionner une ligue !", "titreLigue"),1);
		$formLigueModif->ajouterComposantTab();

		$formLigueModif->creerFormulaire();	

	}

}

include_once 'vue/vueLiguesGest.php' ;
