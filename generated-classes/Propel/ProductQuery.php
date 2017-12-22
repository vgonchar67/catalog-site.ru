<?php

namespace Propel;

use Propel\Base\ProductQuery as BaseProductQuery;
use Propel\CategoryQuery;
use Propel\Runtime\ActiveQuery\Criteria;

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
                case "id_from": $this->filterById(['min' => $value]); break;
                case "id_to": $this->filterById(['max' => $value]); break;
                case "quantity_from": $this->filterByQuantity(['min' => $value]); break;
                case "quantity_to": $this->filterByQuantity(['max' => $value]); break;
                case "name": $this->where('Product.Name LIKE ?', '%' . $value . '%'); break;
                case "active": $this->filterByActive($value); break;
                case "empty_order": $this->filterByEmptyOrder($value); break;
                case "category": 
                    if($value == "0") {
                        // Временный костыль, пока не смог реализовать выборку товаров без категории
                        $ids = array();
                        $products = ProductQuery::create()->find();
                        foreach($products as $product) {
                            if(!$product->countCategories()) {
                                $ids[] = $product->getId();
                            }
                        }
                        $this->filterById($ids);
                    } else {
                        $this->useCategoryProductQuery()->filterByCategoryId($value)->endUse(); 
                    }
                    
                    break;
            } 
        }

        return $this;
    }
}
