<?php
require "PlayerHandManager.php";

class PittyPat{
	private $isPlayerTurn;
	private $cardTableLayoutFormat = "    PLAYER 2     ".PHP_EOL.PHP_EOL.
						"     %s     ".PHP_EOL.PHP_EOL.PHP_EOL.
						"     XX    %s     ".PHP_EOL.PHP_EOL.PHP_EOL.
						"     %s     ".PHP_EOL.PHP_EOL.
						"     PLAYER 1    ".PHP_EOL;
	private $isPlayersTurn = true;
	
	function __construct(){
		$this->reset();
		$this->play();
	}


	function addCardFromDeck(&$stack){
		if($this->cardIndex >= 52){
			return;
		}

		$stack[] = $this->deck->getCard($this->cardIndex);
		$this->cardIndex+=1;
	}

	function reset(){
		$this->robotPlayerCards = array();
		$this->humanPlayerCards = array();
		$this->discardStack = array();
		$this->freshCardStack = array();

		$this->deck = new CardDeck();
		$this->deck->shuffleDeck();

		$this->cardIndex = 0;

		for($i=0;$i<5;$i++){
			$this->addCardFromDeck($this->humanPlayerCards);
			$this->addCardFromDeck($this->robotPlayerCards);
		}

		$this->addCardFromDeck($this->discardStack);

		while($this->cardIndex < 52){
			$this->addCardFromDeck($this->freshCardStack);
		}

		$this->updateDisplay();
	}

	function updateDisplay(){
		system("clear");

		echo sprintf($this->cardTableLayoutFormat, 
			$this->printHand($this->robotPlayerCards, true), 
			end($this->discardStack) != null ? end($this->discardStack)->printCard() : "[]",
			$this->printHand($this->humanPlayerCards, false));
	}

	function play(){
		$this->isPlayerTurn = true;

		$this->removePairs($this->humanPlayerCards);
		$this->removePairs($this->robotPlayerCards);

		do{
			$this->playHand();
		}while(count($this->humanPlayerCards) > 0 or count($this->robotPlayerCards) > 0);
	}
}

?>
