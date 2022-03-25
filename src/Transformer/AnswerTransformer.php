<?php

namespace App\Transformer;

use App\Entity\Answer;
use Doctrine\Common\Collections\Collection;

class AnswerTransformer
{

    public function transform(?Answer $answer): array {
        return [
            'id' => $answer?->getId(),
            'text' => $answer?->getText(),
            'is_correct' => $answer->isCorrect(),
            'song_id' => $answer?->getSong()?->getId()
        ];
    }

    public function transformList(mixed $answers): array {
        $answersArray = [];
        foreach ($answers as $answer) {
            $answersArray[] = $this->transform($answer);
        }
        return $answersArray;
    }
}