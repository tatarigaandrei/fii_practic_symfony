<?php

namespace App\Handler;

use App\Entity\Song;
use App\Exception\InvalidFormException;
use App\Exception\ValidationException;
use App\Form\SongFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class SongHandler
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private FormFactoryInterface $formFactory
    )
    {
    }


    /**
     * @throws InvalidFormException
     */
    public function create(array $parameters): Song {

        $form = $this->formFactory->create(SongFormType::class, new Song());
        $form->submit($parameters);
        if(!$form->isValid()) {
            throw new InvalidFormException($form);
        }
        $song = $form->getData();

        $this->entityManager->persist($song);
        $this->entityManager->flush();

        return $song;
    }

    /**
     * @throws InvalidFormException
     */
    public function update(Song $song, $parameters): Song {
        $form = $this->formFactory->create(SongFormType::class, $song);
        $form->submit($parameters, false);
        if(!$form->isValid()) {
            throw new InvalidFormException($form);
        }
        $song = $form->getData();

        $this->entityManager->persist($song);
        $this->entityManager->flush();

        return $song;
    }

    public function delete (Song $song) {
        $this->entityManager->remove($song);
        $this->entityManager->flush();
    }


}
