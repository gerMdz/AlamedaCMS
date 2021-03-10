<?php

namespace App\Service;


use App\Entity\Celebracion;
use App\Entity\Invitado;
use App\Entity\Reservante;
use App\Entity\User;
use App\Entity\WaitingList;
use App\Repository\WaitingListRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Twig\Environment;

class Mailer
{
    private $mailer;
    private $twig;
    private $waitingListRepository;


    /**
     * Mailer constructor.
     * @param MailerInterface $mailer
     * @param Environment $twig
     * @param WaitingListRepository $waitingListRepository
     */
    public function __construct(MailerInterface $mailer, Environment $twig, WaitingListRepository $waitingListRepository)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->waitingListRepository = $waitingListRepository;
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
            ->from(new Address('contacto@iglesiaalameda.com', 'Iglesia de La Alameda'))
            ->to(new Address($reservante->getEmail(), $reservante->getNombre()))
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

    /**
     * @param WaitingList $espera
     * @return TemplatedEmail
     * @throws TransportExceptionInterface
     */
    public function sendAvisoRegistroReservaMessage(WaitingList $espera): TemplatedEmail
    {
        $email = (new TemplatedEmail())
            ->from(new Address('contacto@iglesiaalameda.com', 'Iglesia de La Alameda'))
            ->to(new Address($espera->getEmail(), $espera->getNombre()))
            ->subject('Confirmación registro aviso de disponibilidad ')
            ->htmlTemplate('email/avisoRegistro.html.twig')
            ->context([
                // You can pass whatever data you want
                'espera' => $espera,
            ]);

        $this->mailer->send($email);

        return $email;
    }

    /**
     * @param Celebracion $celebracion
     * @return bool
     * @throws TransportExceptionInterface
     */
    public function sendAvisoLugarMessage(Celebracion $celebracion): bool
    {

        $esperan = $celebracion->getWaitingLists();

        foreach ($esperan as $espera) {

            $email = (new TemplatedEmail())
                ->from(new Address('contacto@iglesiaalameda.com', 'Iglesia de La Alameda'))
                ->to(new Address($espera->getEmail(), $espera->getNombre()))
                ->subject('Aviso de disponibilidad')
                ->htmlTemplate('email/avisoLugar.html.twig')
                ->context([
                    // You can pass whatever data you want
                    'espera' => $espera,
                    'celebracion' => $celebracion
                ]);

            $this->mailer->send($email);
            sleep(30);
        }

        return true;
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
            ->to(new Address($author->getEmail(), $author->getPrimerNombre()))
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
