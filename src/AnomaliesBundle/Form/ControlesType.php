<?php

namespace AnomaliesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ControlesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('controle')
            ->add('echantillon')
            ->add('periodetravaux')
            ->add('enabled')
            ->add('fktypecontroles')
            ->add('fktypesocietes')
            ->add('fktypetaches')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AnomaliesBundle\Entity\Controles'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'anomaliesbundle_controles';
    }
}
