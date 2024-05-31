<?php


$_SESSION["lesInformations"] = new Contrats(UtilisateurDAO::lesContrats());

$menuInformation = new Menu("menuInformation");

foreach ($_SESSION['lesInformations']->getContrats() as $unContrat){
	$menuInformation->ajouterComposant($menuInformation->creerItemLien($unContrat->getIdContrat() , $unContrat->getIdUser()));
}

$leMenuInformation = $menuInformation->creerMenu($_SESSION['intervenantActif'], "intervenant");

if(isset($_GET['intervenant'])){
	$_SESSION['intervenantActif']= $_GET['intervenant'];
}
else
{
	if(!isset($_SESSION['intervenantActif'])){
		$_SESSION['intervenantActif']="0";
	}
}

if($_SESSION['intervenantActif']!="0"){



	$lesInformationsActifs = $_SESSION['lesInformations']->chercheContrat($_SESSION['intervenantActif']);



	$formIntervenantConsult =  new Formulaire("post", "index.php", "formIntervenantConsult","formIntervenantConsult");


	$formIntervenantConsult->ajouterComposantLigne($formIntervenantConsult->creerLabel("Numéro Contrat: ", "inputTexte") , 1 );
	$formIntervenantConsult->ajouterComposantLigne($formIntervenantConsult->creerInputTexte("numeroContrat", "numeroContrat", $lesInformationsActifs->getIdContrat(), 0, "" , 1),1);
	$formIntervenantConsult->ajouterComposantTab();

	$formIntervenantConsult->ajouterComposantLigne($formIntervenantConsult->creerLabel("Identifiant : ", "inputTexte") , 1 );
	$formIntervenantConsult->ajouterComposantLigne($formIntervenantConsult->creerInputTexte("idUser", "idUser", $lesInformationsActifs->getIdUser(), 0, "" , 1),1);
	$formIntervenantConsult->ajouterComposantTab();

	$formIntervenantConsult->ajouterComposantLigne($formIntervenantConsult->creerLabel("Date de début : ", "inputTexte") , 1 );
	$formIntervenantConsult->ajouterComposantLigne($formIntervenantConsult->creerInputTexte("dateDebut", "dateDebut", $lesInformationsActifs->getDateDebut(), 0, "" , 1),1);
	$formIntervenantConsult->ajouterComposantTab();

	$formIntervenantConsult->ajouterComposantLigne($formIntervenantConsult->creerLabel("Date de fin : ", "inputTexte") , 1 );
	$formIntervenantConsult->ajouterComposantLigne($formIntervenantConsult->creerInputTexte("dateFin", "dateFin", $lesInformationsActifs->getDateFin(), 0, "" , 1),1);
	$formIntervenantConsult->ajouterComposantTab();

	$formIntervenantConsult->ajouterComposantLigne($formIntervenantConsult->creerLabel("Type de contrat : ", "inputTexte") , 1 );
	$formIntervenantConsult->ajouterComposantLigne($formIntervenantConsult->creerInputTexte("typeContrat", "typeContrat", $lesInformationsActifs->getTypeContrat(), 0, "" , 1),1);
	$formIntervenantConsult->ajouterComposantTab();

	$formIntervenantConsult->ajouterComposantLigne($formIntervenantConsult->creerLabel("Nombre d'heures : ", "inputTexte") , 1 );
	$formIntervenantConsult->ajouterComposantLigne($formIntervenantConsult->creerInputTexte("nbHeures", "nbHeures", $lesInformationsActifs->getNbHeures(), 0, "" , 1),1);
	$formIntervenantConsult->ajouterComposantTab();


	$formIntervenantConsult->ajouterComposantTab();
	$formIntervenantConsult->creerFormulaire();

}
else{


	$formIntervenantConsult =  new Formulaire("post", "index.php", "formIntervenantConsult","formIntervenantConsult");

	$formIntervenantConsult->ajouterComposantLigne($formIntervenantConsult->creerLabel("Veuillez sélectionner un Contrat ", ""),1);
	$formIntervenantConsult->ajouterComposantTab();
	$formIntervenantConsult->creerFormulaire();


}

require_once 'vue/Gestion/vueInformationInter.php';