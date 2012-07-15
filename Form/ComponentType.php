<?php

/*
* This file is part of the Ikimea Pages package.
*
* (c) Ikimea <http://www.ikimea.com/>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Ikimea\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ComponentType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options) {
        $builder
                ->add('value', 'ckeditor')
        ;
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Ikimea\PageBundle\Entity\Component',
        );
    }

    public function getName() {
        return 'component';
    }

}