<?php $view->extend('AnomaliesBundle::base.html.php') ?>

<?php $view['slots']->set('title', "Editer") ?>

<?php  $view['slots']->start('edit_droitsacces') ?>
                
 <?php 

 //var_dump(count($form['email']->vars['errors'])); die();
 ?>        

<!-- de aici -->
    <div class="col-md-12">           
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Editer</h3>

                </div><!-- /.box-header -->
            </div> 
      <div class="box-body" style="min-height:500px;">
          
         <div >                     

                 <?php               
                 if($this->container->get('session')->getFlashBag()->has('error')){
                    echo '<div style="margin: 10px 0px 20px 10px;">';
                     foreach ($this->container->get('session')->getFlashBag()->get("error") as $message) {
                             echo '<div style="color:red; font-size:16px;">'.$message.'</div>';
                         }
                    echo '</div>';
                 } 
                 ?>
              
           <?php echo "<form action='".$view['router']->generate('droitsacces_update',  array(
                                                                                    'id' => $entity->getId()
                                                                                   ))."' 
                             method='post' 
                             name='droitsacces'
                             novalidate>";  ?>                        
                    <table class="table no-margin modules" >
                                         
                      <thead>
                        <tr>
                            <th>Login</th>  
                            <th>Given name</th>
                            <th>Surname</th>
                            <th>Email</th>                           
                            <th>Roles</th>                
                        </tr>
                      </thead>      
                                    
                      <tbody>                  
                        <tr>                          
                            <td>          
                                <?php foreach ($form['login']->vars['errors'] as $error): ?>
                                    <?php echo $error->getMessage();?>
                                <?php endforeach; ?>
                                 
                                <?php echo $view['form']->widget($form['login']) ?>
                            </td> 
                                <input type="hidden" name="hidpage" value="<?php echo $page;?>" >
                            <td>          
                                <?php foreach ($form['givenname']->vars['errors'] as $error): ?>
                                    <?php echo $error->getMessage();?>
                                <?php endforeach; ?>
                                 
                                <?php echo $view['form']->widget($form['givenname']) ?>
                             </td>  
                            <td>          
                                <?php foreach ($form['surname']->vars['errors'] as $error): ?>
                                    <?php echo $error->getMessage();?>
                                <?php endforeach; ?>
                                 
                                <?php echo $view['form']->widget($form['surname']) ?>
                            </td>  
                            <td>          
                                <?php foreach ($form['email']->vars['errors'] as $error): ?>
                                    <?php echo $error->getMessage();?>
                                <?php endforeach; ?>
                                 
                                <?php echo $view['form']->widget($form['email']) ?>
                            </td>
                            <td>                                          
                                <?php echo $view['form']->widget($form['roles']) ?>
                            </td>                            

                        </tr>                                                   
                      </tbody>
                    </table>
                             
                    <div class="box-footer clearfix">              
                        <?php echo $view['form']->widget($form['updatedetails'], 
                                                          array(
                                                            'attr' => array('class' => 'btn btn-md btn-default btn-flat',
                                                                           ),
                                                        )) 
                        ?>
                        <a href="<?php 
                                 echo $view['router']->generate('droitsacces', array()) 
                                ?>" 
                         class="btn btn-md btn-default btn-flat"
                         style ="width:100px;"                                                            
                        >                                                       
                            <?php  echo "Canceler";?>
                        </a>                         
                    </div><!-- /.box-footer -->
                
                    <?php echo "</form>"; ?>  
                </div>

             
       </div>
    </div> 
<?php $view['slots']->stop() ?>

