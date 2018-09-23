<?php

abstract class HandManager{

	function __construct(){

	}
	
	function getPairs($hand){
		$pairs = array();

		if(count($hand) > 1){
			usort($hand, function($a, $b){
			
				$aRank = $a->getRank();
				$bRank = $b->getRank();
				if($aRank == $bRank){
					return 0;			
				}

				return $aRank < $bRank ? -1 : 1;
			});

			$counter = 0;
			while(($counter + 1) < count($hand)){
				$cardA = $hand[$counter];
				$cardB = $hand[($counter+1)];

				if($cardA->getRank() === $cardB->getRank()){
					$pairs[] = $hand[$counter];
					$pairs[] = $hand[($counter+1)];
					$counter+=2;
				}
				else{
					$counter+=1;
				}				
			}
		}

		return $pairs;
	}


	abstract protected function playHand();
		
	function removePairs(&$hand){

		$pairs = $this->getPairs($hand);
		if(count($pairs) > 0){

			$hand = array_udiff($hand, $pairs, function($itemFromA, $itemFromB){
				$aRank = $itemFromA->getRank();
				$bRank = $itemFromB->getRank();
				$aSuit = $itemFromA->getSuit();
				$bSuit = $itemFromB->getSuit();

				if($aSuit === $bSuit){
					if($aRank === $bRank){
						return 0;
					}
				}
				return $aRank < $bRank ? -1 : 1;
			});
			return true;
		}

		return false;
	}

	function printHand($cardArray, $hideCards){
		$hand = "";
		foreach($cardArray as $card){
			if($hideCards){
				$hand.="XX ";				
			}
			else{
				$hand.= $card->printCard()." ";				
			}
		}

		return trim($hand);
	}
	
}
