<?php

namespace AnomaliesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class TypesocieteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder
            ->add('typesociete', 'text',
                                array(
                                        'data' => $options['data']->getTypesociete(),
                                        'label' => "Type societe",
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
            'data_class' => 'AnomaliesBundle\Entity\Typesociete'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'anomaliesbundle_typesociete';
    }
}
