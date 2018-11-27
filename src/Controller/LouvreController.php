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
use App\Form\FauxBilletType;

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
    public function billetterie(Request $request, ObjectManager $manager)
    {
        // if(!$commande){
            $commande = new Commande();
        // }
        
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);
        
        // dump($commande);
        if($form->isSubmitted() && $form->isValid()) {
            $commande = $form->getData();
            $manager->persist($commande);
            $manager->flush();

        return $this->redirectToRoute('recap', ['id' => $commande->getId()]);
        }
        
        return $this->render('louvre/billetterie.html.twig', [
            'controller_name' => 'LouvreController',
            'formCommande' => $form->createView(),
            // 'modifyMode' => $commande->getId() !== null 
        ]);
    }

    /**
     * @Route("/recapitulatif/{id}", name="recap")
     */
    public function recap(Request $request, ObjectManager $manager)
    {
        $repo = $this->getDoctrine()->getRepository(Commande::class);
        $commande = $repo->find($request->attributes->get('id'));

        foreach ($commande->getBillets() as $billet) {
            $now = new \DateTime();
            $age = $billet->getDateNaissance()->diff($now)->format('%y%');
            if ($billet->getTypeBillet() == 2) {
                $billet->setPrix(8);
            } elseif 
                ($billet->getTarifReduit() == 1) {
                $billet->setPrix(10);
            } elseif ($age > 60 ) {
                $billet->setPrix(12);
            } elseif (12 < $age && $age < 60) { 
                $billet->setPrix(16);
            } elseif (4 < $age && $age < 12) {
                $billet->setPrix(8);
            } elseif ($age < 4) {
                $billet->setPrix(0);
            }  
            $manager->persist($billet);
            $manager->flush();
        }
       
        return $this->render('louvre/recap.html.twig', [
            'controller_name' => 'LouvreController',
            'commande' => $commande,
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
            $this->addFlash("success","Le paiement a bien été effectué !");
            return $this->redirectToRoute("mail");
        	} 
        catch(\Stripe\Error\Card $e) {
            $this->addFlash("error","Le paiement n'est pas passé :(");
            return $this->redirectToRoute("mail");
            // The card has been declined
        }
    }

    /**
     * @Route("/confirmation", name="mail")
     */
    public function mail($commande, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Confirmation de réservation - Louvre'))
            ->setFrom('analutzky@gmail.com')
            ->setTo('analutzky@gmail.com')
            ->setBody(
                $this->renderView(
                    // templates/mail.html.twig
                    'mail.html.twig',
                    array('commande' => $commande)
                ),
                'text/html'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'mail.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;

        $mailer->send($message);

        return $this->render('louvre/bye.html.twig', [
            'controller_name' => 'LouvreController',
        ]);
    }

    /**
     * @Route("/merci", name="bye")
     */
    public function bye()
    {
        return $this->render('louvre/bye.html.twig', [
            'controller_name' => 'LouvreController',
        ]);
    }
}
