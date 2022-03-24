<?php

namespace App\Handler;

use App\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;

class SongHandler
{

    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }


    public function create(array $parameters): Song {
        $song = new Song();
        $song->setVideoId($parameters['video_id']);
        $song->setStart($parameters['start']);
        $song->setEnd($parameters['end']);

        $this->entityManager->persist($song);
        $this->entityManager->flush();

        return $song;
    }

    public function update(Song $song, $parameters): Song {
        $song->setVideoId($parameters['video_id']);
        $song->setStart($parameters['start']);
        $song->setEnd($parameters['end']);

        $this->entityManager->persist($song);
        $this->entityManager->flush();

        return $song;
    }

    public function delete (Song $song) {
        $this->entityManager->remove($song);
        $this->entityManager->flush();
    }


}
