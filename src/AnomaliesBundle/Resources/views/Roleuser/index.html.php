<?php $view->extend('AnomaliesBundle::base.html.php') ?>

<?php $view['slots']->set('title', 'droitsacces') ?>

<?php  $view['slots']->start('list_droitsacces') ?>

    <div class="col-md-12 " >           
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Droits d'acces</h3>
             
                </div><!-- /.box-header -->
                <div class="box-body" style="min-height:500px;background-color: #fcf9ed;" >
                    <div style="margin: 10px 0px 20px 50px;">
                                <?php 

                                    if($this->container->get('session')->getFlashBag()->has('notice')){
                                        foreach ($this->container->get('session')->getFlashBag()->get("notice") as $message) {
                                                echo '<div style="color:red; font-size:16px;">'.$message.'</div>';
                                            }
                                   
                                    } 
                                ?>
                    </div>                   
                <div style="margin-bottom: 20px;">
                    <span>
                        <a href="<?php 
                                  echo $view['router']->generate('droitsacces_new', array()) 
                                 ?>" >  

                            <span class="glyphicon glyphicon-plus"> </span>
                            <span style="margin-left: 5px; font-size: 15px;">
                                <?php  echo "Nouvel enregistrement";?>
                            </span>
                        </a>  
                    </span> 
                    
<!--                    <span style="float:right;">-->
                            <?php   
//                                echo "<form action='".$view['router']->generate('droitsacces')."' 
//                                            method='post' 
//                                            name='droitsacces'
//                                            novalidate>";  
                            ?>                                             
                                          
<!--                           <span style="margin-top:15px;margin-right: 40px;">
                                <span>
                                <input type="text" name="searchindroitsacces" value="" >   
                                </span>
                               
                                <span>
                                <input type="submit" name="submitsearchda" value="Rechercher" >   
                                </span> 
                               
                            </span > -->
                            <?php 
//                              echo "</form>"; 
                            ?>                                                                                            
<!--                    </span> -->
                    
                </div>                         
                       <?php if(count($entities)): ?>              
                            <div class="col-md-12" >
                                <table  id='dtda' class="table no-margin display modules">
                                  <thead>
                                        <th>Id</th>
                                        <th>Username</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Email</th>                                                                             
                                        <th class="nosort">Droits</th>
                                        <th class="nosort">Supprimer</th>
                                        <th class="nosort">Editer</th>
                                  </thead>
                                  <tbody>                                         
                                    <?php $i=0;?>                                      
                                    <?php foreach ($entities as $entity): ?>                                        
                                        <tr>                                            
                                          <td><?php echo  $entity->getId(); ?> </td>                                           
                                          <td><?php echo  $entity->getUsername(); ?></td>
                                          <td><?php echo  $entity->getGivenname(); ?></td>
                                          <td><?php echo  $entity->getSurname(); ?></td>
                                          <td><?php echo  $entity->getEmail(); ?></td>
                                                                                                                              
                                       
                                        <!--################ START DISPLAY ROLES IN LIST ################-->
                                        <td>
                                            <?php   
                                                echo "<form action='".$view['router']->generate('droitsacces')."' 
                                                            method='post' 
                                                            name='droitsacces'
                                                            novalidate>";  
                                            ?>                                             

                                            <?php echo $view['form']->widget($forms[$i]['hid']); ?>
                                            
                                            <div>
                                                <?php 
                                                      echo $view['form']->widget($forms[$i]['roles']
                                                                                       ,
                                                                                        array(
                                                                                                'attr' => array(
                                                                                                                'class' => 'chosen-select',
                                                                                                                'disabled'=>'true'
                                                                                                               ),
                                                                                            )
                                                                                ) 
                                                 ?> 
                                            </div>
                                            
                                            <input type="hidden" name="hidpage" value="<?php echo $page;?>" >      
                                            <div style="margin-top:15px;">
                                                <?php 
//                                                        echo $view['form']->widget($forms[$i]['updatedetails'],
//                                                                                    array(
//                                                                                            'attr' => array(
//                                                                                                             'class' => 'btn btn-block btn-success btn-sm',
//                                                                                                             'style' =>"width:100px;"
//                                                                                                           ),
//                                                                                        )
//                                                                                ) 
                                                ?> 
                                            </div>   
                                            <?php 
                                              $i++;
                                              echo "</form>"; 
                                            ?>                                                                                            
                                        </td>

                                        <!--################ END BUTON SALVARE ROLURI IN LIST ################-->

                                         
                                        <!--################ START FORMULAR PT STERGERE IN LISTA
                                            PT ACTIVARE STERGERE, DECOMENTEAZA <input type="submit" name="droitsaccesdelete" ...
                                        -->
                                                   
                                           <td>  
                                                <?php   
                                                    echo "<form action='".$view['router']->generate('droitsacces_delete', array('id' => $entity->getId())) ."' 
                                                                          method='post' 
                                                                          name='droitsacces_delete'
                                                                          novalidate>";  
                                                ?> 
                                          
                                                    <input type="hidden" name="hidpage" value="<?php echo $page;?>" >
                                            
                                                    <input type="submit" name="droitsaccesdelete" value="Supprimer" 
                                                                                                  class="btn btn-block btn-danger btn-sm suprimer" 

                                                                                                  style = "width:100px; margin:0 auto;"> 
                                                <?php                                            
                                                    echo "</form>"; 
                                                ?> 
                                            </td>  
                                        
                                        <!--################ END FORMULAR PT STERGERE IN LISTA ################-->
                                                                                     
                                           <?php //if($view['security']->isGranted('ROLE_ADMIN')):?> 
                                            <td> 

                                                  <a href="<?php 
                                                            echo $view['router']->generate('droitsacces_edit', array('id' => $entity->getId())) 
                                                           ?>" 
                                                     class="btn btn-block btn-warning btn-sm"
                                                     style ="width:100px;margin:0 auto;"
                                                  >  
                                                      <?php echo "Editer";?>
                                                  </a>  

                                            </td>    
                                           <?php// endif; ?> 
                                        </tr> 
                                      <?php endforeach; ?>
                                  </tbody>
                                </table>
                                
<!--    <table>
        <thead>

            <th>Col2</th>
            <th>Col3</th>
        </thead>
        <tbody>

                <tr>

                    <form action="" method="POST">
                        <td>
                            <input type="text" value="" id="col1" name="col1"/>
                        </td>
                        <td>
                            <input type="text" value="" id="col2" name="col2"/>
                        </td>
                        <td>
                            <input type="submit" value="Save" />
                        </td>
                    </form>
                </tr>

        </tbody>
    </table>-->
                                                                
                                <div class="col-md-12">  
                                   <div class="navigation">
                                      <?php //echo $view['knp_pagination']->render($entities); ?>
                                   </div>     
                                 </div>  
                              </div><!-- /.table-responsive -->   
                       <?php endif ?>    
                </div><!-- /.box-body -->            
       </div><!-- /.box -->      
    </div> 

<?php $view['slots']->stop() ?>

