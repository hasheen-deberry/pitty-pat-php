<?php
/*
 * Card.php
 *
 *
 */

class Card
{
	private $suit;
	private $rank;

	function __construct($cardRank, $cardSuit)
	{
		$this->suit = $cardSuit;
		$this->rank = $cardRank;
	}

	public function getRank(){
		return $this->rank;
	}

	public function getSuit(){
		return $this->suit;	
	}

	public function printCard(){
		$translatedRank = "";
		switch($this->rank){
			case 1:
				$translatedRank = "A";
				break;
			case 11:
				$translatedRank = "J";
				break;
			case 12:
				$translatedRank = "Q";
				break;
			case 13:
				$translatedRank = "K";
				break;
			default:
				$translatedRank = "{$this->rank}";
				break;
		}
		return $translatedRank.$this->suit;
	}
}
?>
