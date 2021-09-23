<?php

namespace App\Models;

use Core\AbstractModel;

class Task2 extends AbstractModel
{
    /**
     * Get all categories from database
     *
     * @return array
     */
    public function getTask2UnsortCategories(): array
    {
        return $this->db::getRows("SELECT * FROM `task_2_categories`");
    }

    /**
     * Get tree categories from database
     *
     * @return array
     */
    public function getTask2SortCategories(): array
    {
        return $this->makeTreeReferenceMethod($this->getTask2UnsortCategories());
    }

    /**
     * Build tree categories (recursive method)
     *
     * @param array $input Categories from database
     * @param int $pid Category parent id
     * @return array
     */
    private function makeTreeRecursiveMethod(array $input, int $pid = 0): array
    {
        $tree = [];
        foreach ($input as $k => $v) {
            if ($v['parent_id'] == $pid) {
                $tmp = $this->makeTreeRecursiveMethod($input, $v['categories_id']);
                $tree[$v['categories_id']] = count($tmp) ? $tmp : $v['categories_id'];
                unset($input[$k]);
            }
        }
        return $tree;
    }

    /**
     * Build tree categories (reference method)
     *
     * @param array $input Categories from database
     * @return array
     */
    private function makeTreeReferenceMethod(array $input): array
    {
        $tree = [];
        $tmp = [0 => &$tree];
        foreach ($input as $v) {
            $id = $v['categories_id'];
            $pid = $v['parent_id'];
            $tmp[$id] =& $tmp[$pid][$id];
        }
        return $tree;
    }

}
