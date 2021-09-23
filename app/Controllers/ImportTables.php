<?php

namespace App\Controllers;

use App\Models\ImportTables as Import;
use Core\AbstractController;

class ImportTables extends AbstractController
{
    public function index()
    {
        $data = (new Import)->run();
        $data['title'] = 'Створення таблиць бази данних "test"';
        $this->view('import_tables', $data);
    }

}