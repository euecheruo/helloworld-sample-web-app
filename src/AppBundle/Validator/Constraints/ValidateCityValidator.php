<?php

namespace AppBundle\Validator\Constraints;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidateCityValidator extends ConstraintValidator
{
	private $em;
	
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function validate($object, Constraint $constraint)
    {

		$qb = $this->em->getRepository('AppBundle:State')
				   ->createQueryBuilder('s')
				   ->where('s.code = :code')
				   ->setParameter('code', strtoupper($object->getState()));

		$state = $qb->getQuery()->getOneOrNullResult();
		if(empty($state)) {
			$this->context->buildViolation($constraint->message)->atPath('city')->addViolation();
		} else {
			
			$qb = $this->em->getRepository('AppBundle:City')
					   ->createQueryBuilder('c')
					   ->where('c.name = :name AND c.stateId = :stateId')
					   ->setParameter('name', strtoupper($object->getCity()))
					   ->setParameter('stateId', $state->getId());

			$city = $qb->getQuery()->getOneOrNullResult();
			if(empty($city)) {
				$this->context->buildViolation($constraint->message)->atPath('city')->addViolation();
			}

		}
		
	}
	
}
