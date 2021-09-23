<?php

namespace Core;

use Core\DB;

abstract class AbstractModel
{
    public DB $db;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->db = DB::connect();
    }
}