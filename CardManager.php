<?php

include CardDeck.php;

class CardManager{
	private $_playerOne; //CardManager object
	private $_playerTwo; //CardManager object
	private $_deck;

	function __construct(&playerOne, &playerTwo){
		$this->_playerOne = $playerOne;
		$this->_playerTwo = $playerTwo;
		$this->_deck = new CardDeck();
	}
}
