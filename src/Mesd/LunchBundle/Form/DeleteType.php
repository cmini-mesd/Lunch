<?php

namespace Mesd\LunchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButtonTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DeleteType extends AbstractType implements SubmitButtonTypeInterface
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
        return 'submit';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'delete';
    }
}
