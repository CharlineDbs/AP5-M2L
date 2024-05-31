<?php

class ClubDAO{

    public static function lesClubs(Ligue $ligue){

        $requetePrepa = DBConnex::getInstance()->prepare("select * from CLUB Where IDLIGUE = :idLigue");

        $idLigue = $ligue->getIdLigue();
        
        $requetePrepa->bindParam(":idLigue", $idLigue);
        
        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($liste)){
            $clubs = [];
            foreach($liste as $club){
                $unClub = new Club(null,null,null,null,null);
                $unClub->hydrate($club);
                $clubs[] = $unClub;
            }
            return $clubs;
        }

    }


    public static function enregistrerClub(Club $unClub){
        $requetePrepa = DBConnex::getInstance()->prepare("Insert into CLUB (IDCOMMUNE, IDLIGUE, NOMCLUB, ADRESSECLUB) VALUES (:IDCOMMUNE, :IDLIGUE, :NOMCLUB, :ADRESSECLUB)");

        $commune = $unClub->getIdCommune();
        $nomClub = $unClub->getNomClub();
        $idLigue = $unClub->getIdLigue();
        $adresse = $unClub->getAdresseClub();

        $requetePrepa->bindParam(":IDCOMMUNE",$commune);
        $requetePrepa->bindParam(":NOMCLUB",$nomClub);
        $requetePrepa->bindParam(":IDLIGUE", $idLigue);
        $requetePrepa->bindParam(":ADRESSECLUB",$adresse);

        $requetePrepa->execute();

        return DBConnex::getInstance()->lastInsertId();

    }


    public static function modifierClub($idClub, $idLigue, $idCommune, $nomClub, $adresseClub){
         $requetePrepa = DBConnex::getInstance()->prepare("Update CLUB set NOMCLUB = :Nom, ADRESSECLUB = :adresse WHERE 
         IDLIGUE = :IDLIGUE and IDCOMMUNE = :IDCOMMUNE and IDCLUB = :IDCLUB");

        $requetePrepa->bindParam(":IDLIGUE", $idLigue);
        $requetePrepa->bindParam(":IDCOMMUNE", $idCommune);
         $requetePrepa->bindParam(":Nom", $nomClub);
        $requetePrepa->bindParam(":adresse", $adresseClub);
        $requetePrepa->bindParam(":IDCLUB", $idClub);

        $requetePrepa->execute();


    }



    public static function supprimerClub($idClub, $idLigue, $idCommune){

        $requetePrepa = DBConnex::getInstance()->prepare("delete from CLUB where IDLIGUE = :idLigue and IDCOMMUNE = :idCommune And IDCLUB = :idClub");

        $requetePrepa->bindParam(":idLigue",$idLigue);
        $requetePrepa->bindParam(":idCommune",$idCommune);
        $requetePrepa->bindParam(":idClub",$idClub);

        $requetePrepa->execute();

    }


    public static function AfficherClub(){

        $requetePrepa = DBConnex::getInstance()->prepare("select * from CLUB");
        
        $requetePrepa->execute();
        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($liste)){
            $clubs = [];
            foreach($liste as $club){
                $unClub = new Club(null,null,null,null,null);
                $unClub->hydrate($club);
                $clubs[] = $unClub;
            }
            return $clubs;
        }

    }


}
