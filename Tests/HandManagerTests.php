<?php
	include '../Card.php';
	include '../PlayerHandManager.php';
	use PHPUnit\Framework\TestCase;



class HandManagerTests extends TestCase{

	/** @test */
	public function HandHasOnePair_ExpectNumberOfPairsToMatch(){
		$hand = [];
		array_push($hand, new Card('A', 'S'));
		array_push($hand, new Card('A', 'D'));
		array_push($hand, new Card('7', 'D'));
		array_push($hand, new Card('4', 'C'));
		array_push($hand, new Card('9', 'H'));		

		$player = new PlayerHandManager();
		$pairedCards = $player->getPairs($hand);
		$this->assertSame(2, count($pairedCards));
		
	} 

	/** @test */
	public function HandHasTwoPairs_ExpectNumberOfPairsToMatch(){
		$hand = [];
		array_push($hand, new Card('9', 'C'));
		array_push($hand, new Card('2', 'S'));
		array_push($hand, new Card('9', 'D'));
		array_push($hand, new Card('K', 'H'));
		array_push($hand, new Card('K', 'C'));

		$player = new PlayerHandManager();
		$pairedCards = $player->getPairs($hand);
		$this->assertSame(4, count($pairedCards));
	}

	/** @test */
	public function PrintHandButHideCards_ExpectPrintToMatchAsXs(){
		$hand = [];
		array_push($hand, new Card('7', 'C'));
		array_push($hand, new Card('K', 'H'));
		array_push($hand, new Card('Q', 'S'));
		array_push($hand, new Card('4', 'H'));
		array_push($hand, new Card('Q', 'D'));

		$player = new PlayerHandManager();

		$actual = $player->printHand($hand, true);		
		$this->assertSame('XX XX XX XX XX', $actual);		
	}

	/** @test */
	public function PrintHand_ExpectPrintToMatchExpected(){
		$hand = [];
		array_push($hand, new Card('9', 'C'));
		array_push($hand, new Card('4', 'H'));
		array_push($hand, new Card('7', 'S'));
		array_push($hand, new Card('A', 'H'));
		array_push($hand, new Card('6', 'D'));

		$player = new PlayerHandManager();

		$actual = $player->printHand($hand, false);		
		$this->assertSame('9C 4H 7S AH 6D', $actual);		
	}

	/** @test */
	public function RemovePairs_HandHasOnePair_ExpectThreeCardsLeft(){
		$hand = [];
		array_push($hand, new Card('9', 'C'));
		array_push($hand, new Card('4', 'H'));
		array_push($hand, new Card('9', 'S'));
		array_push($hand, new Card('A', 'H'));
		array_push($hand, new Card('6', 'D'));
		
		$player = new PlayerHandManager();

		$player->removePairs($hand);

		$this->assertSame(3, count($hand));
	}

}


