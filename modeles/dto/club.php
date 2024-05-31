<?php

class Club{

    use Hydrate; 

    private ?int $idClub;
    private ?int $idCommune;
    private ?String $nomClub;
    private ?String $adresseClub;
    private ?int $idLigue;


    public function __construct(?int $unIdClub, ?int $unIdLigue, ?int $unIdCommune, ?String $unNomClub, ?String $uneAdresseClub){
        $this->idClub = $unIdClub;
        $this->idLigue =  $unIdLigue;
        $this->idCommune = $unIdCommune;
        $this->nomClub = $unNomClub;
        $this->adresseClub = $uneAdresseClub;

    }

    public function getIdClub(): int{
        return $this->idClub;
    }

    public function setIdClub($unIdClub): void{
        $this->idClub = $unIdClub;
    }

    public function getIdLigue(): int{
        return $this->idLigue;
    }

    public function setIdLigue(int $unIdLigue): void{
        $this->idLigue =  $unIdLigue;
    }
  

    public function getIdCommune(): int{
        return $this->idCommune;
    }

    public function setIdCommune(int $unIdCommune): void{
        $this->idCommune =  $unIdCommune;
    }


    public function getNomClub(): String{
        return $this->nomClub;
    }

    public function setNomClub($unNomClub): void{
        $this->nomClub = $unNomClub;
    }

    public function getAdresseClub(): String{
        return $this->adresseClub;

    }

    public function setAdresseClub($uneAdresseClub): void{
        $this->adresseClub = $uneAdresseClub;
    }

}


