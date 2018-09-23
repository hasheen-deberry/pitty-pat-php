<?php
require 'HandManager.php';
class PlayerHandManager extends HandManager{

	function promptSelect(&$hand){
		$instructions = '';
		$canDrawFromDiscardPile = false;
		$canDrawFromFreshCardPile = false;

		if(end($this->discardStack) !== null){
			$canDrawFromDiscardPile = true;
		}

		if(end($this->freshCardStack) !== null){
			$canDrawFromFreshCardPile = true;
		}

		if($canDrawFromDiscardPile and $canDrawFromFreshCardPile){

			$instructions.='Press 1 to draw from discard pile'.PHP_EOL;
			$instructions.='Press 2 to draw from fresh card pile: ';

			$userInputValid  = false;

			do{

				$choice = readLine($instructions);
				if(isset($choice) and intVal($choice) > 0 and intVal($choice) < 3){
					$userInputValid = true;
					if($choice == 1){
						$hand[] = array_pop($this->discardStack);
					}
					else{
						$hand[] = array_pop($this->freshCardStack);
					}
				}
			}while(!$userInputValid);
		}
		else if($canDrawFromDiscardPile){
			$hand[] = array_pop($this->discardStack);
		}
		else{
			$hand[] = array_pop($this->freshCardStack);
		}
	}

	function playHand(){

	}

	function promptDiscard(&$hand){
		$discardPromptFormat = "YOUR CARDS: %s".PHP_EOL."%s";	
		$instructions = "";
		for($i=0;$i < count($hand); $i+=1){
			$instructions.="Press {($i+1)} to discard ".$hand[$i]->printCard().PHP_EOL;
		}
		$userInputValid = false;
		do{
			$userInput = readLine(sprintf($discardPromptFormat, $this->printHand($hand), $instructions));

			if(isset($userInput) and intVal($userInput) <= count($hand)){
				$inputAsInt = intVal($userInput);
				$userInputValid = true;

				$this->discardStack[] = $hand[$inputAsInt - 1];
				unset($hand[$inputAsInt - 1]);
			}
		}while(!$userInputValid);
	}
}
