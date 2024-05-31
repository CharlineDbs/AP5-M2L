<?php


/*****************************************************************************************************
 * Instancier un objet contenant la liste des Clubs et le conserver dans une variable de session
 *****************************************************************************************************/
$_SESSION['listeClub'] = new Clubs(ClubDAO::lesClubs(Ligue $ligue));


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
 * Créer un menu vertical à partir de la liste des clubs
 *****************************************************************************************************/
$menuClub = new Menu("menuClub");


foreach ($_SESSION['listeClub']->getClub() as $unClub){
	$menuClub->ajouterComposant($menuClub->creerItemLien($unClub->getIdClub(), $unClub->getNomClub()));
}

$leMenuClub = $menuClub->creerMenu($_SESSION['club'],"club");




/*****************************************************************************************************
 * Récupérer le club sélectionnée
 *****************************************************************************************************/

$formClubConsult = new Formulaire("post", "index.php", "formClubConsult", "ClubConsult");

if($_SESSION['club'] !="0"){


 	$clubActif = $_SESSION['listeClub']->chercheClub($_SESSION['club']);
   

    $formClubConsult ->ajouterComposantLigne($formClubConsult ->creerLabel($clubActif->getNomClub() , "titreClub"),1);
	$formClubConsult ->ajouterComposantTab();

	$formClubConsult->ajouterComposantLigne($formClubConsult->creerLabel("Adresse :" , "inputTexte") , 1);
	$formClubConsult->ajouterComposantLigne($formClubConsult->creerInputTexte("adresse", "adresse", $clubActif->getAdresseClub() , 0 , "", 1),1);
	$formClubConsult->ajouterComposantTab();

}

$formClubConsult->creerFormulaire();


include_once 'vue/vueLigues.php' ;
