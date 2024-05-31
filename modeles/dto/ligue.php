<?php

class Ligue{   
    use Hydrate;
    private ?int $idLigue;
    private ?int $idCommune;
    private ?String $nomLigue;
    private ?String $site;
    private ?String $descriptif;
    private array $lesClubs = [] ;


    public function __construct(?int $unIdLigue, ?int $unIdCommune, ?String $unNomLigue, ?String $unSite, ?String $unDescriptif){

        $this->idCommune = $unIdCommune;
        $this->idLigue = $unIdLigue;
        $this->nomLigue = $unNomLigue;
        $this->site = $unSite;
        $this->descriptif = $unDescriptif;

    }
        public function getIdLigue(): int{
            return $this->idLigue;
        }

        public function setIdLigue(int $unIdLigue): void{
            $this->idLigue = $unIdLigue;
        }
      
        public function getIdCommune(): int{
            return $this->idCommune;
        }

        public function setIdCommune(int $unIdCommune): void{
            $this->idCommune =  $unIdCommune;
        }

        public function getNomLigue(): String{
            return $this->nomLigue;
        }

        public function setNomLigue(String $unNomLigue): void{
            $this->nomLigue =  $unNomLigue;
        }

        public function getSite(): String{
            return $this->site;
        }

        public function setSite(String $unSite): void{
            $this->site =  $unSite;
        }

        public function getDescriptif(): String{
            return $this->descriptif;
        }
    
        public function setDescriptif(String $unDescriptif): void{
            $this->descriptif =  $unDescriptif;
        }


        public function getLesClubs(): array{
            return $this->lesClubs;
        }

        public function setLesClubs(array $lesClubs): void{
            $this->lesClubs = $lesClubs;
        }

}