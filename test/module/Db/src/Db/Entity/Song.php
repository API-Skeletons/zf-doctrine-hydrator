<?php

namespace Db\Entity;

class Song
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

    protected $album;

    public function getAlbum()
    {
        return $this->album;
    }

    public function setAlbum($value)
    {
        $this->album = $value;

        return $this;
    }
}
