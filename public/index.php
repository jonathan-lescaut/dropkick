<?php


use App\Kernel;
use Wohali\OAuth2\Client\Provider\Discord;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
