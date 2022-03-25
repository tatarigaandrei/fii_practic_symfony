<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Exception\InvalidFormException;
use App\Handler\AnswerHandler;
use App\Repository\AnswerRepository;
use App\Transformer\AnswerTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/answer")
 */
class AnswerController extends AbstractController
{

    public function __construct(
        private AnswerHandler     $answerHandler,
        private AnswerTransformer $answerTransformer,
        private AnswerRepository  $answerRepository
    )
    {}

    /**
     * @return JsonResponse
     * @Route("", methods={"GET"})
     */
    public function getAllAnswers(): JsonResponse
    {
        $answers = $this->answerRepository->findAll();
        $answersArray = $this->answerTransformer->transformList($answers);
        return new JsonResponse($answersArray, Response::HTTP_OK);
    }

    /**
     * @param Answer $answer
     * @return JsonResponse
     * @Route("/{answerId}", methods={"GET"})
     * @ParamConverter("answer", options={"id" = "answerId"})
     */
    public function getAnswer(Answer $answer): JsonResponse
    {
        $answerArray = $this->answerTransformer->transform($answer);
        return new JsonResponse($answerArray, Response::HTTP_OK);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws InvalidFormException
     * @Route("/list", methods={"POST"})
     */
    public function createAnswers(Request $request): JsonResponse
    {
        $answers = $this->answerHandler->createList($request->request->all());
        $answersArray = $this->answerTransformer->transformList($answers);
        return new JsonResponse($answersArray, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws InvalidFormException
     * @Route("", methods={"POST"})
     */
    public function createAnswer(Request $request): JsonResponse
    {
        $answer = $this->answerHandler->create($request->request->all());
        $answerArray = $this->answerTransformer->transform($answer);
        return new JsonResponse($answerArray, Response::HTTP_OK);
    }


    /**
     * @param Request $request
     * @param Answer $answer
     * @return JsonResponse
     * @Route("/{answerId}", methods={"PATCH"})
     * @ParamConverter("answer", options={"id" = "answerId"})
     * @throws InvalidFormException
     */
    public function updateAnswer(Request $request, Answer $answer): JsonResponse
    {
        $answer = $this->answerHandler->update($answer, $request->request->all());
        $answerArray = $this->answerTransformer->transform($answer);
        return new JsonResponse($answerArray, Response::HTTP_OK);
    }

    /**
     * @param Answer $answer
     * @return JsonResponse
     * @Route("/{answerId}", methods={"DELETE"})
     * @ParamConverter("answer", options={"id" = "answerId"})
     */
    public function deleteAnswer(Answer $answer): JsonResponse
    {
        $this->answerHandler->delete($answer);
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
}