<?php

// src/Victortestmaster/Poker/Model/CardsModel.php
namespace App\Victortestmaster\Poker\Model;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CardsModel extends Bundle
{


	private $session;


	private  $card;
	private  $savecards;
	private  $countcards;
	private  $classpoker;
	private  $used_cards;

	public function __construct(SessionInterface $session)
	{
		$this->session = $session;
	}



	/**
	 *
	 * Find if the drafted card is like the one you choose
	 *
	 * @param    string
	 * @return      array
	 *
	 */


	public function findCard($card = "")
	{
		if($card == "")
		{
			return array("message"=>"Start to play","value"=>true);
		}

		$percent =  count($this->session->get('used_cards'))* 100;
		$percent_friendly = number_format( $percent /  count($this->createCards()) , 2 ) ;
		$split = str_split($this->session->get('card'));

		if(($split[0]==$card["value"]) && ($split[1]==$card["suit"] ))
		{
			$return = array("message"=>"Got it, the chance was","percent"=>"%".$percent_friendly,"value"=>true);
			$this->session->set('complete', true);
		}
		else
		{
			$return = array("message"=>"The chance of getting selected card is","percent"=>"%".$percent_friendly,"value"=>false);
		}

		return $return;
	}


	/**
	 *
	 *  We get all the cards
	 *
	 * @return      array
	 *
	 */

	public function createCards() {

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

		return $cards;

	}




	public function setCard($card)
	{
		$_SESSION['card'] = $card;
		$this->card = $card;	
	}


	/**
	 *
	 *  Save drafted cards
	 *
	 * @param    array
	 * @return      array
	 *
	 */

	public function saveCard($card)
	{

		$add = true;
		foreach($this->session->get('saved_cards') as $saved_cards)
		{
			if(($saved_cards["suit"]==$card["suit"]) && ($saved_cards["value"]==$card["value"]))
			{
				$add = false;
			}
		}
		if($add == true)
		{
			$this->session->set('saved_cards',array_merge($this->session->get('saved_cards'),array(array("suit"=>$card["suit"],"value"=>$card["value"],"full"=>$card["full"]))));
			$this->setSaveCard($this->session->get('saved_cards'));
		}

		return $this->session->get('saved_cards');
	}




	
	/* SETTERS */



	public function setSessionCard($card)
	{
		$this->session->set('card',$card);
		$this->session->set('used_cards',array());
		$this->session->set('saved_cards',array());
	}
	/**
	 *
	 * @param    array
	 */
	public function setSaveCard($card)
	{
		$this->savecards=$card;
	}

	/*@param array*/

	public function setCountCards($param)
	{
		return $this->countcards = $param;
	}


	/* GETTERS */
	public function getSavedCards()
	{
		return $this->savecards;
	}


	public function getCountCadrds()
	{
		return $this->countcards;
	}



}
