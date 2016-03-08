<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ValidateZipcode extends Constraint
{

	public $message = 'Must be a valid Zipcode';
	
	public function validateBy() 
	{
		return 'validate_zipcode';
	}
	
	public function getTargets()
	{
		return self::CLASS_CONSTRAINT;
	}
	
}
