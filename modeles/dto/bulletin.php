<?php

class Bulletin{

    use Hydrate;
    private ?int $idBulletin;
    private ?int $idContrat;
    private ?int $Mois;
    private ?int $Annee;
    private ?String $BulletinPDF;

    public function __construct(?int $unIdBulletin, ?int $unIdContrat, ?int $unMois, ?int $uneAnnee, ?String $unBulletin){
        $this->idBulletin = $unIdBulletin;
        $this->idContrat = $unIdContrat;
        $this->Mois = $unMois;
        $this->Annee = $uneAnnee;
    }

    public function getIdBulletin(): int{
        return $this->idBulletin;
    }

    public function setIdBulletin(int $unIdBulletin): void{
        $this->idBulletin = $unIdBulletin;
    }

    public function getIdContrat(): int{
        return $this->idContrat;
    }

    public function setIdContrat(int $unIdContrat): void{
        $this->idContrat = $unIdContrat;
    }

    public function getMois(): int{
        return $this->Mois;
    }

    public function setMois(int $unMois): void{
        $this->Mois = $unMois;
    }

    public function getAnnee(): int{
        return $this->Annee;
    }

    public function setAnnee(int $uneAnnee): void{
        $this->Annee = $uneAnnee;
    }

    public function getBulletinPDF(): String{
        return $this->BulletinPDF;
    }

    public function setBulletinPDF(String $unBulletin): void{
        $this->BulletinPDF = $unBulletin;
    }



}