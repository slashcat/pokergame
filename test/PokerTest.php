<?php

//  Victortestmaster/Poker/PokerTest.php

namespace App\Victortestmaster\Poker;

use App\Util\PokerTest;
use PHPUnit\Framework\TestCase;
use App\Controller\PockerController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class PokerTests extends TestCase
{

private $session;


public function testIsChanceValid(){

	$card = "2H";
	$session = new Session(new MockArraySessionStorage());
	$class_card = new \App\Victortestmaster\Poker\Helper\DraftHelper($session);
	$poker_helper = new \App\Victortestmaster\Poker\Helper\PokerHelper($session);
	$card_model = new \App\Victortestmaster\Poker\Model\CardsModel($session);

	$card_model->setSessionCard($card);
	$cards = $card_model->createCards();	
        $result = $poker_helper->play(); 
	$this->assertTrue($result["message"]["percent"] == '%1.92');

}





public function testCards()
{

 $session = new Session(new MockArraySessionStorage());


	$suits = array(
			'H' => 'Hearts',
			'C' => 'Clubs',
			'D' => 'Diamonds',
			'S' => 'Spades'
		      );
	$values = array(
			'A' => 'Ace',
			'2' => 'Two',
			'3' => 'Three',
			'4' => 'Four',
			'5' => 'Five',
			'6' => 'Six',
			'7' => 'Seven',
			'8' => 'Eight',
			'9' => 'Nine',
			'10' => 'Ten',
			'J' => 'Jack',
			'Q' => 'Queen',
			'K' => 'King'
		       );

	$cards = array();

	foreach ($suits as $key=>$suit){
		foreach ($values as $key2=>$value){

			$cards[] = array(
					'suit' => $key,
					'value' => $key2,
					'full' => $suit.' of '.$value,
					);
		}
	}

	$card = new \App\Victortestmaster\Poker\Model\CardsModel($session);

	$this->assertTrue($card->createCards() == $cards);
	unset($game);

}

}



