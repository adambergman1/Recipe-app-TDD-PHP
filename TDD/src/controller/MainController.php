<?php

require_once(__DIR__ . '/../view/MainView.php');

class MainController
{
    private $mainView;

    public function __construct()
    {
        $this->mainView = new MainView();
    }

    public function run()
    {
        return $this->mainView->render();
    }
}
