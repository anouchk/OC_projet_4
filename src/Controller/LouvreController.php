<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Billet;
use App\Entity\Commande;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\CommandeType;
use App\Form\BilletType;

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

    // il faudra que je rajoute * @Route("/recap/{id}/modify, name="modification_commande")
    /**
     * @Route("/billetterie", name="billetterie")
     */
    public function billetterie(Commande $commande=null, Billet $billet=null, Request $request, ObjectManager $manager)
    {
        if(!$commande){
            $commande = new Commande();
        }
               
        // $form = $this->createFormBuilder($commande)
        //                     ->add('dateVisite')
        //                     ->getForm();
        $form = $this->createForm(CommandeType::class, $commande);

        if(!$billet){
            $billet = new Billet();
        }
        
        // $form_billet = $this->createFormBuilder($billet)
        //                     ->add('nom')
        //                     ->add('prenom')
        //                     ->add('typeBillet')
        //                     ->add('pays', CountryType::class)
        //                     ->add('dateNaissance')
        //                     ->add('tarifReduit')
        //                     ->getForm();
        $form_billet = $this->createForm(BilletType::class, $billet);

        $form->handleRequest($request);

        dump($billet);
        // if($form->isSubmited() && $fom->isValid()) {
        //     if(!$commande->getId()) {
        //          $commande->setReference('ER34TY');
        //     }
        //     $manager->persist($commande);
        //     $manager->persist($billet);
        //     $manager->flush;

        //     return $this->redirectToRoute('recap', ['id' => $commande->getId()])
        // }

        
        return $this->render('louvre/billetterie.html.twig', [
            'controller_name' => 'LouvreController',
            'formCommande' => $form->createView(),
            'formBillet' => $form_billet->createView(),
            'modifyMode' => $commande->getId() !== null 
        ]);
    }

    // là il faudra que je fasse @Route("/recapitulatif/{id}", name="recap")
    /**
     * @Route("/recapitulatif/", name="recap")
     */
    public function recap()
    {
        $repo = $this->getDoctrine()->getRepository(Billet::class);
        // là il faudrait que je fasse find by id_commande
        $billets = $repo->findAll();
        return $this->render('louvre/recap.html.twig', [
            'controller_name' => 'LouvreController',
            'billets' => $billets
        ]);
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

    /**
     * @Route(
     *     "/checkout",
     *     name="order_checkout",
     *     methods="POST"
     * )
     */

    public function checkoutAction()
    {
        \Stripe\Stripe::setApiKey("sk_test_aXFr9emkHBkD35pC6kAvXLi7");
        // Get the credit card details submitted by the form
        $token = $_POST['stripeToken'];
        // Create a charge: this will charge the user's card
        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => 1000, // Amount in cents
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement Stripe - Réservations Louvre"
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
}
