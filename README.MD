# FacebookPoster Notification Channel For Laravel 5.3

This package makes it easly to post on facebook using FacebookPoster Notification with Laravel 5.3

## Contents

- [Installation](#installation)
- [Setting up the Facebook service](#setting-up-the-facebook-service)
- [Usage](#usage)
	- [Publish Facebook post](#publish-facebook-post)
	- [Publish Facebook post with link](#publish-facebook-post-with-link)
	- [Publish Facebook post with image](#publish-facebook-post-with-image)
	- [Publish Facebook post with video](#publish-facebook-post-with-video)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install this package via composer:

``` bash
composer require laravel-notification-channels/facebook-poster
```

Next add the service provider to your `config/app.php`:

```php
...
'providers' => [
	...
	 NotificationChannels\FacebookPoster\FacebookPosterServiceProvider::class,
],
...
```

### Setting up the Facebook Poster service

You will need to [create](https://developers.facebook.com/apps/) a Facebook app in order to use this channel. Within in this app you will find the `APP Id and APP Secret Key`. Place them inside your `.env` file. In order to load them, add this to your `config/services.php` file:

```php
...
'facebook_poster' => [
	'app_id'    => getenv('FACEBOOK_APP_ID'),
	'app_secret' => getenv('FACEBOOK_APP_SECRET'),
	'access_token'    => getenv('FACEBOOK_ACCESS_TOKEN'),
]
...
```

This will load the Facebook app data from the `.env` file. Make sure to use the same keys you have used there like `FACEBOOK_APP_ID`.

## Usage

Follow Laravel's [documentation](https://laravel.com/docs/master/notifications) to add the channel to your Notification class.

### Publish FACEBOOK post

```php
use NotificationChannels\FacebookPoster\FacebookPosterChannel;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

class NewsWasPublished extends Notification
{

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FacebookPosterChannel::class];
    }

    public function toFacebookPoster($notifiable) {
        return new FacebookPosterPost('Laravel notifications are awesome!');
    }
}
```

Take a closer look at the `FacebookPosterPost` object. This is where the magic happens.

````php
public function toFacebookPoster($notifiable) {
    return new FacebookPosterPost('Laravel notifications are awesome!');
}
````

### Publish Facebook post with link
It is possible to publish link with your post too. You just have to pass the url to the ``` withLink ``` method.
````php
public function toFacebookPoster($notifiable) {
    return (new FacebookPosterPost('Laravel notifications are awesom!'))->withLink('https://laravel.com');
}
````

### Publish Facebook post with image
It is possible to publish image with your post too. You just have to pass the image path to the ``` withImage ``` method.
````php
public function toFacebookPoster($notifiable) {
    return (new FacebookPosterPost('Laravel notifications are awesom!'))->withImage('tayee.png');
}
````

**Notice** : withImage accepts absolute url not system paths like ``` /home/user/downloads/image.png ```



### Publish Facebook post with video
It is also possible to publish video with your post too. You just have to pass the video path to the ``` withVideo ``` method.
````php
public function toFacebookPoster($notifiable) {
    return (new FacebookPosterPost('Laravel notifications are awesom!'))
    	->withVideo('bedaer.mp4',[ 'title' => 'My First Video' , 'Description' => 'published by FacebookPoster.' ]);
}
````


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email ahmed29329@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Ahmed Ashraf](https://github.com/ahmedash95)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.