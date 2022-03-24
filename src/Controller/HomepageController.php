<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController
{
   /**
    * @Route("/test")
    */
    public function testAction() {
        return new Response('Salut!');
    }

}