<?php

namespace NotificationChannels\FacebookPoster;

class FacebookPosterLink
{
    /** @var string */
    private $url;

    public function __construct($link)
    {
        $this->url = $link;
    }
    public function getUrl()
    {
        return $this->url;
    }
}
