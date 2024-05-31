<?php


class Clubs{
	private array $clubs ;

	public function __construct($array){
		if (is_array($array)) {
			$this->clubs = $array;
		}
	}

	public function getClubs(){
		return $this->clubs;
	}

	public function setClubs(array $unClub): void{
		$this->clubs = $unClub;
	}


	public function chercheClub($unIdClub){
		$i = 0;
		while ($unIdClub != $this->clubs[$i]->getIdClub() && $i < count($this->clubs)-1){
			$i++;
		}
		if ($unIdClub == $this->clubs[$i]->getIdClub()){
			return $this->clubs[$i];
		}
	}

}