<?php

namespace App\Service;

use App\Entity\Commande;
use Twig\Environment;

class MailService
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * MailService constructor.
     *
     * @param Environment $twig
     * @param \Swift_Mailer $mailer
     */
    public function __construct(Environment $twig, \Swift_Mailer $mailer)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }

    public function envoieConfirmationCommande(Commande $commande)
    {
        $message = (new \Swift_Message('Confirmation de réservation - Louvre : '. $commande->getReference()))
            ->setFrom($commande->getClient()->getMail())
            ->setTo('analutzky@gmail.com')
            ->setBody(
                $this->twig->render(
                // templates/mail.html.twig
                    'louvre/mail.html.twig',
                    array('commande' => $commande)
                ),
                'text/html'
            )
        ;

        $this->mailer->send($message);
    }
}