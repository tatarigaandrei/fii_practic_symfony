<?php
namespace App\EventListener;

use App\Exception\InvalidFormException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getThrowable();

        if ($exception instanceof InvalidFormException) {
            $response = new JsonResponse($exception->getErrors(), Response::HTTP_BAD_REQUEST);
            $event->setResponse($response);
        }
    }
}
