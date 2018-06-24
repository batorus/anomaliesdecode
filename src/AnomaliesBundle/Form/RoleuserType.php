<?php

namespace AnomaliesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RoleuserType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       //var_dump($options['data']->getRoles()[0]);die();

               
        $builder->add('username', 'text',array(
                                                'data' => $options['data']->getUsername(),
                                                'label' => "User Name",
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
                ->add('password', 'text',array(
                                                'data' => $options['data']->getPassword(),
                                                'label' => "Password",
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
                ->add('email', 'text',array(
                                                'data' => $options['data']->getEmail(),
                                                'label' => "Email",
                                                'constraints'=>array( 
                                                                      new Assert\NotBlank(
                                                                              array(
                                                                                    'message' => 'Value should not be empty!',
                                                                                    )        
                                                                            ),
                                                                       new Assert\Email(
                                                                              array(
                                                                                    'message' => 'Not a valid email!',
                                                                                    ) 
                                                                       )  
                                                                    ),
                                                'attr' => array(
                                                                //'style' => 'width:250px', 
                                                                )                                   
                                            )
                    )                
                ->add('roles', 'choice', array(
                                         "data" => $options['data']->getRoles()[0],
                                         'label' =>"Roles",                        
                                         'choices' =>$options['roles'],
                                         'choices_as_values' => true,
                                         'mapped' => false,
                                         'multiple' => false,
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
         $resolver->setRequired('roles');
        $resolver->setDefaults(array(
            'data_class' => 'AnomaliesBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'anomaliesbundle_roleuser';
    }

//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setRequired('entity_manager');
//    }

}
