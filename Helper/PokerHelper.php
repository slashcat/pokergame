<?php

// src/Victortestmaster/Poker/Helper/PokerHelper.php
namespace App\Victortestmaster\Poker\Helper;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Victortestmaster\Poker\Model\CardsModel;


class PokerHelper extends Bundle
{

private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
        $this->cardsmodel  = new CardsModel($session);
        $this->draftmodel  = new DraftHelper($session);

    }

/**
 *
 * It makes the full process (get a random card and find if is the one you choose) as soon as you pick  a card
 *
 * @return      array
 *
 */

    public function play()
	{
                    $drafted_card = $this->draftmodel->draftCards($this->cardsmodel->createCards());
                    $this->cardsmodel->setCard($drafted_card);
                    $message = $this->cardsmodel->findCard($drafted_card);	

		   return array("drafted_card"=>$drafted_card,"message"=>$message);
	}




/**
 *
 * Start the game 
 *
 * @return  array
 *
 */

    public function  start($card)
    {

	    if($this->session->get('complete')== true) //If we reset the play
	    {
		    session_destroy();
		    return $this->redirectToRoute('app_poker_number');
	    }
	    $response = array();
	    if (!isset($_POST['draft']))
	    {
		    $this->session->set('complete', false);
		    $this->session->set('used_cards', array());
		    $this->session->set('saved_cards', array());
	    }
	    $response = array("drafted_card"=>"");

	    $message = ($this->cardsmodel->findCard()!=NULL)?$this->cardsmodel->findCard():"";
	    $response = array_merge($response,array("message"=>$message));
	    if ($this->session->get('card')!='')
	    {
		    $response = $this->play();
	    }

	return $response;
    }

}
