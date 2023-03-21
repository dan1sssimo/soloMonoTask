<?php

namespace models;

use core\Core;
use core\Model;

class Categories extends Model
{
    public function SelectAllCategories()
    {
        return Core::getInstance()->getDB()->testTask2();
    }

}