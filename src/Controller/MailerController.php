<?php

// src/Controller/MailerController.php
namespace App\Controller;

use App\Entity\Invitado;
use App\Entity\Reservante;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;

class MailerController extends AbstractController
{
    /**
     * @Route("/email/{id}", name="envia_mail" )
     * @param MailerInterface $mailer
     * @param Reservante $reservante
     * @return RedirectResponse
     * @throws TransportExceptionInterface
     */
    public function sendEmail(MailerInterface $mailer, Reservante $reservante)
    {

        $email = $reservante->getEmail();
        $celebracion = $reservante->getCelebracion();

        $email = (new TemplatedEmail())
            ->from('contacto@iglesiaalameda.com')
            ->to($email)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Tu reserva fue realizada')
            ->text('Gracias por reservar')
            ->htmlTemplate('email/reserva.html.twig')
//            ->html('<p>WOW!! Volvemos a estar juntos</p>');

            ->context([
                'reservante' => $reservante,
            ]); // ; final de email

        $mailer->send($email);

        $this->addFlash('success', 'Se ha guardado su reserva');
        return $this->redirectToRoute('vista_reserva', [
            'celebracion' => $reservante->getCelebracion()->getId(),
            'email' => $reservante->getEmail()
        ]);
    }

    /**
     * @Route("/email_invitado/{id}", name="envia_mail_invitado" )
     * @param MailerInterface $mailer
     * @param Invitado $reservante
     * @return RedirectResponse
     * @throws TransportExceptionInterface
     */
    public function sendEmailInvitado(MailerInterface $mailer, Invitado $reservante)
    {
        $email = $reservante->getEmail();
        $celebracion = $reservante->getCelebracion();

        $email = (new TemplatedEmail())
            ->from('contacto@iglesiaalameda.com')
            ->to($email)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Tu reserva fue realizada')
            ->text('Gracias por reservar')
            ->htmlTemplate('email/reserva_invitado.html.twig')
//            ->html('<p>WOW!! Volvemos a estar juntos</p>');

            ->context([
                'reservante' => $reservante,
            ]); // ; final de email

        $mailer->send($email);

        $this->addFlash('success', 'Se ha guardado su reserva');
        return $this->redirectToRoute('vista_reserva', [
            'celebracion' => $reservante->getCelebracion()->getId(),
            'email' => $reservante->getEmail()
        ]);
    }
}
