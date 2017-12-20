<?php

namespace Propel;

use Propel\Base\CategoryQuery as BaseCategoryQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'category' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class CategoryQuery extends BaseCategoryQuery
{

    static function getNamesArray() {
        $categories = self::create()->orderByName()->find();
		$result = array();
		foreach($categories as $category) {
			$result[] = [
				'Name' => $category->getName(),
				'Id' => $category->getId()
            ];
        }
        return $result;
    }

    static function createWithGetFilter() {
        $q = self::create();
        if(!empty($_POST["category_filter_form"])) {
            $data = $_POST;
        } elseif (!empty($_SESSION["category_filter_form"])) {
            $data = $_SESSION["category_filter_form"];
        } else {
            return $q;
        }

        if(!empty($data['clear'])) {
            unset($_SESSION["category_filter_form"]);
            return $q;
        }
        $sessionFilter = array();
        if(!empty($data['filter_id'])) {
            $sessionFilter['filter_id'] = $data['filter_id'];
            $q->filterById($data['filter_id']);
        }
        if(!empty($data['filter_name'])) {
            $sessionFilter['filter_name'] = $data['filter_name'];
            $q->where('Category.Name LIKE ?', '%' . $data['filter_name'] . '%');
        }
        if(strlen($data['filter_active']) > 0) {
            $sessionFilter['filter_active'] = $data['filter_active'];
            $q->filterByActive($data['filter_active']);
        }

        $_SESSION["category_filter_form"] = $sessionFilter;

        return $q;
    }
}
