<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ValidateCity extends Constraint
{
	
	public $message = 'Must be a valid City';
	
	public function validateBy() 
	{
		return 'validate_city';
	}
	
	public function getTargets()
	{
		return self::CLASS_CONSTRAINT;
	}
	
}
