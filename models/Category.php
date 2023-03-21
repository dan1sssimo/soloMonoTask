<?php

namespace models;

use core\Core;
use core\Model;

class Category extends Model
{
    public function CategoryCount()
    {
        return Core::getInstance()->getDB()->selectJoinTables();
    }
}