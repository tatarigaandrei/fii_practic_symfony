<?php

namespace App\Controller;

use App\Entity\Song;
use App\Handler\SongHandler;
use App\Repository\SongRepository;
use App\Transformer\SongTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/song")
 */
class SongController extends AbstractController
{
    public function __construct(
        private SongHandler     $songHandler,
        private SongTransformer $songTransformer,
        private SongRepository $songRepository
    )
    {}

    /**
     * @Route("", methods={"GET"})
     */
    public function getAllSongs(): JsonResponse
    {
        $songs = $this->songRepository->findAll();
        $songArray = $this->songTransformer->transformList($songs);
        return new JsonResponse($songArray, Response::HTTP_OK);

    }

    /**
     * @Route("", methods={"POST"})
     */
    public function createSong(Request $request): JsonResponse
    {
        $song = $this->songHandler->create($request->request->all());
        $songArray = $this->songTransformer->transform($song);
        return new JsonResponse($songArray, Response::HTTP_CREATED);

    }

    /**
     * @Route("/{songId}", methods={"PATCH"})
     * @ParamConverter("song", options={"id" = "songId"})
     */
    public function updateSong(Request $request, Song $song): JsonResponse
    {
        $song = $this->songHandler->update($song, $request->request->all());
        $songArray = $this->songTransformer->transform($song);
        return new JsonResponse($songArray, Response::HTTP_OK);

    }

    /**
     * @Route("/{songId}", methods={"DELETE"})
     * @ParamConverter("song", options={"id" = "songId"})
     */
    public function deleteSong(Song $song): JsonResponse
    {
        $this->songHandler->delete($song);
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

}