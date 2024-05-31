<?php

class Contrat{

    use Hydrate;
    private ?int $idContrat;
    private ?int $idUser;
    private ?String $dateDebut;
    private ?String $dateFin;
    private ?String $typeContrat;
    private ?int $nbHeures;
    private array $lesBulletins = [];


    public function __construct(?int $unIdContrat, ?int $unIdUser, ?String $uneDateDeb, ?String $uneDateFin, ?String $unTypeContrat, ?int $unNbHeures){
        $this->idContrat = $unIdContrat;
        $this->idUser = $unIdUser;
        $this->dateDebut = $uneDateDeb;
        $this->dateFin = $uneDateFin;
        $this->typeContrat = $unTypeContrat;
        $this->nbHeures = $unNbHeures;
    }

    public function getIdContrat(): int{
        return $this->idContrat;
    }

    public function setIdContrat(int $unIdContrat): void{
        $this->idContrat = $unIdContrat;
    }

    public function getIdUser(): int{
        return $this->idUser;
    }

    public function setIdUser(int $unIdUser): void{
        $this->idUser = $unIdUser;
    }

    public function getDateDebut(): String{
        return $this->dateDebut;
    }

    public function setDateDebut(String $uneDateDeb): void{
        $this->dateDebut = $uneDateDeb;
    }

    public function getDateFin(): String{
        return $this->dateFin;
    }

    public function setDateFin(String $uneDateFin): void{
        $this->dateFin = $uneDateFin;
    }

    public function getTypeContrat(): String{
        return $this->typeContrat;
    }

    public function setTypeContrat(String $unTypeContrat): void{
        $this->typeContrat = $unTypeContrat;
    }

    public function getNbHeures(): int{
        return $this->nbHeures;
    }

    public function setNbHeures(int $unNbHeures): void{
        $this->nbHeures = $unNbHeures;
    }

    public function getLesBulletins(): array{
        return $this->lesBulletins;
    }

    public function setLesbulletins(array $lesBulletins): void{
        $this->lesBulletins = $lesBulletins;
    }
}