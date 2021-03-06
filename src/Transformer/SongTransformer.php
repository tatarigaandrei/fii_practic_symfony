<?php

namespace App\Transformer;

use App\Entity\Song;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class SongTransformer implements DataTransformerInterface
{

    public function __construct(private AnswerTransformer $answerTransformer)
    {
    }

    public function transform(mixed $value)
    {

        $song = $value instanceof Song ? $value : new Song();

        return [
            'id' => $song->getId(),
            'video_id' => $song->getVideoId(),
            'start' => $song->getStart(),
            'end' => $song->getEnd(),
            'answers' => $this->generateAnswersArray($song?->getAnswers())
        ];
    }

    public function transformList(array $collection): array
    {
        $results = [];
        foreach ($collection as $item) {
            $results[] = $this->transform($item);
        }
        return $results;
    }

    public function generateAnswersArray(mixed $answers): array
    {
        return $this->answerTransformer->transformList($answers);
    }

    public function reverseTransform(mixed $value)
    {
        // TODO: Implement reverseTransform() method.
    }
}