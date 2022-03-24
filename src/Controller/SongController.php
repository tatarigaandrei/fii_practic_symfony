<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/songs")
 */
class SongController
{

    /**
     * @Route("", methods={"POST"})
     */
    public function createSong(Request $request)
    {
//        dd($request->getContent());
//        dd($request->request->all());
    }

}