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
    public function setFilters($data) {
        
        if(empty($data)) {
            return $this;
        }
        foreach($data as $key => $value){
            $value = trim($value);
            if(strlen($value) < 1) {
                continue;
            }
            switch($key) {
                case "id": $this->filterById($value); break;
                case "name": $this->where('Category.Name LIKE ?', '%' . $value . '%'); break;
                case "active": $this->filterByActive($value); break;
            } 
        }

        return $this;
    }

    static function getNamesArray() {
        return CategoryQuery::create()->select(array('id', 'name'))->find()->toArray('id');
    }
}
