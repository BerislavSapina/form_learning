<?php
/**
 * Created by PhpStorm.
 * User: bsapi
 * Date: 1.7.2016.
 * Time: 20:25
 */

namespace DeepSpaceOne\GameBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GoodType extends AbstractType
{
    public function getName()
    {
        return 'deepspaceone_good';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DeepSpaceOne\\GameBundle\\Entity\\Good',
            'submit_label' => 'Submit',
        ));

        /*$resolver->setRequired(array(
            'submit_label',
        ));*/
    }

    public function buildForm(FormBuilderInterface $builder,array $options)
    {
        $builder->add('name','text')
                ->add('pricePerTon','integer')
                ->add('submit','submit',array(
                    'label' => $options['submit_label'],
                ));
    }
}