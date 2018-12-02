<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Billet;
use App\Entity\Commande;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\CommandeType;
use App\Service\CommandeManager;

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
    public function billetterie(Request $request, CommandeManager $commande_manager)
    {
        // if(!$commande){
            // $commande = new Commande();
        // }

        $commande = $commande_manager->getCommande();
        
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);
        
        // dump($commande);
        if($form->isSubmitted() && $form->isValid()) {
            $commande_manager->computePrice($form->getData());
            $commande_manager->save();

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
    public function recap(Request $request, CommandeManager $commande_manager)
    {
        $commande = $commande_manager->getCommande($request->attributes->get('id'));
       
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
     *     "/checkout/{id}",
     *     name="order_checkout",
     *     methods="POST"
     * )
     */ 
    public function checkoutAction(Request $request, CommandeManager $commande_manager)
    {
        $commande_manager->getCommande($request->attributes->get('id'));
        if($commande_manager->paiement()) {
            return $this->redirectToRoute("mail",  array('id' => $commande->getId()));
        } else {
            $this->addFlash("error","Le paiement n'est pas passé :(");
            return $this->redirectToRoute("recap, array('id' => $commande->getId())");
        };
    }

    /**
     * @Route("/confirmation/{id}", name="mail")
     */
    public function mail(Request $request, \Swift_Mailer $mailer)
    {
        $repo = $this->getDoctrine()->getRepository(Commande::class);
        $commande = $repo->find($request->attributes->get('id'));

        $message = (new \Swift_Message('Confirmation de réservation - Louvre'))
            ->setFrom('analutzky@gmail.com')
            ->setTo('analutzky@gmail.com')
            ->setBody(
                $this->renderView(
                    // templates/mail.html.twig
                    'louvre/mail.html.twig',
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
