<?php

namespace App\Models;

use Core\AbstractModel;

class ImportTables extends AbstractModel
{
    public function run(): array
    {
        $result = [
            'ok' => false,
            'msg' => 'Помилка! Не вдалося створити таблиці.'
        ];

        $test_sql = ROOT_PATH . '/public/source/test.sql';

        if (!file_exists($test_sql)) {
            $result['msg'] = "Помилка! Файла $test_sql не існує.";
            return $result;
        }

        if ($this->db::query("SHOW TABLES FROM test")->fetchAll()) {
            $result['ok'] = true;
            $result['msg'] = 'Таблиці вже існують в базі!';
            return $result;
        }

        try {
            $this->db::query(file_get_contents($test_sql));
            $result['ok'] = true;
            $result['msg'] = 'Таблиці успішно створено!';
            return $result;
        } catch (\PDOException $e) {
            $result['msg'] .= "<hr>$e";
            return $result;
        }
    }
}