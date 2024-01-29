<?php

namespace App\Controller;

use App\Entity\ChannelFeed;
use App\Form\ChannelFeedType;
use App\Repository\ChannelFeedRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin/channelfeed')]
class ChannelFeedController extends AbstractController
{
    #[Route(path: '/', name: 'channel_feed_index', methods: ['GET'])]
    public function index(ChannelFeedRepository $channelFeedRepository): Response
    {
        return $this->render('channel_feed/index.html.twig', [
            'channel_feeds' => $channelFeedRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'channel_feed_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $channelFeed = new ChannelFeed();
        $form = $this->createForm(ChannelFeedType::class, $channelFeed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($channelFeed);
            $entityManager->flush();

            return $this->redirectToRoute('channel_feed_index');
        }

        return $this->render('channel_feed/new.html.twig', [
            'channel_feed' => $channelFeed,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'channel_feed_show', methods: ['GET'])]
    public function show(ChannelFeed $channelFeed): Response
    {
        return $this->render('channel_feed/show.html.twig', [
            'channel_feed' => $channelFeed,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'channel_feed_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ChannelFeed $channelFeed, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChannelFeedType::class, $channelFeed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('channel_feed_index');
        }

        return $this->render('channel_feed/edit.html.twig', [
            'channel_feed' => $channelFeed,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'channel_feed_delete', methods: ['DELETE'])]
    public function delete(Request $request, ChannelFeed $channelFeed, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$channelFeed->getId(), $request->request->get('_token'))) {
            $entityManager->remove($channelFeed);
            $entityManager->flush();
        }

        return $this->redirectToRoute('channel_feed_index');
    }
}
