<?php

namespace App\Controller;

use App\Repository\ChannelFeedRepository;
use App\Rss\Xml;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RSSController extends AbstractController
{
    /**
     * @var string
     */
    private $site_podcasts;

    /**
     * RSSController constructor.
     * @param string $site_podcasts
     */
    public function __construct(string $site_podcasts)
    {
        $this->site_podcasts = $site_podcasts;
    }

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
        $response->setContent(Xml::generate($channels, $this->site_podcasts));
        return $response;
    }
}
