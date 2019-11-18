<?php

require_once(__DIR__ . '/../view/MainView.php');

class MainController
{
    private $mainView;

    public function run()
    {
        $this->mainView = new MainView();
        return $this->mainView->render();
    }
}
