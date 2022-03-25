<?php

namespace App\Handler;

use App\Entity\Answer;
use App\Exception\InvalidFormException;
use App\Form\AnswerFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;

class AnswerHandler
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private FormFactoryInterface $formFactory
    )
    {}

    /**
     * @throws InvalidFormException
     */
    public function createList(array $answersArray): array
    {
        $answers = [];
        foreach ($answersArray as $answerArrayItem) {
            $form = $this->formFactory->create(AnswerFormType::class, new Answer());
            $form->submit($answerArrayItem);
            if(!$form->isValid()) {
                throw new InvalidFormException($form);
            }

            $answer = $form->getData();
            $this->entityManager->persist($answer);
            $answers[] = $answer;
        }

        $this->entityManager->flush();

        return $answers;
    }

    /**
     * @throws InvalidFormException
     */
    public function create(array $parameters)
    {
        $form = $this->formFactory->create(AnswerFormType::class, new Answer());
        $form->submit($parameters);
        if(!$form->isValid()) {
            throw new InvalidFormException($form);
        }

        $answer = $form->getData();

        $this->entityManager->persist($answer);
        $this->entityManager->flush();

        return $answer;
    }

    /**
     * @throws InvalidFormException
     */
    public function update(Answer $answer,  $parameters)
    {
        $form = $this->formFactory->create(AnswerFormType::class, $answer);
        $form->submit($parameters, false);
        if(!$form->isValid()) {
            throw new InvalidFormException($form);
        }

        $answer = $form->getData();

        $this->entityManager->persist($answer);
        $this->entityManager->flush();

        return $answer;
    }

    public function delete(Answer $answer)
    {
        $this->entityManager->remove($answer);
        $this->entityManager->flush();
    }

}