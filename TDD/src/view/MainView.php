<?php

class MainView
{
    public function generateMainTitle()
    {
        return '<h1>My Cook Book</h1>';
    }

    public function render()
    {
        return $this->generateMainTitle();
    }
}
