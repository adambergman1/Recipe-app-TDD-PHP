<?php

class Recipe
{
    private $title;

    public function __construct(string $title)
    {
        $this->title = ucfirst($title);
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
