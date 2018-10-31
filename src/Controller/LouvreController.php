<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LouvreController extends AbstractController
{
    /**
     * @Route("/louvre", name="louvre")
     */
    public function index()
    {
        return $this->render('louvre/index.html.twig', [
            'controller_name' => 'LouvreController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('louvre/home.html.twig', [
            'controller_name' => 'LouvreController',
        ]);
    }

    /**
     * @Route("/billetterie", name="billetterie")
     */
    public function billetterie()
    {
        return $this->render('louvre/billetterie.html.twig', [
            'controller_name' => 'LouvreController',
        ]);
    }

    /**
     * @Route("/recapitulatif", name="recap")
     */
    public function recap()
    {
        return $this->render('louvre/recap.html.twig', [
            'controller_name' => 'LouvreController',
        ]);
    }

    /**
     * @Route(
     *     "/checkout",
     *     name="order_checkout",
     *     methods="POST"
     * )
     */

    public function checkoutAction()
    {
        \Stripe\Stripe::setApiKey("pk_test_DMiADShJSyoZEBEHabm71UC1
");
        // Get the credit card details submitted by the form
        $token = $_POST['stripeToken'];
        // Create a charge: this will charge the user's card
        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => 1000, // Amount in cents
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement Stripe - OpenClassrooms Exemple"
            ));
            $this->addFlash("success","Bravo ça marche !");
            return $this->redirectToRoute("recap");
        	} 
        catch(\Stripe\Error\Card $e) {
            $this->addFlash("error","Snif ça marche pas :(");
            return $this->redirectToRoute("recap");
            // The card has been declined
        }
    }

    /**
     * @Route("/infospratiques", name="infospratiques")
     */
    public function infosPratiques()
    {
        return $this->render('louvre/infosPratiques.html.twig', [
            'controller_name' => 'LouvreController',
        ]);
    }
}
