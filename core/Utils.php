<?php

namespace core;

class Utils
{
    public static function arrayFilter($row, $fields)
    {
        $newRow = [];
        foreach ($fields as $field)
            if (isset($row[$field]))
                $newRow[$field] = $row[$field];
        return $newRow;
    }

    function buildTreeBranches(array &$branches, $parent_id = 0)
    {
        $branch = array();
        foreach ($branches as &$key) {
            if ($key['parent_id'] == $parent_id) {
                $childNode = $this->buildTreeBranches($branches, $key['categories_id']);
                $childNode ?  $branch[$key['categories_id']] = $this->buildTreeBranches($branches, $key['categories_id']) :
                    $branch[$key['categories_id']] = $key['categories_id'];
                unset($key);
            }
        }
        return $branch;
    }
}