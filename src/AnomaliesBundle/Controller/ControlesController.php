<?php

namespace AnomaliesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AnomaliesBundle\Entity\Controles;
use AnomaliesBundle\Form\ControlesType;

/**
 * Controles controller.
 *
 */
class ControlesController extends Controller
{

    /**
     * Lists all Controles entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AnomaliesBundle:Controles')->findBy(array('enabled'=>1));

        return $this->render('AnomaliesBundle:Controles:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    
    /**
     * Creates a new Controles entity.
     *
     */
    public function createAction(Request $request)
    {      
        $entity = new Controles();
          
        $form = $this->createForm(new ControlesType($this->container), $entity);
 
        $form->handleRequest($request);
        $validator = $this->get('validator');
        $errors = $validator->validate($form);    
    
        if (count($errors) > 0) 
        {          

            return $this->render('AnomaliesBundle:Controles:new.html.twig', array(
                'entity' => $entity,
                'form' => $form->createView()
            ));
    
//            return $this->render('AnomaliesBundle:Controles:new.html.php', array(
//                'entity' => $entity,
//                'form' => $form->createView()
//            ));
        }

        $em = $this->getDoctrine()->getManager();
        
        $entity->setControle($request->request->get('anomaliesbundle_controles')['controle']);  
        $entity->setEchantillon($request->request->get('anomaliesbundle_controles')['echantillon']);      
        $entity->setPeriodetravaux($request->request->get('anomaliesbundle_controles')['periodetravaux']);
        
        //momentan datele sunt serializate dar nefolosite la afisare
        //$entity->setTypesociete(serialize($request->request->get('anomaliesbundle_controles')['typesociete']));        
        //$entity->setTypetache(serialize($request->request->get('anomaliesbundle_controles')['typetache']));  
        //$entity->setTypecontrole(serialize($request->request->get('anomaliesbundle_controles')['typecontrole']));  
        
        $entity->setEnabled(1);
        $em->persist($entity);

        try
        {             
           $em->flush();                                        
        }
        catch( Doctrine\ORM\ORMException $e)
        {                  
           return $this->redirect($this->generateUrl('controles'));
        };
              
        $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 
        
        return $this->redirect($this->generateUrl('controles')); 
    }



    /**
     * Displays a form to create a new Controles entity.
     *
     */
    public function newAction()
    {        
        $entity = new Controles();

        $form = $this->createForm(new ControlesType($this->container), $entity);
        
        return $this->render('AnomaliesBundle:Controles:new.html.twig', array(
                             'entity' => $entity,
                             'form'   => $form->createView(),
                            ));
  
    }

    
    /**
     * Displays a form to edit an existing Controles entity.
     *
     */
    public function editAction(Controles $entity)
    {
         
        $form = $this->createForm(new ControlesType($this->container), $entity);  
         
        return $this->render('AnomaliesBundle:Controles:edit.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));

        
    }

   
    /**
     * Edits an existing Controles entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
       $em = $this->getDoctrine()->getManager();
       
        $entity = $em->getRepository('AnomaliesBundle:Controles')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Controles entity.');
        }
               
        $form = $this->createForm(new ControlesType($this->container), $entity);
              
        $form->handleRequest($request);
        $validator = $this->get('validator');
        $errors = $validator->validate($form);    
                
        if (count($errors) > 0) 
        {                     
           return $this->render('AnomaliesBundle:Controles:edit.html.twig', array(
                                'entity' => $entity,
                                'form'   => $form->createView(),
                                'errors' => $errors
            ));
            
//            return $this->render('AnomaliesBundle:Controles:edit.html.php', array(
//                     'entity' => $entity,
//                     'form'   => $form->createView(),
//                     'errors' => $errors
//            ));
        }
                   
        $entity->setControle($request->request->get('anomaliesbundle_controles')['controle']);  
        $entity->setEchantillon($request->request->get('anomaliesbundle_controles')['echantillon']);      
        $entity->setPeriodetravaux($request->request->get('anomaliesbundle_controles')['periodetravaux']);
         
        //momentan datele sunt serializate dar nefolosite la afisare
        //$entity->setTypesociete(serialize($request->request->get('anomaliesbundle_controles')['typesociete']));        
        //$entity->setTypetache(serialize($request->request->get('anomaliesbundle_controles')['typetache']));  
        //$entity->setTypecontrole(serialize($request->request->get('anomaliesbundle_controles')['typecontrole']));  
                
        try{     

             $em->flush();

        }
        catch(Doctrine\ORM\ORMException $e)
        {           

            // $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");

             return $this->redirect($this->generateUrl('controles_new'));
        };


         $this->container->get('session')->getFlashBag()->add("notice", "Enregistrement ajouté avec succès!"); 

        return $this->redirect($this->generateUrl('controles'));     
    }
    /**
     * Deletes a Controles entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
          $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AnomaliesBundle:Controles')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Controles entity.');
            }
            
            try{     

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Controles entity.');
            };

        }catch(\Symfony\Component\HttpKernel\Exception\NotFoundHttpException  $e){           
            
            //Logare exceptie aici
            // $this->container->get('session')->getFlashBag()->add("error", "L'enregistrement existe déjà dans la base de données!");           
            //            echo "<pre>";
            //            print_r($e->getTraceAsString());
            //            die();
            //return $this->redirect($this->generateUrl('controles'));
        };
//            
//            $usedentity = array();
//            $usedentity = $em->getRepository('AnomaliesBundle:Processanomalies')->findBy(array("typetaches"=>$id));  
//             // var_dump($usedentity);  die();
//            if(count($usedentity))
//            {
//                $this->container->get('session')->getFlashBag()->add("notice", "");
//                
//                $entity->setEnabled(0);       
//                $em->flush();
//                
//                return $this->redirect($this->generateUrl('typetaches'));               
//            }
            $entity->setEnabled(0);   
           // $em->remove($entity);
            $em->flush();
        
        return $this->redirect($this->generateUrl('controles'));
    }

   
}
