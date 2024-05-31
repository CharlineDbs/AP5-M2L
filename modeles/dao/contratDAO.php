<?php

class ContratDAO{


    public static function lesBulletinsContrat(int $idContrat){
        
        $bulletins = [];
        $requetePrepa = DBConnex::getInstance()->prepare("select * from BULLETIN where IDCONTRAT = :idContrat");
                      
        $requetePrepa->bindParam( ":idContrat", $idContrat);
           
        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC); 

        if(!empty($liste)){           
            foreach($liste as $bulletin){
                $objetBulletin = new Bulletin(null, null, null, null, null);
                $objetBulletin->hydrate($bulletin);
                $bulletins[] = $objetBulletin; 
            }
        }

       return $bulletins;
       
    }


}