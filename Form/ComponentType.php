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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ComponentType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('value', 'ckeditor');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {

        $resolver->setDefaults(array(
            'data_class' => 'Ikimea\PageBundle\Entity\Component',
        ));
    }

    public function getName() {
        return 'component';
    }

}