<?php

namespace App\Rss;

use App\Entity\ChannelFeed;

class Xml
{
    public static function generate(ChannelFeed $channelFeed, string $site_podcasts): string
    {
        $title = self::xmlEscape($channelFeed->getTitle());
        $link = self::xmlEscape($channelFeed->getLink());
        $descripcion = self::xmlEscape($channelFeed->getDescripcion());
        $owner = self::xmlEscape($channelFeed->getOwner());
        $autor = self::xmlEscape($channelFeed->getAutor());

        $xml = <<<xml
<?xml version='1.0' encoding='UTF-8'?>
<rss version='2.0' xmlns:googleplay="http://www.google.com/schemas/play-podcasts/1.0"  xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd">

<channel>
    <title>{$title}</title>
    <googleplay:owner>{$owner}</googleplay:owner>
    <googleplay:author>{$autor}</googleplay:author>
    <description>{$descripcion}</description>
    <language>es-ar</language>
    <link>{$link}</link>
xml;
        foreach ($channelFeed->getItem() as $post) {
            $titleItem = self::xmlEscape($post->getTitle());
            $descripcionItem = self::xmlEscape($post->getDescripcion());
            $url = $site_podcasts.'/'.self::xmlEscape($post->getLinkUrl());
            $type = self::xmlEscape($post->getLinkType());
            $longitud = self::xmlEscape($post->getLinkLongitud());
            $duration = $post->getDuracion()->format('H:i:s');
            $pubDate = $post->getPubDateAt()->format('D, d M Y H:i:s T');
            $guid = self::xmlEscape($post->getGuid());
            $xml .= <<<xml
<item>
<title>{$titleItem}</title>
<description>{$descripcionItem}</description>
<pubDate>{$pubDate}</pubDate>
<enclosure url="{$url}" type="{$type}" length="{$longitud}"/>
<itunes:duration>{$duration}</itunes:duration>
<guid >{$guid}</guid>
</item>
xml;
        }
        $xml .= '</channel></rss>';

        return $xml;
    }

    private static function xmlEscape($string)
    {
        return str_replace(['&', '<', '>', '\'', '"'], ['&amp;', '&lt;', '&gt;', '&apos;', '&quot;'], (string) $string);
    }
}
