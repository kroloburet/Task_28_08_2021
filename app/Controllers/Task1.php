<?php

namespace App\Controllers;

use Core\AbstractController;
use App\Models\Task1 as Model;

class Task1 extends AbstractController
{
    private Model $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function index()
    {
        $data = [
            'title' => 'Тестове завдання 1',
            'aside' => array_map(function ($item){
                $item['src'] = "/task_1/category/{$item['id']}";
                return $item;
            }, $this->model->getAside()),
        ];
        $this->view('task1/index', $data);
    }

    public function category(int $id)
    {
        $order = $_GET['order'] ?? "price";
        $products = $this->model->getCategoryProducts($id, $order);
        $data = [
            'title' => $products[0]['category_title'] ?? 'В розділі немає товарів',
            'category_id' => $id,
            'aside' => array_map(function ($item){
                $item['src'] = "/task_1/category/{$item['id']}";
                return $item;
            }, $this->model->getAside()),
            'products' => $products,
        ];
        $this->view('task1/category', $data);
    }
}