<?php

namespace NotificationChannels\FacebookPoster;

use Facebook\Facebook;
use Illuminate\Notifications\Notification;

class FacebookPosterChannel
{

    /** @var \Facebook\Facebook */
    protected $facebook;

    /**
     * @param \Facebook\Facebook $facebook
     */
    public function __construct(Facebook $facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     */
    public function send($notifiable, Notification $notification)
    {
        $facebookMessage = $notification->toFacebookPoster($notifiable);

        $postBody = $facebookMessage->getPostBody();

        $endpoint = $facebookMessage->getApiEndpoint();

        // here we check if post body has image or video then we will upload it first to facebook
        if (isset($postBody['image'])) {
        	$endpoint = $postBody['image']->getApiEndpoint();
        	$postBody['source'] = $this->facebook->fileToUpload($postBody['image']->getPath());
        	unset($postBody['image']);
        }

        if (isset($postBody['video'])) {
        	$endpoint = $postBody['video']->getApiEndpoint();
        	$postBody = array_merge($postBody,$postBody['video']->getData());
        	$postBody['source'] = $this->facebook->fileToUpload($postBody['video']->getPath());
        	unset($postBody['video']);
        }

        $this->facebook->post($endpoint, $postBody);
    }
}
