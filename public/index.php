<?php

require '../core/bootstrap.php';

/**
 * Project routing
 */
$router = new Core\Router;
$router
    ->add('GET', '/', 'Home')
    ->add('GET', '/import_tables', 'ImportTables')
    ->add('GET', '/task_1', 'Task1')
    ->add('GET', '/task_1/category/(\d+)', 'Task1::category')
    ->add('GET', '/task_2', 'Task2')
    ->run();
