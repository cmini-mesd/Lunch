<?php

namespace Mesd\LunchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ButtonTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DeleteType extends AbstractType implements ButtonTypeInterface
{

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'delete' => true,
            ]
        );
    }

    public function getParent()
    {
        return 'button';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'delete';
    }
}
