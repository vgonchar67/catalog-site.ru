<?php

namespace Propel;

use Propel\Base\ProductQuery as BaseProductQuery;
use Propel\CategoryQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'product' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class ProductQuery extends BaseProductQuery
{
    public function setFilters($data) {
        
        if(empty($data)) {
            return $this;
        }
        foreach($data as $key => $value){
            if(strlen(trim($value)) < 1) {
                continue;
            }
            switch($key) {
                case "id": $this->filterById($value); break;
                case "name": $this->where('Product.Name LIKE ?', '%' . $value . '%'); break;
                case "active": $this->filterByActive($value); break;
                case "empty_order": $this->filterByEmptyOrder($value); break;
                case "category": $this->useCategoryProductQuery()->filterByCategoryId($value)->endUse(); break;
            } 
        }

        return $this;
    }
}
