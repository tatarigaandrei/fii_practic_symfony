<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ResponseListener
{
    public function onKernelResponse(ResponseEvent $event)
    {
        if (!$event->isMainRequest()) {
            // don't do anything if it's not the main request
            return;
        }

        $response = $event->getResponse();

        // Set multiple headers simultaneously
//        $response->headers->add([
//            'Access-Control-Allow-Origin' => 'http://localhost:3000/',
//            'Access-Control-Allow-Methods' => 'GET, POST, PUT, PATCH, POST, DELETE, OPTIONS',
//            'Access-Control-Allow-Headers' => 'Content-Type',
//        ]);

        // Or set a single header
//        $response->headers->set("Example-Header", "ExampleValue");
    }
}