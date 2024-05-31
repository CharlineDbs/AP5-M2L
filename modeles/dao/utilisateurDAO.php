<?php
class UtilisateurDAO{
        

    public static function verification(Utilisateur $utilisateur){
            
        $requetePrepa = DBConnex::getInstance()->prepare("select * from UTILISATEUR where login = :login and  mdp = md5(:mdp)");
        
        $login = $utilisateur->getLogin();
        $mdp =  $utilisateur->getMdp();
        
        $requetePrepa->bindParam(":login", $login);
        $requetePrepa->bindParam(":mdp" ,  $mdp);
        
        $requetePrepa->execute();

    return $requetePrepa->fetch(PDO::FETCH_ASSOC);
    
    }




    public static function mesContrats(int $idUtilisateur){
        
        $requetePrepa = DBConnex::getInstance()->prepare("select * from CONTRAT where IDUSER = :idUser");
      
             
        $requetePrepa->bindParam( ":idUser", $idUtilisateur);
           
        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC); 

        if(!empty($liste)){
            $contrats = [];
            foreach($liste as $contrat){
                $objetContrat = new Contrat(null, null, null, null, null, null);
                $objetContrat->hydrate($contrat);   
                $lesBulletins = ContratDAO::lesBulletinsContrat($objetContrat->getIdContrat());
                $objetContrat->setLesbulletins($lesBulletins);
                $contrats[] = $objetContrat; 
            }
        }
        
       return $contrats;
       
    }
    

    public static function lesContrats(){
        
        $requetePrepa = DBConnex::getInstance()->prepare("select * from CONTRAT");
           
        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC); 

        if(!empty($liste)){
            $contrats = [];
            foreach($liste as $contrat){
                $objetContrat = new Contrat(null, null, null, null, null, null);
                $objetContrat->hydrate($contrat);   
                //$objetContrat->setBulletin(ContratDAO::lesBulletinsContrat($objetContrat->getIdContrat()));
                $contrats[] = $objetContrat; 
            }
        }

       return $contrats;
       
    }


    public static function ModifierInfo(Utilisateur $unUtilisateur){
     
        try{
            $requetePrepa = DBConnex::getInstance()->prepare("UPDATE UTILISATEUR SET LOGIN = :LOGIN, MDP = md5(:MDP) WHERE IDUSER = :IDUSER");
        
            $login = $unUtilisateur->getLogin();
            $mdp = $unUtilisateur->getMdp();
            $idUser = $unUtilisateur->getId();

            $requetePrepa->bindParam(":nomEquipe", $login);
            $requetePrepa->bindParam(":nomEquipeLong" , $mdp);
            $requetePrepa->bindParam(":idEquipe", $idUser);

            return $requetePrepa->execute();

        }
        catch(PDOException $e) {
               echo $e->getMessage(); 
        }
        
    }

    
    
}
