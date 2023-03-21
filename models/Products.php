<?php

namespace models;

use core\Core;
use core\Model;

class Products extends Model
{
    public function SelectAllProducts()
    {
        return Core::getInstance()->getDB()->select('product', '*');
    }

    public function SelectCategoryProducts($categoryID)
    {
        $id = $categoryID['category_id'];
        return Core::getInstance()->getDB()->select('product', '*', ['category_id' => $id]);
    }

    public function SortProductsBy($data)
    {
        $categoryID = $data['category_id'];
        $sortByType = $data['sort_by'];
        if (!empty($categoryID)) {
            $categoryID = ['category_id' => $categoryID];
        } else
            $categoryID = null;
        switch ($sortByType) {
            case 0:
            {
                return Core::getInstance()->getDB()->select('product', '*', $categoryID);
            }
            case 1:
            {
                return Core::getInstance()->getDB()->select('product', '*', $categoryID, 'product_price ASC');
            }
            case 2:
            {
                return Core::getInstance()->getDB()->select('product', '*', $categoryID, 'product_name ASC');
            }
            case 3:
            {
                return Core::getInstance()->getDB()->select('product', '*', $categoryID, 'date DESC');
            }
        }
    }
}