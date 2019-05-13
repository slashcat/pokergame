<?php


// src/Victortestmaster/Poker/Controller/PokerController.php
namespace App\Victortestmaster\Poker\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


use App\Victortestmaster\Poker\CardsModel;
use App\Victortestmaster\Poker\PokerHelper;
use App\Victortestmaster\Poker\DraftModel;


class PokerController extends Controller
{
    /**
     * @Route("/poker/welcome/", name="app_poker_welcome")
     */

    public function welcome()
    {

	 return $this->render('poker/welcome.html.twig', ['warning'   => ""]);

    }



}



