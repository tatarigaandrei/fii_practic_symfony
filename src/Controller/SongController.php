<?php
namespace App\Controller;

use App\Handler\SongHandler;
use App\Transformer\SongTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/songs")
 */
class SongController extends AbstractController
{
    public function __construct(
        private SongHandler $songHandler,
        private SongTransformer $songTransformer
    )
    {
    }

    /**
     * @Route("", methods={"POST"})
     */
    public function createSong(Request $request)
    {
        $song = $this->songHandler->create($request->request->all());
        $songArray = $this->songTransformer->transform($song);
        return new JsonResponse($songArray, Response::HTTP_OK);

    }

}