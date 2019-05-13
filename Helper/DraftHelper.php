<?php

// src/Victortestmaster/Poker/Helper/DraftHelper.php
namespace App\Victortestmaster\Poker\Helper;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Victortestmaster\Poker\Model\CardsModel;


class DraftHelper extends Bundle
{


private $session;


private  $card;
private  $savecards;
private  $countcards;
private  $classpoker;
private  $used_cards;

    public function __construct(SessionInterface $session)
    {

        $this->cardsmodel  = new CardsModel($session);
        $this->session = $session;


    }

/**
 *
 *  Draft the cards
 *
 * @param    Array
 * @return      array
 *
 */

    public  function draftCards($cards)
    {
	    do { // We loop till we find a not drafted card
		    $n = rand(0,count($cards)-1);

	    } while(in_array($n, $this->session->get('used_cards')));

	    $this->getNotusedRandomCard($cards,$n);
	    $this->cardsmodel->saveCard($cards[$n]);
	    return $cards[$n];
    }


/**
 *
 * Save in array drafted cards
 *
 * @param    Array,Int
 *
 */

    private function getNotusedRandomCard($cards,$n)
    {
	    $this->session->set('used_cards',array_merge($this->session->get('used_cards'),array($n)));
    }


}
