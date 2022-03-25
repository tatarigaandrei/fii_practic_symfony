<?php

namespace App\Transformer;

use App\Entity\Answer;

class AnswerTransformer
{

    public function transform(?Answer $answer): array {
        return [
            'text' => $answer?->getText(),
            'is_correct' => $answer->getIsCorrect(),
            'song_id' => $answer?->getSong()?->getId()
        ];
    }

    public function transformList(array $answers): array {
        $answersArray = [];
        foreach ($answers as $answer) {
            $answersArray[] = $this->transform($answer);
        }
        return $answersArray;
    }
}