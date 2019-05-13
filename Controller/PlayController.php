<?php


//  src/Victortestmaster/Poker/Controller/PlayController.php 
namespace App\Victortestmaster\Poker\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


//use App\Victortestmaster\Poker\Model\CardsModel;
use App\Victortestmaster\Poker\Helper\PokerHelper;
use App\Victortestmaster\Poker\Helper\DraftModel;


class PlayController extends Controller
{
    /**
     * @Route("/poker/play/", name="app_poker_play")
     */

private $session;


    public function __construct(SessionInterface $session)
    {
	//$this->cardsmodel  = new CardsModel($session);
	//$this->drafthelper  = new DraftHelper($session);
	$this->pokerhelper = new Pokerhelper($session);
        $this->session = $session;

	
    }

    public function Poker()
    {

     if($this->session->get('complete')== true) //If we reset the play
            {
                    session_destroy();
                    return $this->redirectToRoute('app_poker_number');
            }


	    $card =  (isset($_POST['card']))?$this->session->set('card', $_REQUEST['card']):$this->session->get('card');
            $response = $this->pokerhelper->start($card);
	    $row_cards = $this->session->get('saved_cards');
	    return $this->render('poker/poker.html.twig', ['drafted_card'   => $response["drafted_card"],
			    'result' => $row_cards,
			    'message'=> $response["message"],
			    'selected_card'=>$this->session->get('card')]);

    }


}



