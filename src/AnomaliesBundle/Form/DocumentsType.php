<?php

namespace AnomaliesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;


class DocumentsType extends AbstractType
{
    
    
    /*
    Extension MIME Type
    .doc      application/msword
    .dot      application/msword

    .docx     application/vnd.openxmlformats-officedocument.wordprocessingml.document
    .dotx     application/vnd.openxmlformats-officedocument.wordprocessingml.template
    .docm     application/vnd.ms-word.document.macroEnabled.12
    .dotm     application/vnd.ms-word.template.macroEnabled.12

    .xls      application/vnd.ms-excel
    .xlt      application/vnd.ms-excel
    .xla      application/vnd.ms-excel

    .xlsx     application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
    .xltx     application/vnd.openxmlformats-officedocument.spreadsheetml.template
    .xlsm     application/vnd.ms-excel.sheet.macroEnabled.12
    .xltm     application/vnd.ms-excel.template.macroEnabled.12
    .xlam     application/vnd.ms-excel.addin.macroEnabled.12
    .xlsb     application/vnd.ms-excel.sheet.binary.macroEnabled.12

    .ppt      application/vnd.ms-powerpoint
    .pot      application/vnd.ms-powerpoint
    .pps      application/vnd.ms-powerpoint
    .ppa      application/vnd.ms-powerpoint

    .pptx     application/vnd.openxmlformats-officedocument.presentationml.presentation
    .potx     application/vnd.openxmlformats-officedocument.presentationml.template
    .ppsx     application/vnd.openxmlformats-officedocument.presentationml.slideshow
    .ppam     application/vnd.ms-powerpoint.addin.macroEnabled.12
    .pptm     application/vnd.ms-powerpoint.presentation.macroEnabled.12
    .potm     application/vnd.ms-powerpoint.template.macroEnabled.12
    .ppsm     application/vnd.ms-powerpoint.slideshow.macroEnabled.12

    .mdb      application/vnd.ms-access   
     */
    
   /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //dump($options);die();
        $builder
            ->add('description', 'text',
                                array(
                                        'data' => $options['data']->getDescription(),
                                        'label' => "Description du fichier",
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
                //more constraints here: https://symfony.com/doc/2.7/reference/constraints/File.html
                //complete list of mimes: https://www.sitepoint.com/mime-types-complete-list/
                ->add('userfile', 'file', array(
                                                  //'data_class' => 'Symfony\Component\HttpFoundation\File\File',
                                                  //'block_name'=>'Upload',
                                                  'label' => 'Choisir le fichier',
                                                  'mapped' =>false, 
                                                  'constraints'=>array( 
                                                                        new Assert\File(
                                                                                array(
                                                                                    'maxSize' => "5M",
                                                                                    'mimeTypes' => array(
                                                                                                         "image/jpeg", 
                                                                                                         "image/gif", 
                                                                                                         "image/png", 
                                                                                                         "image/tiff",
                                                                                                         "mage/x-tiff",
                                                                                                         "application/pdf", 
                                                                                                         "application/x-pdf",
                                                                                        
                                                                                                         "application/excel",
                                                                                                         "application/vnd.ms-excel",
                                                                                                         "application/x-excel",
                                                                                                         "application/x-msexcel",
                                                                                                         "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                                                                                                         "application/vnd.openxmlformats-officedocument.spreadsheetml.template",
                                                                                                         "application/vnd.ms-excel.sheet.macroEnabled.12",
                                                                                                         "application/vnd.ms-excel.template.macroEnabled.12",
                                                                                                         "application/vnd.ms-excel.addin.macroEnabled.12",
                                                                                                         "application/vnd.ms-excel.sheet.binary.macroEnabled.12", 
                                                                                        
                                                                                                        "application/vnd.ms-powerpoint",
                                                                                                        "application/vnd.ms-powerpoint",
                                                                                                        "application/vnd.ms-powerpoint",
                                                                                                        "application/vnd.ms-powerpoint",

                                                                                                        "application/vnd.openxmlformats-officedocument.presentationml.presentation",
                                                                                                        "application/vnd.openxmlformats-officedocument.presentationml.template",
                                                                                                        "application/vnd.openxmlformats-officedocument.presentationml.slideshow",
                                                                                                        "application/vnd.ms-powerpoint.addin.macroEnabled.12",
                                                                                                        "application/vnd.ms-powerpoint.presentation.macroEnabled.12",
                                                                                                        "application/vnd.ms-powerpoint.template.macroEnabled.12",
                                                                                                        "application/vnd.ms-powerpoint.slideshow.macroEnabled.12",

                                                                                                        "application/vnd.ms-access", 
                                                                                        
                                                                                                         "application/msword",
                                                                                                         "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                                                                                                         "application/vnd.openxmlformats-officedocument.wordprocessingml.template",
                                                                                                         "application/vnd.ms-word.document.macroEnabled.12",
                                                                                                         "application/vnd.ms-word.template.macroEnabled.12",
                                                                                        
                                                                                                          "text/plain",
                                                                                                        ),
                                                                                    'maxSizeMessage' => "La taille de fichier maxmimum autorisée est 5MB.",
                                                                                    'mimeTypesMessage' => "Ce type de fichier n'est pas autorisé.",
                                                                                    'uploadErrorMessage'=>"The file could not be uploaded.",
                                                                                    'disallowEmptyMessage'=>"Choose a file!",
                                                                                )

                                                                         )       
                                                ) 
                                            )
                        )                               
            ->add('upload', 'submit', array('label' => 'Upload',
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
            'data_class' => 'AnomaliesBundle\Entity\Documents'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'anomaliesbundle_documents';
    }
}
