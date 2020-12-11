<?php

namespace App\Controller;

use App\Entity\ChannelFeed;
use App\Repository\ChannelFeedRepository;
use App\Rss\Xml;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RSSController extends AbstractController
{
    /**
     * @Route("/rss", name="rss-feed")
     * @param ChannelFeedRepository $channelFeedRepository
     * @return Response
     */
    public function rss(ChannelFeedRepository $channelFeedRepository): Response
    {

        $channels = $channelFeedRepository->findFirst();

        $response = new Response();
        $response->headers->set("Content-type", "text/xml");
        $response->setContent(Xml::generate($channels));
        return $response;
    }
}
