<?php

namespace controllers;

use core\Controller;

class Categories extends Controller
{
    protected $categoriesModel;
    protected $utils;
    function __construct()
    {
        $this->categoriesModel = new \models\Categories();
        $this->utils = new \core\Utils();
    }

    public function actionIndex()
    {
        $timeOfStartScript = microtime(true);
        $branches = [];
        $categories = $this->categoriesModel->SelectAllCategories();

        while ($element = $categories->fetch_assoc()) {
            $branches[$element["categories_id"]] = [
                'categories_id' => $element["categories_id"],
                'parent_id' => $element["parent_id"]
            ];
        }

        $resultTree = $this->utils->buildTreeBranches($branches);
        $resultTimeOfScript = round(microtime(true) - $timeOfStartScript, 7);

        return $this->render('index', ['tree' => $resultTree, 'scriptTime' => $resultTimeOfScript]);
    }

}