<?php
class Contrats{

	private array $contrats ;

	public function __construct($array){
		if (is_array($array)) {
			$this->contrats = $array;
		}
	}

	public function getContrats(){
		return $this->contrats;
	}

	public function chercheContrat($unIdContrat){
		$i = 0;
		while ($unIdContrat != $this->contrats[$i]->getIdContrat() && $i < count($this->contrats)-1){
			$i++;
		}
		if ($unIdContrat == $this->contrats[$i]->getIdContrat()){
			return $this->contrats[$i];
		}
	}
}