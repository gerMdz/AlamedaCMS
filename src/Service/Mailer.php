<?php

namespace App\Service;


use App\Entity\Invitado;
use App\Entity\Reservante;
use App\Repository\InvitadoRepository;
use App\Repository\ReservanteRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\NamedAddress;
use Twig\Environment;

class Mailer
{
    private $mailer;
    private $twig;


    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @param Reservante $reservante
     * @param null|int $invitados
     * @return TemplatedEmail
     * @throws TransportExceptionInterface
     */
    public function sendReservaMessage(Reservante $reservante, ?int $invitados): TemplatedEmail
    {
        $email = (new TemplatedEmail())
            ->from('contacto@iglesiaalameda.com')
            ->to($reservante->getEmail())
            ->subject('Confirmación de reserva')
            ->htmlTemplate('email/reserva.html.twig')
            ->context([
                // You can pass whatever data you want
                'reservante' => $reservante,
                'invitados' => $invitados
            ]);

        $this->mailer->send($email);

        return $email;
    }

    public function sendReservaInvitadoMessage(Invitado $reservante): TemplatedEmail
    {
        $email = (new TemplatedEmail())
            ->from('contacto@iglesiaalameda.com')
            ->to($reservante->getEmail())
            ->subject('Confirmación de reserva')
            ->htmlTemplate('email/reserva_invitado.html.twig')
            ->context([
                // You can pass whatever data you want
                'reservante' => $reservante,
            ]);

        $this->mailer->send($email);

        return $email;
    }

    public function sendAuthorWeeklyReportMessage(User $author, array $articles): TemplatedEmail
    {
        $html = $this->twig->render('email/author-weekly-report-pdf.html.twig', [
            'articles' => $articles,
        ]);
        $this->entrypointLookup->reset();
        $pdf = $this->pdf->getOutputFromHtml($html);

        $email = (new TemplatedEmail())
            ->to(new NamedAddress($author->getEmail(), $author->getFirstName()))
            ->subject('Your weekly report on the Space Bar!')
            ->htmlTemplate('email/author-weekly-report.html.twig')
            ->context([
                'author' => $author,
                'articles' => $articles,
            ])
            ->attach($pdf, sprintf('weekly-report-%s.pdf', date('Y-m-d')));

        $this->mailer->send($email);

        return $email;
    }
}
