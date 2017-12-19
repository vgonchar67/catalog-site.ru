<?php

namespace Propel;

use Propel\Base\Category as BaseCategory;
use Propel\Runtime\Connection\ConnectionInterface;

/**
 * Skeleton subclass for representing a row from the 'category' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Category extends BaseCategory
{
    public function preSave(ConnectionInterface $con = null) {
		return $this->validate();
	}

	public function getErrors() {
        $errors = array();
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
