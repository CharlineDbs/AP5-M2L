<?php


class LigueDAO{

    public static function lesLigues(){
        $result = [];
        $requetePrepa = DBConnex::getInstance()->prepare("select * from LIGUE");

        $requetePrepa->execute();
        $liste = $requetePrepa->fetchALL(PDO::FETCH_ASSOC);

        if(!empty($liste)){
            foreach($liste as $ligue){
                $uneLigue = new Ligue(null, null, null, null, " ");
                $uneLigue->hydrate($ligue);
                $lesClubs = ClubDAO::lesClubs($uneLigue);
                
                if(!empty($lesClubs)){
                    $uneLigue->setlesClubs($lesClubs);
                }
                
                $result[] = $uneLigue;
            }
        }
        return $result;

    }

    public static function enregistrerLigue(Ligue $uneLigue){

        $requetePrepa = DBConnex::getInstance()->prepare("Insert into LIGUE (IDCOMMUNE, NOMLIGUE, SITE, DESCRIPTIF) VALUES (:IDCOMMUNE, :NOMLIGUE, :SITE, :DESCRIPTIF)");

        $commune = $uneLigue->getIdCommune();
        $nomLigue = $uneLigue->getNomLigue();
        $site = $uneLigue->getSite();
        $descriptif = $uneLigue->getDescriptif();

        $requetePrepa->bindParam(":IDCOMMUNE",$commune);
        $requetePrepa->bindParam(":NOMLIGUE",$nomLigue);
        $requetePrepa->bindParam(":SITE", $site);
        $requetePrepa->bindParam(":DESCRIPTIF", $descriptif);


        $requetePrepa->execute();

        return DBConnex::getInstance()->lastInsertId();

    }

    public static function modifierLigue($idLigue, $idCommune, $nomLigue, $site, $descriptif){
        $requetePrepa = DBConnex::getInstance()->prepare("Update LIGUE SET NOMLIGUE = :NOMLIGUE, SITE = :SITE, DESCRIPTIF = :DESCRIPTIF 
        WHERE IDLIGUE = :IDLIGUE AND IDCOMMUNE = :IDCOMMUNE");
    
        $requetePrepa->bindParam(":IDLIGUE", $idLigue);
        $requetePrepa->bindParam(":IDCOMMUNE", $idCommune);
        $requetePrepa->bindParam(":NOMLIGUE", $nomLigue);
        $requetePrepa->bindParam(":SITE", $site);
        $requetePrepa->bindParam(":DESCRIPTIF", $descriptif);

        $requetePrepa->execute();

    
    }


    public static function supprimerLigue($idLigue, $idCommune){

        $requetePrepa = DBConnex::getInstance()->prepare("delete from LIGUE where IDLIGUE = :idLigue and IDCOMMUNE = :idCommune");

        $requetePrepa->bindParam(":idLigue",$idLigue);
        $requetePrepa->bindParam(":idCommune",$idCommune);

        $requetePrepa->execute();

    }


}


