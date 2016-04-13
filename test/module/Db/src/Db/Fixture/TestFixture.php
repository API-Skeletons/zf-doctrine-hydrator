<?php

namespace Db\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Db\Entity;

class TestFixture implements
    FixtureInterface
{
    public function load(ObjectManager $objectManager)
    {
        $artist = new Entity\Artist();
        $artist->setName('Soft Cell');
        $objectManager->persist($artist);

        $album = new Entity\Album();
        $album->setName('Non-Stop Erotic Cabaret');
        $album->setArtist($artist);
        $artist->addAlbum($album);
        $objectManager->persist($album);

        $song = new Entity\Song();
        $song->setName('Tainted Love');
        $song->setAlbum($album);
        $album->addSong($song);
        $objectManager->persist($song);

        $objectManager->flush();
    }
}
