<?php

$unUtilisateur = new Utilisateur($_SESSION['identification']["IDUSER"],$_SESSION['identification']["LOGIN"],$_SESSION['identification']["MDP"],$_SESSION['identification']["STATUT"]);
$_SESSION['mesInformmations'] = UtilisateurDAO::verification($unUtilisateur);

if(isset($_GET['information'])){
	$_SESSION['idUser']= $_GET['information'];
}
else
{
        if(!isset($_SESSION['idUser'])){
		$_SESSION['idUser']="0";
	}
}

if(isset($_POST['submitModifierInfo'])){
                
        $uneInfo = new Utilisateur($_SESSION['identification']["IDUSER"],null,null,null);
        $uneInfo->setLogin($_POST["login"]);
        $rep_sgbd = UtilisateurDAO::ModifierInfo($uneInfo);

        if(!$rep_sgbd){
                echo "modification non effectuée";		
        }

}



if($_SESSION['identification']["IDUSER"]!="0"){
	
	if(isset($_POST['submitModifier'])){

		

        $formUtilisateurModif =  new Formulaire("post", "index.php", "formUtilisateurModif","formUtilisateurModif");


        $formUtilisateurModif->ajouterComposantLigne($formUtilisateurModif->creerLabel("Votre Identifiant : ", "inputTexte") , 1 );
        $formUtilisateurModif->ajouterComposantLigne($formUtilisateurModif->creerInputTexte("identifiant", "identifiant", $unUtilisateur->getId(), 0, "" , 1),1);
        $formUtilisateurModif->ajouterComposantTab();
    
        $formUtilisateurModif->ajouterComposantLigne($formUtilisateurModif->creerLabel("Votre Login : ", "inputTexte") , 1 );
        $formUtilisateurModif->ajouterComposantLigne($formUtilisateurModif->creerInputTexte("login", "login", $unUtilisateur->getLogin(), 0, "" , 0),1);
        $formUtilisateurModif->ajouterComposantTab();
    
        $formUtilisateurModif->ajouterComposantLigne($formUtilisateurModif->creerLabel("Votre Statut : ", "inputTexte") , 1 );
        $formUtilisateurModif->ajouterComposantLigne($formUtilisateurModif->creerInputTexte("statut", "statut", $unUtilisateur->getStatut(), 0, "" , 1),1);
        $formUtilisateurModif->ajouterComposantTab();

	$formUtilisateurModif->ajouterComposantLigne($formUtilisateurModif->creerInputSubmit("submitAnnuler", "submitAnnuler", "Annuler"), 1);
	$formUtilisateurModif->ajouterComposantLigne($formUtilisateurModif->creerInputSubmit("submitModifierInfo", "submitModifierInfo", "Enregistrer"), 1);
	$formUtilisateurModif->ajouterComposantTab();

	$formUtilisateurModif->ajouterComposantTab();
	$formUtilisateurModif->creerFormulaire();

	}
        else{

        $formUtilisateurModif =  new Formulaire("post", "index.php", "formUtilisateurModif","formUtilisateurModif");


        $formUtilisateurModif->ajouterComposantLigne($formUtilisateurModif->creerLabel("Votre Identifiant : ", "inputTexte") , 1 );
        $formUtilisateurModif->ajouterComposantLigne($formUtilisateurModif->creerInputTexte("identifiant", "identifiant", $unUtilisateur->getId(), 0, "" , 1),1);
        $formUtilisateurModif->ajouterComposantTab();
    
        $formUtilisateurModif->ajouterComposantLigne($formUtilisateurModif->creerLabel("Votre Login : ", "inputTexte") , 1 );
        $formUtilisateurModif->ajouterComposantLigne($formUtilisateurModif->creerInputTexte("login", "login", $unUtilisateur->getLogin(), 0, "" , 1),1);
        $formUtilisateurModif->ajouterComposantTab();
    
        $formUtilisateurModif->ajouterComposantLigne($formUtilisateurModif->creerLabel("Votre Statut : ", "inputTexte") , 1 );
        $formUtilisateurModif->ajouterComposantLigne($formUtilisateurModif->creerInputTexte("statut", "statut", $unUtilisateur->getStatut(), 0, "" , 1),1);
        $formUtilisateurModif->ajouterComposantTab();


        $formUtilisateurModif->ajouterComposantLigne($formUtilisateurModif->creerInputSubmit("submitModifier", "submitModifier", "Modifier"), 1);
        $formUtilisateurModif->ajouterComposantTab();
    
        $formUtilisateurModif->ajouterComposantTab();
        $formUtilisateurModif->creerFormulaire();
	}
}



require_once 'vue/Gestion/vueInformation.php';