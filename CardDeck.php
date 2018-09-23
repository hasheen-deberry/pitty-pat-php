<?php

include "Card.php";

class CardDeck{
	private $deck;
	private $index;

	function __construct(){
		$this->deck = array();
		$this->populateDeck();
		$this->index = -1;
	}

	function populateDeck(){
		$suits = array("S","H","C","D");
		foreach($suits as $suit){
			for($i = 1; $i<14; $i++){
				$this->deck[] = new Card($i, $suit);
			}
		}
	}
/*
	function getCard($index){
		if(!is_integer($index) || $index < 0 || $index > 51){
			return new Card(0, "J"); //joker
		}

		return $this->deck[$index];
	}
*/

	function getNextCard(){
		$this->index = $this->index + 1;
		if($this->index > 51){
			return new Card(0,"J");
		}
		return $this->deck[$this->index];
	}

	function shuffleDeck(){
		for($i=0;$i<6;$i++){
			for($k = 0; $k < count($this->deck); $k++){
				$newIndex = rand(0, 51);
				$cardAtNewIndex = $this->deck[$newIndex];
				$this->deck[$newIndex] = $this->deck[$k];
				$this->deck[$k] = $cardAtNewIndex;
			}
		}
	}
}
?>
