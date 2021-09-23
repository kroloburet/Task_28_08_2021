<?php

namespace App\Controllers;

use Core\AbstractController;

class Home extends AbstractController
{
    public function index()
    {
        $data = [
            'title' => 'Реалізація тестових завдань',
            'aside' => [
                [
                    'title' => 'Тестове завдання 1',
                    'src' => '/task_1',
                ],
                [
                    'title' => 'Тестове завдання 2',
                    'src' => '/task_2',
                ],
            ],
        ];
        $this->view('home', $data);
    }
}