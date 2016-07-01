<?php
/**
 * Created by PhpStorm.
 * User: bsapi
 * Date: 18.6.2016.
 * Time: 11:33
 */

namespace DeepSpaceOne\GameBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;


class GoodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text')
            ->add('pricePerTon','integer')
            ->add('create','submit');
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $options = array(
            'data_class' => '\\DeepSpaceOne\\GameBundle\\Entity\\Good',
        );
    }

    function getName()
    {
        return 'game_good';
    }
}