<?php


$_SESSION["mesContrats"] = new Contrats(UtilisateurDAO::mesContrats($_SESSION['identification']["IDUSER"]));


if(isset($_GET['contrat'])){
	$_SESSION['idContrat']= $_GET['contrat'];
}
else
{
	if(!isset($_SESSION['idContrat'])){
		$_SESSION['idContrat']="0";
	}
}


$menuContrat = new Menu("menuContrat");

foreach ($_SESSION['mesContrats']->getContrats() as $unContrat){
	$menuContrat->ajouterComposant($menuContrat->creerItemLien($unContrat->getIdContrat() , "contrat n° " .$unContrat->getIdContrat() . " - date début : ".$unContrat->getDateDebut() ));
}

$leMenuContrat = $menuContrat->creerMenu($_SESSION['idContrat'], "contrat");



if(	$_SESSION['idContrat']!="0"){


	
	$_SESSION["contratActif"] = $_SESSION['mesContrats']->chercheContrat($_SESSION['idContrat']);



	$formContratConsult =  new Formulaire("post", "index.php", "formContratConsult","formContratConsult");


	$formContratConsult->ajouterComposantLigne($formContratConsult->creerLabel("Numéro Contrat: ", "inputTexte") , 1 );
	$formContratConsult->ajouterComposantLigne($formContratConsult->creerInputTexte("numeroContrat", "numeroContrat", $_SESSION["contratActif"]->getIdContrat(), 0, "" , 1),1);
	$formContratConsult->ajouterComposantTab();

	$formContratConsult->ajouterComposantLigne($formContratConsult->creerLabel("Identifiant : ", "inputTexte") , 1 );
	$formContratConsult->ajouterComposantLigne($formContratConsult->creerInputTexte("idUser", "idUser", $_SESSION["contratActif"]->getIdUser(), 0, "" , 1),1);
	$formContratConsult->ajouterComposantTab();

	$formContratConsult->ajouterComposantLigne($formContratConsult->creerLabel("Date de début : ", "inputTexte") , 1 );
	$formContratConsult->ajouterComposantLigne($formContratConsult->creerInputTexte("dateDebut", "dateDebut", $_SESSION["contratActif"]->getDateDebut(), 0, "" , 1),1);
	$formContratConsult->ajouterComposantTab();

	$formContratConsult->ajouterComposantLigne($formContratConsult->creerLabel("Date de fin : ", "inputTexte") , 1 );
	$formContratConsult->ajouterComposantLigne($formContratConsult->creerInputTexte("dateFin", "dateFin", $_SESSION["contratActif"]->getDateFin(), 0, "" , 1),1);
	$formContratConsult->ajouterComposantTab();

	$formContratConsult->ajouterComposantLigne($formContratConsult->creerLabel("Type de contrat : ", "inputTexte") , 1 );
	$formContratConsult->ajouterComposantLigne($formContratConsult->creerInputTexte("typeContrat", "typeContrat", $_SESSION["contratActif"]->getTypeContrat(), 0, "" , 1),1);
	$formContratConsult->ajouterComposantTab();

	$formContratConsult->ajouterComposantLigne($formContratConsult->creerLabel("Nombre d'heures : ", "inputTexte") , 1 );
	$formContratConsult->ajouterComposantLigne($formContratConsult->creerInputTexte("nbHeures", "nbHeures", $_SESSION["contratActif"]->getNbHeures(), 0, "" , 1),1);
	$formContratConsult->ajouterComposantTab();

	$formContratConsult->ajouterComposantTab();
	$formContratConsult->creerFormulaire();

	
	$listeBulletin = "";
	foreach ($_SESSION['contratActif']->getLesBulletins() as $unBulletin) {

		$listeBulletin .= "<a href='bulletin/bulletin" ;
		$listeBulletin .= $_SESSION["identification"]["IDUSER"];
		$listeBulletin .= "'>";
		$listeBulletin .= "Voir bulletin du "; 
		$listeBulletin .= $unBulletin->getMois();
		$listeBulletin .= " "; 
		$listeBulletin .= $unBulletin->getAnnee();
		$listeBulletin .= "</a><br>";
		
		//$listeBulletin .= $unBulletin . "<br>";
	}


}
else{



	$formContratConsult =  new Formulaire("post", "index.php", "formEquipeConsult","formEquipeConsult");

	$formContratConsult->ajouterComposantLigne($formContratConsult->creerLabel("Veuillez sélectionner un Contrat ", ""),1);
	$formContratConsult->ajouterComposantTab();

	$formContratConsult->creerFormulaire();



}


require_once 'vue/Gestion/vueContrat.php';	

