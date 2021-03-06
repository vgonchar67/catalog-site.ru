<?php

namespace Propel;

use Propel\Base\Product as BaseProduct;
use Propel\Runtime\Connection\ConnectionInterface;

/**
 * Skeleton subclass for representing a row from the 'product' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Product extends BaseProduct
{

	public function getErrors() {
        $errors = array();
        if(!method_exists($this, 'getValidationFailures')) {
            return $errors;
        }
        $failures = $this->getValidationFailures();
        if(is_null($failures)) {
            return $errors;
        }
		foreach ($failures as $failure) {
			if(empty($errors[$failure->getPropertyPath()])) {
				$errors[$failure->getPropertyPath()] = $failure->getMessage();
			}
		}
		return $errors;
	}
}
