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

    function buildTreeBranches(array $branches)
    {
        foreach ($branches as $key => &$value) {
            if (!$branches[$key]['parent_id']) {
                $branches[$key] = &$value;
            } else {
                $branches[$branches[$key]['parent_id']][$key] = &$value;
            }
        }
        return $branches;
    }
}