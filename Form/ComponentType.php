<?php

namespace Ikimea\PageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ComponentType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options) {
        $builder
                ->add('text', 'ckeditor')
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