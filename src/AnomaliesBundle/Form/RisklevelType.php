<?php

namespace AnomaliesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RisklevelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        
        $builder
                ->add('risklevel', 'text',
                                               array(
                                                       'data' => $options['data']->getRisklevel(),
                                                       'label' => "Risklevel",
                                                       'constraints'=>array( 
                                                                             new Assert\NotBlank(
                                                                                     array(
                                                                                           'message' => 'Value should not be empty!',
                                                                                           )        
                                                                                   )
                                                                           ),
                                                       'attr' => array(
                                                                       //'style' => 'width:250px', 
                                                                       )                                   
                                                   )
                    )
                ->add('save', 'submit', array('label' => 'Save',
                                       'attr' => array(
//                                                                   'class' => 'btn btn-info', 
//                                                                   'type' => 'button'
                                            )                                                    
                                    )); 
        ;
        
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AnomaliesBundle\Entity\Risklevel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'anomaliesbundle_risklevel';
    }
}
