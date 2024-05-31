<?php

class Utilisateur{

    private ?int $id;
    private ?string $login;
    private ?string $mdp;
    private ?string $statut;
    private Array $contrats;
    

    public function __construct(?int $unId, ?string $unLogin, ?string $unMdp, ?string $unStatut){
        $this->id = $unId;
		$this->login = $unLogin;
		$this->mdp = $unMdp;
        $this->statut = $unStatut;
	}

    public function getId(): String{
        return $this->id;
    }

    public function getLogin(): String{
        return $this->login;
    }

    public function setLogin(String $unLogin): void{
        $this->login = $unLogin;
    }

    public function getMdp(): String{
        return $this->mdp;
    }

    public function setMdp(String $unMdp): void{
        $this->mdp = $unMdp;
    }

    public function getStatut(): String{
        return $this->statut;
    }

    public function setStatut(String $unStatut): void{
        $this->statut = $unStatut;
    }
}

