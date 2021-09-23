<?php

namespace App\Controllers;

use Core\AbstractController;

class Errors extends AbstractController
{
    public function error404()
    {
        header("HTTP/1.1 404 Not Found");
        $path = $_SERVER['HTTP_HOST'] . URI_PATH;
        $data = [
            'title' => 'Error 404!',
            'msg' => "Page <q>$path</q> not found..(",
            'go_back' => '&larr; Go back',
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
        $this->view('errors/error404', $data);
    }
}