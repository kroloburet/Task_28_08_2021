<?php

namespace App\Controllers;

use Core\AbstractController;
use Core\Helper;
use App\Models\Task2 as Model;

class Task2 extends AbstractController
{
    private Model $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function index()
    {
        $task2_unsort = Helper::timer(function () {
            return $this->model->getTask2UnsortCategories();
        });
        $task2_sort = Helper::timer(function () {
            return $this->model->getTask2SortCategories();
        });
        $data = [
            'title' => 'Сортування виборки з бази данних',
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
            'task2_unsort' =>
                [
                    'data' => $task2_unsort['data'],
                    'time' => $task2_unsort['time'],
                ],
            'task2_sort' =>
                [
                    'data' => $task2_sort['data'],
                    'time' => $task2_sort['time'],
                ],
        ];
        $this->view('task2/index', $data);
    }
}
