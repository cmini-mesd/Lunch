<?php

namespace Mesd\LunchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VoteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('voter_id')
            // ->add('vote_date')
            ->add('restaurant', 'entity', array(
                'class' => 'MesdLunchBundle:Restaurant', 
                'expanded'=>true, 
                'multiple'=>true

        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mesd_lunchbundle_vote';
    }
}
