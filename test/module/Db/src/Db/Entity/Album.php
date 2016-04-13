<?php

namespace Db\Entity;

class Album
{
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    protected $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($value)
    {
        $this->name = $value;

        return $this;
    }

    protected $artist;

    public function getArtist()
    {
        return $this->artist;
    }

    public function setArtist($value)
    {
        $this->artist = $value;

        return $this;
    }

    protected $song;

    public function getSong()
    {
        return $this->song;
    }

    public function addSong($song)
    {
        if ($song instanceof \Db\Entity\Song) {
            $this->song[] = $song;
        } elseif ($song instanceof ArrayCollection) {
            foreach ($song as $s) {
                if (! $s instanceof \Db\Entity\Song) {
                    throw new \Exception('Invalid type in addAlbum');
                }
                $this->song->add($s);
            }
        }

        return $this;
    }

    public function removeSong($song)
    {
        if ($song instanceof \Db\Entity\Song) {
            $this->song[] = $song;
        } elseif ($song instanceof ArrayCollection) {
            foreach ($song as $s) {
                if (! $s instanceof \Db\Entity\Song) {
                    throw new \Exception('Invalid type remove addSong');
                }
                $this->song->removeElement($s);
            }
        }
    }
}
