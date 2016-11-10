<?php

namespace NotificationChannels\FacebookPoster;

use Facebook\Facebook;
use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\Attaches\Video;

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
        if (isset($postBody['media'])) {
        	
            $endpoint = $postBody['media']->getApiEndpoint();

            if($postBody['media'] instanceof Video)
            {
                $postBody = array_merge($postBody,$postBody['media']->getData());
            }
        	
            $postBody['source'] = $this->facebook->fileToUpload($postBody['media']->getPath());
        	unset($postBody['media']);

        }

        $this->facebook->post($endpoint, $postBody);
    }
}
