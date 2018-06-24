<?php

namespace AnomaliesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ControlesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        echo "<pre>";
        print_r($options['data']->getFktypesocietes());die();
        $builder
            ->add('controle', 'text',
                                array(
                                        'data' => $options['data']->getControle(),
                                        'label' => "Controle",
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
            ->add('echantillon', 'text',
                                array(
                                        'data' => $options['data']->getEchantillon(),
                                        'label' => "Echantillon",
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
            ->add('periodetravaux', 'text',
                                array(
                                        'data' => $options['data']->getPeriodetravaux(),
                                        'label' => "Periode travaux",
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
           ->add('typesociete', 'entity', array(
                                    // query choices from this entity
                                    'class' => 'AnomaliesBundle:Typesociete',
                                    'query_builder' => function($repository) 
                                                       {
                                                            return $repository->getEnabledRecords();
                                                        },            
                                    //indicii sunt luati din Controles pentru a se vedea care e selectia (owning side)
                                    'data' => $options['data']->getFktypesocietes(),
                                    //denumirea o ia din Typesociete;campul pe care-l vrei afisat in drop down
                                    'choice_label' => 'typesociete',
                                   // 'choice_label' => '',
                                    'label'=>"Type societe",
                                    'multiple' => true,
                                    'mapped' => false,                           
                                    //'expanded' => true,                           
                                    'constraints'=>new Assert\Count(
                                                            array('min' => 1, 'minMessage' => "Please select at least one user")
                                                        )
                                )
            )
        ->add('typetache', 'entity', array(
                                    // query choices from this entity
                                    'class' => 'AnomaliesBundle:Typetaches',
                                    'query_builder' => function($repository) 
                                                       {
                                                            return $repository->getEnabledRecords();
                                                        },
                                    //la fel ca mai sus
                                    'data' => $options['data']->getFktypetaches(),
                                    'choice_label' => 'typetache',
                                    'label'=>"Type tache",
                                    'multiple' => true,
                                    'mapped' => false,                                            
                                    //'expanded' => true,                           
                                    'constraints'=>new Assert\Count(
                                                            array('min' => 1, 'minMessage' => "Please select at least one user")
                                                        )
                                )
            )                                                                
        ->add('typecontrole', 'entity', array(
                                    // query choices from this entity
                                    'class' => 'AnomaliesBundle:Typecontrole',
                                    'query_builder' => function($repository) 
                                                       {
                                                            return $repository->getEnabledRecords();
                                                        },            
                                    //la fel ca mai sus
                                    'data' => $options['data']->getFktypecontroles(),
                                    'choice_label' => 'typecontrole',
                                    'label'=>"Type controle",
                                    'multiple' => true,
                                    'mapped' => false,                            
                                    //'expanded' => true,                           
                                    'constraints'=>new Assert\Count(
                                                            array('min' => 1, 'minMessage' => "Please select at least one user")
                                                        )
                                )
            ) 
        ->add('save', 'submit', array('label' => 'Sauvegarder',
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
