<?php

namespace AnomaliesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class TypetachesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
            ->add('typetache', 'text',
                                array(
                                        'data' => $options['data']->getTypetache(),
                                        'label' => "Type task",
                                        'constraints'=>array( 
                                                              new Assert\NotBlank(
                                                                      array(
                                                                            'message' => 'Cette valeur ne doit pas être vide!',
                                                                            )        
                                                                    )
                                                            ),
                                        'attr' => array(
                                                        //'style' => 'width:250px', 
                                                        )                                   
                                    )
                )
            ->add('save', 'submit', array('label' => 'Sauvegarder',
                                                   'attr' => array(
//                                                                   'class' => 'btn btn-info', 
//                                                                   'type' => 'button'
                                                        )                                                    
                                                ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AnomaliesBundle\Entity\Typetaches'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'anomaliesbundle_typetaches';
    }
}
