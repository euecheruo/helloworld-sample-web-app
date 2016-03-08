<?php

namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserLoaderInterface
{

	public function loadUserByUsername($username)
    {
		$qb = $this->createQueryBuilder('u')
				   ->where('u.username = :username OR u.email = :email')
				   ->setParameter('username', $username)
				   ->setParameter('email', $username);

		return $qb->getQuery()->getOneOrNullResult();
    }
	
}
