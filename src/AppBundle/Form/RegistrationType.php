<?php

namespace AppBundle\Form;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class RegistrationType extends AbstractType
{
    private $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		
		$stateChoices = array();
		$states = $options['em']->getRepository('AppBundle:State')->createQueryBuilder('s')->getQuery()->getResult();
		foreach($states as $state) {
			$stateChoices[$state->getName()] = $state->getCode();	
		}
		
        $builder->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array(
			'label' => 'form.email',
			'translation_domain' => 'FOSUserBundle'
		));
        $builder->add('username', null, array(
			'label' => 'form.username',
			'translation_domain' => 'FOSUserBundle'
		));
        $builder->add('firstName', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array(
			'label' => 'form.first_name',
			'translation_domain' => 'FOSUserBundle'
		));
        $builder->add('lastName', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array(
			'label' => 'form.last_name',
			'translation_domain' => 'FOSUserBundle'
		));
        $builder->add('address1', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array(
			'label' => 'form.address1',
			'translation_domain' => 'FOSUserBundle'
		));
        $builder->add('address2', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array(
			'label' => 'form.address2', 
			'translation_domain' => 'FOSUserBundle',
			'required' => false
		));
        $builder->add('state', ChoiceType::class, array(
			'choices' => $stateChoices,
			'label' => 'form.state',
			'translation_domain' => 'FOSUserBundle'
		));
        $builder->add('city', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array(
			'label' => 'form.city',
			'translation_domain' => 'FOSUserBundle'
		));
        $builder->add('zip', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array(
			'label' => 'form.zip', 
			'translation_domain' => 'FOSUserBundle'
		));
        $builder->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
			'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
			'options' => array('translation_domain' => 'FOSUserBundle'),
			'first_options' => array('label' => 'form.password'),
			'second_options' => array('label' => 'form.password_confirmation'),
			'invalid_message' => 'fos_user.password.mismatch',
		));
		
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'csrf_token_id' => 'registration',
            // BC for SF < 2.8
            'intention'  => 'registration',
            'em' => null,
            'req' => null,
        ));
    }

    // BC for SF < 2.7
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    // BC for SF < 3.0
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
    
}
