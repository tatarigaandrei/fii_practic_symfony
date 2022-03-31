<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Song;
use App\Repository\SongRepository;
use App\Transformer\SongTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/game")
 */
class GameController extends AbstractController
{

    public function __construct(
        private SongRepository $songRepository,
        private SongTransformer $songTransformer
    )
    {
    }

    /**
     * @Route("/songs", methods={"GET"})
     */
    public function getSongs(): JsonResponse
    {
        $songs = $this->songRepository->findSongsWithAnswers();
        $songsArray = $this->songTransformer->transformList($songs);
        return new JsonResponse($songsArray, Response::HTTP_OK);
    }

    /**
     * @param Song $song
     * @param Answer $answer
     * @return JsonResponse
     * @Route("/verify/{songId}/{answerId}")
     * @ParamConverter("song", options={"id" = "songId"})
     * @ParamConverter("answer", options={"id" = "answerId"})
     */
    public function verifyAnswer(Song $song, Answer $answer)
    {
        return new JsonResponse($song->checkAnswer($answer), Response::HTTP_OK);
    }

}