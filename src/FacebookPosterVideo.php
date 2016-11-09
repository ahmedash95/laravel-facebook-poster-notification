<?php

namespace NotificationChannels\FacebookPoster;

class FacebookPosterVideo
{
    /** @var array */
    private $data = [];

    /** @var string */
    private $path;

    /**
     * @var  string
     */
    private $apiEndpoint;

    public function __construct($videoPath,$endpoint)
    {
        $this->path        = $videoPath;
        $this->apiEndpoint = $endpoint;
    }

    public function setTitle($title)
    {
        $this->data['title'] = $title;
        return $this;
    }

    public function setDescription($description)
    {
        $this->data['description'] = $description;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getPath()
    {
        return $this->path;
    }
    
    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }
}
