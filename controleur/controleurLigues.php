<?php


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

$formLigueConsult = new Formulaire("post", "index.php", "formLigueConsult", "LigueConsult" );

if($_SESSION['ligue'] !="0"){


 	$ligueActive = $_SESSION['listeLigue']->chercheLigue($_SESSION['ligue']);

    $formLigueConsult->ajouterComposantLigne($formLigueConsult->creerLabel($ligueActive->getNomLigue() , "titreLigue"),1);
	$formLigueConsult->ajouterComposantTab();

    $formLigueConsult->ajouterComposantLigne($formLigueConsult->creerImage($ligueActive->getNomLigue(),"imageLigue"),1);
	$formLigueConsult->ajouterComposantTab();

	$formLigueConsult->ajouterComposantLigne($formLigueConsult->creerLabel("Site :" , "site") , 1);
	$formLigueConsult->ajouterComposantLigne($formLigueConsult->creerInputTexte("site", "site", $ligueActive->getSite() , 0 , "", 1),1);
	$formLigueConsult->ajouterComposantTab();

	$formLigueConsult->ajouterComposantLigne($formLigueConsult->creerLabel("Descriptif :" , "descriptif") , 1);
	$formLigueConsult->ajouterComposantLigne($formLigueConsult->creerInputTexte("descriptif", "descriptif", $ligueActive->getDescriptif() , 0 , "", 1),1);
	//$formLigueConsult->ajouterComposantLigne($formLigueConsult->creerTextArea("descriptif", "descriptif", $ligueActive->getDescriptif() , 5, 33 ,0 , "", 1),1);
	$formLigueConsult->ajouterComposantTab();


}else{ 
	
	$formLigueConsult->ajouterComposantLigne($formLigueConsult->creerLabel("Veuillez sélectionner une ligue !", "titreLigue"),1);
	$formLigueConsult->ajouterComposantTab();


}


if($_SESSION['ligue'] !="0"){

	//Récupérer les clubs de la ligue

	$listeClubs = "";
	foreach($ligueActive->getLesClubs() as $club){

		$nomClub = $club->getNomClub();
		$adresseClub = $club->getAdresseClub();	

		$listeClubs .=  "<p> - ".$nomClub."          ADRESSE : ".$adresseClub . "</p><br>";
	}

}

	$formLigueConsult->creerFormulaire();


include_once 'vue/vueLigues.php' ;
