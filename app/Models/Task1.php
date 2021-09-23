<?php

namespace App\Models;

use Core\AbstractModel;

class Task1 extends AbstractModel
{
    /**
     * Get data for category aside menu
     *
     * @return array
     * @throws \Exception
     */
    public function getAside(): array
    {
        return $this->db::getRows("SELECT categories.title, categories.id, COUNT(products.id) AS `count` FROM `categories` INNER JOIN `products` ON categories.id = products.category GROUP BY products.category");
    }

    /**
     * Get products from category with sort
     *
     * @param int $categoryId
     * @param string $order
     * @return array
     * @throws \Exception
     */
    public function getCategoryProducts(int $categoryId, string $order = 'price'): array
    {
        $allow_orders = ['price', 'title', 'date'];
        $order = in_array($order, $allow_orders) ? "products.$order" : "products.price";
        return $this->db::getRows("SELECT categories.title AS `category_title`, products.img, products.date, products.price, products.title FROM `products`  INNER JOIN `categories` ON products.category = categories.id WHERE products.category = ? ORDER BY $order ASC", [$categoryId]);
    }
}