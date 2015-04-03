<?php

namespace Mesd\LunchBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;

class DeleteTypeExtension extends AbstractTypeExtension
{
    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return 'button';
    }
}
