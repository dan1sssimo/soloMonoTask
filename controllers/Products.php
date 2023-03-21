<?php

namespace controllers;

use core\Controller;
use core\Core;
use core\Utils;

class Products extends Controller
{
    protected $categoryModel;
    protected $productModel;

    function __construct()
    {
        $this->categoryModel = new \models\Category();
        $this->productModel = new \models\Products();
    }
    
    public function actionList()
    {
        if ($_GET["action"] == "Load") {
            if ($_GET["category_id"]) {
                $categoryID = $_GET;
                if ($_GET["sort_by"]) {
                    $categoryProducts = $this->productModel->SortProductsBy($categoryID);
                } else
                    $categoryProducts = $this->productModel->SelectCategoryProducts($categoryID);
                if (is_array($categoryProducts)) {
                    $categoryData = $this->categoryModel->CategoryCount();
                    $response = [
                        'status' => 200,
                        'data' => ['categoryData' => $categoryData, 'productData' => $categoryProducts]
                    ];
                    echo json_encode($response);
                    die();
                }
            } else {
                $categoryData = $this->categoryModel->CategoryCount();
                $categoryID = $_GET;
                if ($_GET["sort_by"]) {
                    $productData = $this->productModel->SortProductsBy($categoryID);
                } else
                    $productData = $this->productModel->SelectAllProducts();
                $response = [
                    'status' => 200,
                    'data' => ['categoryData' => $categoryData, 'productData' => $productData]
                ];
                echo json_encode($response);
                die();
            }
        }
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCategory()
    {
        if ($this->isGet()) {
            $categoryID = $_GET;
            if ($_GET["sort_by"]) {
                $categoryProducts = $this->productModel->SortProductsBy($categoryID);
            } else
                $categoryProducts = $this->productModel->SelectCategoryProducts($categoryID);
            if (is_array($categoryProducts)) {
                $response = [
                    'status' => 200,
                    'data' => ['productsData' => $categoryProducts]
                ];
                echo json_encode($response);
                die();
            }
        } else
            return $this->render('notfound/index');
    }

    public function actionSort()
    {
        if ($this->isGet()) {
            $sortData = $_GET;

            $sortProducts = $this->productModel->SortProductsBy($sortData);

            if (is_array($sortProducts)) {
                $response = [
                    'status' => 200,
                    'data' => ['productsData' => $sortProducts]
                ];
                echo json_encode($response);
                die();
            }
        } else
            return $this->render('notfound/index');
    }
}