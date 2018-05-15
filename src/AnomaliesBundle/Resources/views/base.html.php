<!DOCTYPE html>
<html>
  <head>
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
    <title><?php $view['slots']->output('title', 'Amélioration continue') ?></title>
    <?php $assets = "anomalies"; ?>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- Bootstrap 3.3.5 -->
      
    <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/adminlte230/bootstrap/css/bootstrap.min.css') ?>">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/adminlte230/dist/css/AdminLTE.min.css') ?>">
    
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" 
          href="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/adminlte230/dist/css/skins/skin-blue.min.css') ?>"
    >
    
    <!-- iCheck -->
    <link rel="stylesheet" 
          href="<?php //echo $view['assets']->getUrl('bundles/'.$assets.'/adminlte230/plugins/iCheck/flat/blue.css') ?>"
    >
    
    <!-- Morris chart -->
    <link rel="stylesheet" 
          href="<?php //echo $view['assets']->getUrl('bundles/'.$assets.'/adminlte230/plugins/morris/morris.css') ?>"
    >
    
    <!-- jvectormap -->
    <link rel="stylesheet" 
          href="<?php //echo $view['assets']->getUrl('bundles/'.$assets.'/adminlte230/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>"
    >
    
    
    <!-- Date Picker -->
    <link rel="stylesheet" 
          href="<?php //echo $view['assets']->getUrl('bundles/'.$assets.'/adminlte230/plugins/datepicker/datepicker3.css') ?>"
    >
    
    
    <!-- Daterange picker -->
    <link rel="stylesheet" 
          href="<?php //echo $view['assets']->getUrl('bundles/'.$assets.'/adminlte230/plugins/daterangepicker/daterangepicker-bs3.css') ?>"
    >
    
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet"
          href="<?php //echo $view['assets']->getUrl('bundles/'.$assets.'/adminlte230/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>"
    >
    
    <link 
          rel="stylesheet" 
          type="text/css" 
          href="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/DataTables/datatables.css') ?>"
    >
 
 
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--    [if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
     
    <!-- jQuery 2.1.4 -->
    <script 
            src="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/adminlte230/plugins/jQuery/jQuery-2.1.4.min.js') ?>"           
    >
    </script>
        <!-- AdminLTE App -->
    <script 
        src="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/adminlte230/dist/js/app.min.js') ?>"
    >
    </script>
     
    <script type="text/javascript" 
            charset="utf8" 
            src="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/DataTables/datatables.js') ?>"
    >
    </script>
    
    <script type="text/javascript" 
            charset="utf8" 
            src="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/adminlte230/bootstrap/js/bootstrap.min.js') ?>"
    >
    </script>
    
    
     <!--    pt export-->
    <script type="text/javascript" 
            charset="utf8" 
            src="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/DataTables/DataTables-1.10.12/js/dataTables.buttons.min.js') ?>"
    >
    </script>
    
    <script type="text/javascript" 
            charset="utf8" 
            src="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/DataTables/DataTables-1.10.12/js/buttons.flash.min.js') ?>"
    >
    </script>
    
    
    <script type="text/javascript" 
            charset="utf8" 
            src="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/DataTables/DataTables-1.10.12/js/jszip.min.js') ?>"
    >
    </script>
    
    <script type="text/javascript" 
            charset="utf8" 
            src="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/DataTables/DataTables-1.10.12/js/pdfmake.min.js') ?>"
    >
    </script>
    
    
    <script type="text/javascript" 
            charset="utf8" 
            src="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/DataTables/DataTables-1.10.12/js/vfs_fonts.js') ?>"
    >
    </script>
    
    
    <script type="text/javascript" 
            charset="utf8" 
            src="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/DataTables/DataTables-1.10.12/js/buttons.html5.min.js') ?>"
    >
    </script>
    
    <script type="text/javascript" 
            charset="utf8" 
            src="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/DataTables/DataTables-1.10.12/js/buttons.print.min.js') ?>"
    >
    </script>
    
    <link rel="stylesheet" href="<?php //echo $view['assets']->getUrl('bundles/'.$assets.'/DataTables/DataTables-1.10.12/css/jquery.dataTables.min.css') ?>">
    <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/DataTables/DataTables-1.10.12/css/buttons.dataTables.min.css') ?>">

    
    <!-- Sweet Alert -->
    <script src="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/sweetalert/dist/sweetalert.min.js') ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/sweetalert/dist/sweetalert.css') ?>">
    

    
    <!-- jQuery UI 1.11.4 -->
<!--    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    
    
     Resolve conflict in jQuery UI tooltip with Bootstrap tooltip 
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>

     Morris.js charts 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
     Sparkline 
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
     jvectormap 
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
     jQuery Knob Chart 
    <script src="plugins/knob/jquery.knob.js"></script>
     daterangepicker 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
     datepicker 
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
     Bootstrap WYSIHTML5 
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
     Slimscroll 
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
     FastClick 
    <script src="plugins/fastclick/fastclick.min.js"></script>
     AdminLTE App 
    <script src="dist/js/app.min.js"></script>
     AdminLTE dashboard demo (This is only for demo purposes) 
    <script src="dist/js/pages/dashboard.js"></script>
     AdminLTE for demo purposes 
    <script src="dist/js/demo.js"></script>-->
    
    <?php if ( $view['slots']->has('list_controles')||
               $view['slots']->has('new_controles')||
               $view['slots']->has('edit_controles')||
            
               $view['slots']->has('list_processcontroles')||
               $view['slots']->has('new_processcontroles')||
               $view['slots']->has('edit_processcontroles')||           
            
               $view['slots']->has('list_societes')||
               $view['slots']->has('new_societes')||
               $view['slots']->has('edit_societes')||
            
               $view['slots']->has('list_typetaches')||
               $view['slots']->has('new_typetaches')||
               $view['slots']->has('edit_typetaches')||
            
               $view['slots']->has('list_typecontrole')||
               $view['slots']->has('new_typecontrole')||
               $view['slots']->has('edit_typecontrole')||
            
               $view['slots']->has('list_naturerreur') ||
               $view['slots']->has('new_naturerreur')||
               $view['slots']->has('edit_naturerreur')||
            
               $view['slots']->has('list_compteimpacte')||
               $view['slots']->has('new_compteimpacte')||
               $view['slots']->has('edit_compteimpacte')||
            
               $view['slots']->has('list_cyclebilan')||
               $view['slots']->has('new_cyclebilan')||
               $view['slots']->has('edit_cyclebilan')||
            
               $view['slots']->has('list_typologieanomalie')||
               $view['slots']->has('new_typologieanomalie')||
               $view['slots']->has('edit_typologieanomalie')||
            
               $view['slots']->has('list_qualificationerreur')||
               $view['slots']->has('new_qualificationerreur')||
               $view['slots']->has('edit_qualificationerreur')||
            
               $view['slots']->has('list_niveaurisque')||
               $view['slots']->has('new_niveaurisque')||
               $view['slots']->has('edit_niveaurisque')||
            
               $view['slots']->has('list_departement')||
               $view['slots']->has('new_departement')||
               $view['slots']->has('edit_departement')||
            
               $view['slots']->has('list_site')||
               $view['slots']->has('new_site')||
               $view['slots']->has('edit_site')||
            
               $view['slots']->has('list_status')||
               $view['slots']->has('new_status')||
               $view['slots']->has('edit_status')||
            
               $view['slots']->has('anomalies')||
            
               $view['slots']->has('list_processanomalies')||
               $view['slots']->has('new_processanomalies')||
               $view['slots']->has('edit_processanomalies')||
               
               $view['slots']->has('list_societecodsap')||
               $view['slots']->has('new_societecodsap')||
               $view['slots']->has('edit_societecodsap')||
 
               $view['slots']->has('list_nomsociete')||
               $view['slots']->has('new_nomsociete')||
               $view['slots']->has('edit_nomsociete')||
            
               $view['slots']->has('list_typesociete')||
               $view['slots']->has('new_typesociete')||
               $view['slots']->has('edit_typesociete')||
            
               $view['slots']->has('list_anomalieseasupervision')||
            
               $view['slots']->has('list_anomalieseacomptabilite')||
                
               $view['slots']->has('list_reportingsupervision')||
            
               $view['slots']->has('list_reportingcomptabilite')||
            
               $view['slots']->has('list_droitsacces')|| 
               $view['slots']->has('new_droitsacces')||
               $view['slots']->has('edit_droitsacces')           
            
             ): ?> 
    
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/chosen/chosen.css') ?>">
        <script src="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/chosen/chosen.jquery.js') ?>" type="text/javascript"></script>
        <script src="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/chosen/docsupport/prism.js') ?>" type="text/javascript" charset="utf-8"></script>
              
        <script src="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/js/jquery-ui-1.11.4/jquery-ui.js');?>"></script>
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/js/jquery-ui-1.11.4/jquery-ui.css');?>">
        
        <script type="text/javascript">

            $( document ).ready(function() {
                
            
              $(".chosen-select").chosen({
                  placeholder_text_multiple:"Choisissez une option"
              });
              
              $(".chosen-select-emails").chosen();
              $(".chosen-select-users").chosen();            
              $(".chosen-select-societe").chosen();
              

              
//           $('#optiunicautare').change(function(){  
//              
//              //console.log($(this).val());
//              
//            
//              
//              if($(this).val() == 5){
//                  //$("input[name='searchval']");
//
//              }else{
//                    $("input[name='searchval']").val("");
//              }
//              
//              
//              //alert('ok');
//          })
          
          //console.log( $("#datepicker").val());
              
              $(".datepicker").datepicker({firstDay: 1,
                                             dateFormat: "dd-mm-yy",
                                            // minDate: 0,
                                             beforeShowDay: $.datepicker.noWeekends,
                                             closeText: 'Fermer',
                                             prevText: 'Précédent',
                                             nextText: 'Suivant',
                                             currentText: 'Aujourd\'hui',
                                             monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                                             monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
                                             dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                                             dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
                                             dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                                             weekHeader: 'Sem.'});
                                         
             // $.datepicker.setDefaults($.datepicker.regional['fr']);
                      
             $( "#datepicker" ).datepicker("setDate", new Date());
             
             
                $("#datepickeradmin1, #datepickeradmin2").datepicker({
                                    firstDay: 1,
                                    dateFormat: "dd-mm-yy",
                                  //  minDate: 0,
                                    beforeShowDay: $.datepicker.noWeekends,
                                    closeText: 'Fermer',
                                    prevText: 'Précédent',
                                    nextText: 'Suivant',
                                    currentText: 'Aujourd\'hui',
                                    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                                    monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
                                    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                                    dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
                                    dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                                    weekHeader: 'Sem.'});
               
               //hide the day for the old version of form for processanomalies
               //$("#form_periode_day").hide();
               $("#anomaliesbundle_processanomalies_periode_day").hide();
               
              //hide the day for processcontrol              
               $("#anomaliesbundle_processcontrol_datecontrol_day").hide();                   
                                         
             // $.datepicker.setDefaults($.datepicker.regional['fr']);
                      
             $( "#datepickeradmin1, #datepickeradmin2" ).datepicker("setDate", new Date());  
             
            
          $('#fwdemail').tooltip()
          

           // $('[data-toggle="tooltip"]').tooltip({'placement': 'top'});
            $('#adminuserlist').DataTable({
                       bInfo : false
                    });
                    
            $('#ml').DataTable({
                       iDisplayLength: 7,
                       searching: true,
                       paging: true,
                       bInfo : false,
                       order: [],
                       columnDefs: [{
                                    targets  : 'nosort',
                                    orderable: false
                                  }],
                    language: {
                                lengthMenu: "Nombre de lignes :  _MENU_ ",
                                search:         "Rechercher : ",
                                paginate: {
                                       "first":      "Premier",
                                       "last":       "Dernier",
                                       "next":       "Suivant",
                                       "previous":   "Antérieur"
                                   },
                               }      
                    });
                    
     
                                                  
            $('#dtda').DataTable({
                       searching: true,
                       paging: true,
                       bInfo : false,
                       order: [],
                       columnDefs: [{
                                    targets  : 'nosort',
                                    orderable: false
                                  }],
                    language: {
                                lengthMenu: "Nombre de lignes :  _MENU_ ",
                                search:         "Rechercher : ",
                                paginate: {
                                       "first":      "Premier",
                                       "last":       "Dernier",
                                       "next":       "Suivant",
                                       "previous":   "Antérieur"
                                   },
                               }      
                    });      
          
          
          
//                                ,  'pageLength'
//                                           buttons: {
//                                            pageLength: {
//                                                '_': "Afficher %d éléments",
//                                                '-1': "Montre tout"
//                                            }
//                                    },
//                       lengthMenu: [
//                            [ 10, 25, 50, -1 ],
//                            [ '10 lignes', '25 lignes', '50 lignes', 'Afficher tout' ]
//                        ],

           $('#mla').DataTable({
                       iDisplayLength: 7,
                       searching: true,
                       paging: true,
                       bInfo : false,
                       order: [],
                       columnDefs: [{
                                    targets  : 'nosort',
                                    orderable: false
                                  }],

                       dom: 'Bfrtip',

                       buttons: [
                                    {
                                            extend: 'pdfHtml5',
                                            orientation: 'landscape',
                                            pageSize: 'LEGAL',
                                            text: 'PDF  ',
                                      exportOptions: {
                                             columns: ':visible'
                                      }
                                   },
                                   'excel'

                                   
                                ],
                    language: {
                                lengthMenu: "Nombre de lignes :  _MENU_ ",

                                search:         "Rechercher : ",
                                paginate: {
                                       first:      "Premier",
                                       last:       "Dernier",
                                       next:       "Suivant",
                                       previous:   "Antérieur"
                                   },
                               },
                    initComplete: function () 
                                {
                                    this.api().columns().every( function () {
                                        var column = this;
                                        var select = $('<select><option value=""></option></select>')
                                            .appendTo( $(column.footer()).empty() )
                                            .on( 'change', function () {
                                                var val = $.fn.dataTable.util.escapeRegex(
                                                    $(this).val()
                                                );

                                                column
                                                    .search( val ? '^'+val+'$' : '', true, false )
                                                    .draw();
                                            } );

                                        column.data().unique().sort().each( function ( d, j ) {
                                            if(column.search() === '^'+d+'$'){
                                                 select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
                                            } else {
                                                select.append( '<option value="'+d+'">'+d+'</option>' )
                                            }
                                        } );
                                    } );
                                }
                    });
                    



//########################### START scrpts for processanomalies edit/new
//#########################################################################

        $("#societecodsap").change(function (e) {

                e.preventDefault();

                var idsociete = $(this).val();

                $.ajax({
                    type: "post",
                    url: "<?php  echo $view['router']->generate('processanomalies_getsociete');?>",
                    data: {
                        id: idsociete
                    },
                    beforeSend: function ()
                    { 

                       //$(".societeinfo").addClass('disabled');
                    },
                    success: function (data) {

                        d = $.parseJSON(data);

                        
                        if(d.length)
                        {
                            $(d).each(function (i, val) 
                            {
                         

                                  $("select#nomsociete option[value="+val.id+"]").prop("selected", true).prop('disabled',false);
                                  $("select#typesociete option[value="+val.typesociete+"]").prop("selected", true).prop('disabled',false);
                                  $("select#comptablesenior option[value="+val.comptablesenior+"]").prop("selected", true).prop('disabled',false);
                                  $("select#comptablemanageur option[value="+val.comptablemanageur+"]").prop("selected", true).prop('disabled',false);     
                                  $("select#site option[value="+val.site+"]").prop("selected", true).prop('disabled',false); 
  
                            

                            })
                        }
                        else
                        {
                            $("select#nomsociete option:selected").prop("selected", null);
                            $("select#typesociete option:selected").prop("selected", null);
                            $("select#comptablesenior option:selected").prop("selected", null);
                            $("select#comptablemanageur option:selected").prop("selected", null);     
                            $("select#site option:selected").prop("selected", null); 
                            


                        };   
                        
                            //$('select#nomsociete').find(':not(:selected)').prop('disabled',true);   
                               // $('select#nomsociete').find(':not(:selected)').hide();
                            //  $('select#typesociete').find(':not(:selected)').prop('disabled',true); 
                                           $('select#typesociete').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});                 
                            //                $('select#comptablesenior').find(':not(:selected)').prop('disabled',true); 
                                           $('select#comptablesenior').find(':not(:selected)').each(function(){$(this).prop('disabled',true);}); 
                            //                $('select#comptablemanageur').find(':not(:selected)').prop('disabled',true);  
                                           $('select#comptablemanageur').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});               
                            //                $('select#site').find(':not(:selected)').prop('disabled',true);
                                           $('select#site').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});
                    }
                });
                                             
            });


            $("#nomsociete").change(function (e) {

                e.preventDefault();
                //var id = $(this).attr('id');
                var idsociete = $(this).val();
                //alert(idsociete);

                $.ajax({
                    type: "post",
                    url: "<?php  echo $view['router']->generate('processanomalies_getnomsociete');?>",
                    data: {
                        id: idsociete
                    },
                    beforeSend: function ()
                    { 

                       //$(".societeinfo").addClass('disabled');
                    },
                    success: function (data) {

                        d = $.parseJSON(data);

                        
                        if(d.length)
                        {
                            $(d).each(function (i, val) 
                            {                         
                                  $("select#societecodsap option[value="+val.id+"]").prop("selected", true).prop('disabled',false);
                                  $("select#typesociete option[value="+val.typesociete+"]").prop("selected", true).prop('disabled',false);
                                  $("select#comptablesenior option[value="+val.comptablesenior+"]").prop("selected", true).prop('disabled',false);
                                  $("select#comptablemanageur option[value="+val.comptablemanageur+"]").prop("selected", true).prop('disabled',false);     
                                  $("select#site option[value="+val.site+"]").prop("selected", true).prop('disabled',false); 
 

                            })
                        }
                        else
                        {
                            $("select#societecodsap option:selected").prop("selected", null);
                            $("select#typesociete option:selected").prop("selected", null);
                            $("select#comptablesenior option:selected").prop("selected", null);
                            $("select#comptablemanageur option:selected").prop("selected", null);     
                            $("select#site option:selected").prop("selected", null); 
                            
                        };   
                        
                            //$('select#nomsociete').find(':not(:selected)').hide();
                            $('select#typesociete').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});                 

                            $('select#comptablesenior').find(':not(:selected)').each(function(){$(this).prop('disabled',true);}); 

                            $('select#comptablemanageur').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});               

                            $('select#site').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});
                    }
                });
                                             
            });
            
            
            
            
                //$('select#nomsociete').find(':not(:selected)').prop('disabled',true);   
             //  $('select#nomsociete').find(':not(:selected)').hide();
//                $('select#typesociete').find(':not(:selected)').prop('disabled',true); 

               // alert( $('select#typesociete').find(':not(:selected)'));          
               $('select#typesociete').find(':not(:selected)').each(function(){$(this).prop('disabled',true);}); 
               
//                $('select#comptablesenior').find(':not(:selected)').prop('disabled',true); 
               $('select#comptablesenior').find(':not(:selected)').each(function(){$(this).prop('disabled',true);}); 
//                $('select#comptablemanageur').find(':not(:selected)').prop('disabled',true);  

               $('select#comptablemanageur').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});   
               
//                $('select#site').find(':not(:selected)').prop('disabled',true);

              $('select#site').find(':not(:selected)').each(function(){$(this).prop('disabled',true);}); 
               
               
               
//               $(".sh_anomalieseasupervision_form").hide();
//               $(".sh_anomalieseasupervision").on("click", function (e) {
//                    e.preventDefault();
//                    $(this).next(".sh_anomalieseasupervision_form").toggle();
//
//               });

//########################### END scripts for processanomalies edit/new
//#########################################################################



               $(document).on("click",".sh_anomalieseasupervision", function (e) {

                   var recordid = $(".hid_" + $(this).data('update')).val();
                   var status = $(".status_" + $(this).data('update')).val();
                   var reponse = $(".reponse_" + $(this).data('update')).val();
                   var commentaire = $(".commentaire_" + $(this).data('update')).val(); 
                   var observation = $(".observation_" + $(this).data('update')).val();  
                   
                $.ajax({
                    type: "post",
                    url: "<?php  echo $view['router']->generate('anomalieseasupervision_ajaxupdate');?>",
                    data: {
                        recordid: recordid,
                        status : status,
                        reponse : reponse,
                        commentaire : commentaire,
                        observation : observation
                    },
                    beforeSend: function ()
                    { 

                      // $(".societeinfo").addClass('disabled');
                    },
                    success: function (data) {

//                      alert(data)                       
//                      document.location.reload(true); 
                     
                    swal({
                        title: data,
                        text: "",
                        type: "warning",
                       // showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok",
                      //  cancelButtonText: "Non",
                        closeOnConfirm: true,
                       // closeOnCancel: true
                        },
                        function(isConfirm)
                        {
                                document.location.reload(true); 
                        }

                    );

 
                        
                    }
                });                                       
               });
               
//               $(".sh_anomalieseacomptabilite_form").hide();
//               $(".sh_anomalieseacomptabilite").on("click", function (e) {
//                    e.preventDefault();
//                    $(this).next(".sh_anomalieseacomptabilite_form").toggle();
//
//               });

                $(document).on("click",".sh_anomalieseacomptabilite", function (e) {

                   var comptablesenior = $(".comptablesenior_" + $(this).data('update')).val();
                   var reponse = $(".reponse_" + $(this).data('update')).val();
                   var recordid = $(".hid_" + $(this).data('update')).val();
                   var commentaire = $(".commentaire_" + $(this).data('update')).val(); 
            //alert(recordid);
                   
                $.ajax({
                    type: "post",
                    url: "<?php  echo $view['router']->generate('anomalieseacomptabilite_eacajaxupdate');?>",
                    data: {
                        recordid: recordid, 
                        reponse : reponse,
                        commentaire : commentaire,
                        comptablesenior : comptablesenior
                    },
                    beforeSend: function ()
                    { 

                      // $(".societeinfo").addClass('disabled');
                    },
                    success: function (data) {

//                      alert(data)                        
//                      document.location.reload(true); 

                    swal({
                        title: data,
                        text: "",
                        type: "warning",
                       // showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok",
                      //  cancelButtonText: "Non",
                        closeOnConfirm: true,
                       // closeOnCancel: true
                    },
                    function(isConfirm)
                    {
                            document.location.reload(true); 
                    }

                    );

 
                        
                    }
                });                                       
               });
               
               
               $(document).on("click",".sh_processanomalies", function (e) {

                   var recordid = $(".hid_" + $(this).data('update')).val();
                   var status = $(".status_" + $(this).data('update')).val();
         //   alert(status);
                   
                $.ajax({
                    type: "post",
                    url: "<?php  echo $view['router']->generate('processanomalies_pajaxupdate');?>",
                    data: {
                        recordid: recordid, 
                        status : status,
                    },
                    beforeSend: function ()
                    { 

                      // $(".societeinfo").addClass('disabled');
                    },
                    success: function (data) {

                     // alert(data)   
                     // swal("Good job!", "You clicked the button!", "success")
                    // document.location.reload(true); 
                    
                    
                swal({
                    title: data,
                    text: "",
                    type: "warning",
                   // showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ok",
                  //  cancelButtonText: "Non",
                    closeOnConfirm: true,
                   // closeOnCancel: true
                },
                function(isConfirm)
                {
                        document.location.reload(true); 
                }
                        
                );
 
                        
                    }
                });                                       
               });
               
               
           $(document).on("click",".suprimer", function (e) {
           /*   
               var retVal = confirm("Êtes-vous sûr?");
               
               if( retVal === true ){
                //  document.write ("User wants to continue!");

                  return true;
               }
               else{
                 // document.write ("User does not want to continue!");
                  e.preventDefault();
                  return false;
               }
               //  alert("oo");   
            */
           
           
            
            e.preventDefault();
            
            var form = $(this).parent('form');
                
                swal({
                    title: "Êtes-vous sûr?",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Oui",
                    cancelButtonText: "Non",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm){
                     
                  if (isConfirm) {
                   // swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    //window.location.href = linkURL;
                    form.submit();
                    return true;
                  } else {
                    // swal("Cancelled", "Your imaginary file is safe :)", "error");
                    return false;
                  }
                }
                        
                );
                                              
               });
               
               
               $(document).on("click",".suprimerlink", function (e) {
                    linkURL =  $(this).attr("href");
                  //alert(linkURL);
                    e.preventDefault(); 
                    swal({
                            title: "Êtes-vous sûr?",
                            text: "",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Oui",
                            cancelButtonText: "Non",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        },
                        function(isConfirm){

                          if (isConfirm) {
                           // swal("Deleted!", "Your imaginary file has been deleted.", "success");
                            window.location.href = linkURL;
                            return true;
                          } else {
                            // swal("Cancelled", "Your imaginary file is safe :)", "error");
                            return false;
                          }
                        }

                        );
                });
                
                
    //######################################START scripts for processcontrol ################# 
    //######################################################################################## 
            
            $("#societe_pc").change(function (e) {

                e.preventDefault();

                var idsociete = $(this).val();

                $.ajax({
                    type: "post",
                    url: "<?php  echo $view['router']->generate('processanomalies_getsociete');?>",
                    data: {
                        id: idsociete
                    },
                    beforeSend: function ()
                    { 

                       //$(".societeinfo").addClass('disabled');
                    },
                    success: function (data) {

                        d = $.parseJSON(data);

                        
                        if(d.length)
                        {
                            $(d).each(function (i, val) 
                            {
                         
                                  $("select#nomsociete_pc option[value="+val.id+"]").prop("selected", true).prop('disabled',false);
                                 // $("select#typesociete option[value="+val.typesociete+"]").prop("selected", true).prop('disabled',false);
                                  $("select#comptablesenior_pc option[value="+val.comptablesenior+"]").prop("selected", true).prop('disabled',false);
                                  $("select#comptablemanageur_pc option[value="+val.comptablemanageur+"]").prop("selected", true).prop('disabled',false);     
                                  $("select#site_pc option[value="+val.site+"]").prop("selected", true).prop('disabled',false); 
                             
                            })
                        }
                        else
                        {
                            $("select#nomsociete_pc option:selected").prop("selected", null);
                           // $("select#typesociete option:selected").prop("selected", null);
                            $("select#comptablesenior_pc option:selected").prop("selected", null);
                            $("select#comptablemanageur_pc option:selected").prop("selected", null);     
                            $("select#site_pc option:selected").prop("selected", null); 
                            


                        };   
                            $('select#comptablesenior_pc').find(':not(:selected)').each(function(){$(this).prop('disabled',true);}); 
                            $('select#comptablemanageur_pc').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});               
                            $('select#site_pc').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});
                    }
                });
                                             
            });


            $("#nomsociete_pc").change(function (e) {

                e.preventDefault();
                //var id = $(this).attr('id');
                var idsociete = $(this).val();
                //alert(idsociete);

                $.ajax({
                    type: "post",
                    url: "<?php  echo $view['router']->generate('processanomalies_getnomsociete');?>",
                    data: {
                        id: idsociete
                    },
                    beforeSend: function ()
                    { 

                       //$(".societeinfo").addClass('disabled');
                    },
                    success: function (data) {

                        d = $.parseJSON(data);

                        
                        if(d.length)
                        {
                            $(d).each(function (i, val) 
                            {                         
                                  $("select#societe_pc option[value="+val.id+"]").prop("selected", true).prop('disabled',false);
                                 // $("select#typesociete option[value="+val.typesociete+"]").prop("selected", true).prop('disabled',false);
                                  $("select#comptablesenior_pc  option[value="+val.comptablesenior+"]").prop("selected", true).prop('disabled',false);
                                  $("select#comptablemanageur_pc  option[value="+val.comptablemanageur+"]").prop("selected", true).prop('disabled',false);     
                                  $("select#site_pc  option[value="+val.site+"]").prop("selected", true).prop('disabled',false); 
                            })
                        }
                        else
                        {
                            $("select#societe_pc  option:selected").prop("selected", null);
                            //$("select#typesociete option:selected").prop("selected", null);
                            $("select#comptablesenior_pc option:selected").prop("selected", null);
                            $("select#comptablemanageur_pc option:selected").prop("selected", null);     
                            $("select#site_pc option:selected").prop("selected", null); 
                            
                        };   
          

                            $('select#comptablesenior_pc').find(':not(:selected)').each(function(){$(this).prop('disabled',true);}); 
                            $('select#comptablemanageur_pc').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});               
                            $('select#site_pc').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});
                    }
                });
                                             
            });
            

            $("#controle").change(function (e) {

                e.preventDefault();
                //var id = $(this).attr('id');
                var idcontrole = $(this).val();
                //alert(idsociete);

                $.ajax({
                    type: "post",
                    url: "<?php  echo $view['router']->generate('processcontrol_getdatacontrole');?>",
                    data: {
                        id: idcontrole
                    },
                    beforeSend: function ()
                    { 

                       //$(".societeinfo").addClass('disabled');
                    },
                    success: function (data) {

                        d = $.parseJSON(data);
                        console.log(d);
                         
                         
                       if(d.periodetravaux.length)
                       { 
                           $("#periodetravaux").val(d.periodetravaux);
                       }
                        
                       if(d.typetaches.length)
                       { 
                            $("select#typecontrole_pc option:selected").prop("selected", null);  
                            
                            $.each(d.typetaches, function(i , e){
                               // console.log(e);

                                $("select#typecontrole_pc option[value=" + e + "]").prop("selected", true).prop('disabled',false);
                            });
                            
                            $('select#typecontrole_pc').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});
                        }
                        
                       if(d.typetaches.length)
                       { 
                            $("select#typetache_pc option:selected").prop("selected", null);  
                            
                            $.each(d.typetaches, function(i , e){
                               // console.log(e);

                                $("select#typetache_pc option[value=" + e + "]").prop("selected", true).prop('disabled',false);
                            });
                            
                            $('select#typetache_pc').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});
                        }
                        
                        
                       if(d.typesocietes.length)
                       { 
                            $("select#typesociete_pc option:selected").prop("selected", null);  
                            
                            $.each(d.typesocietes, function(i , e){
                               // console.log(e);

                                $("select#typesociete_pc option[value=" + e + "]").prop("selected", true).prop('disabled',false);
                            });
                            
                            $('select#typesociete_pc').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});
                        }
                        
                    }
                });
                                             
            });
            

           
            $('select#typecontrole_pc').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});            
            $('select#typetache_pc').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});            
            $('select#typesociete_pc').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});      
  
         //   $('#periodetravaux').prop('disabled',true);    

            $('select#comptablesenior_pc').find(':not(:selected)').each(function(){$(this).prop('disabled',true);}); 
            $('select#comptablemanageur_pc').find(':not(:selected)').each(function(){$(this).prop('disabled',true);});  
            $('select#site_pc').find(':not(:selected)').each(function(){$(this).prop('disabled',true);}); 
                
//###################################### END scripts for processcontrol ################# 
//########################################################################################  
            
           });
           
        </script>       
    <?php endif;?>
         
    <?php 
       //de folosit numai in cazul in care nu sunt in pagina pricipala
       if ( !$view['slots']->has('anomalies')):
    ?>    
        <style type="text/css">
            .table-responsive{
                
                overflow-x: hidden !important;
            }
            
            .content-wrapper, .right-side, .main-footer{
                margin-left:0px !important;
            }
            .main-sidebar{
                width:0px !important;
            }
            
            .error{color:red;}
            .bordererror{border-color:red;}
        </style>
        
    <?php endif;?>
        
          <style type="text/css">
              .main-footer{padding:5px;}
              
              .skin-blue .sidebar a{
                 color: #7f7f7f; 
                 font-size: 15px;
                 font-weight:550;
              }
              
              .sidebar-mini.sidebar-collapse .sidebar-menu > li:hover > a > span:not(.pull-right), 
              .sidebar-mini.sidebar-collapse .sidebar-menu > li:hover > .treeview-menu {
                color: #7f7f7f;
                background-color: #FAE1A9;
            }
            
            .skin-blue .sidebar-menu > li:hover > a, .skin-blue .sidebar-menu > li.active > a {
                color: #7f7f7f;
                background-color: #FAE1A9;
                border-left-color: #3c8dbc;
            }
            
            
             
              table.dataTable thead .sorting::after
              {
                 opacity: 0.8 !important; 
              }
              
              table.dataTable thead .sorting::after, 
              table.dataTable thead .sorting_asc::after, 
              table.dataTable thead .sorting_desc::after, 
              table.dataTable thead .sorting_asc_disabled::after, 
              table.dataTable thead .sorting_desc_disabled::after 
              {
                opacity: 0.8 !important; 
              }
              
            .skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
                background-color: #FAE1A9;
            }  
              
            table.cruises { 
              font-family: calibri, verdana, arial, helvetica, sans-serif;
              font-size: 14px;
              cellspacing: 0; 
              border-collapse: collapse; 
              //width: 535px;    
              }
              
            table.cruises th, table.cruises td { 
              border-right: 1px solid #999; 
              border-bottom: 1px solid #999; 
              }
              
              
              
            table.cruises th {
                              background-color: #9bbb59; 
                              font-family: calibri, verdana, arial, helvetica, sans-serif;
                              font-size: 14px;
                              font-weight: strong;
                              color: #fff;
                             }
            table.cruises tfoot th{color: #000;}                 
            table.cruises td { background-color: #fff; }
            
            
            table.modules { 
              font-family: calibri, verdana, arial, helvetica, sans-serif;
              font-size: 14px;
              cellspacing: 0; 
              border-collapse: collapse; 
              //width: 535px;    
              }
              
            table.modules th, table.modules td { 
              border-right: 1px solid #F2F2F2; 
              border-bottom: 1px solid #F2F2F2; 
              }
              
              
              
            table.modules th { background-color: #9bbb59; 
                              font-family: calibri, verdana, arial, helvetica, sans-serif;
                              font-size: 14px;
                              font-weight: strong;
                              color: #fff;
                             }
            table.modules td { background-color: #fff; }
            
            

            div.scrollableContainer { 
           //   position: relative; 
             //width: 552px; 
             // padding-top: 1.7em; 
              //margin: 40px;    
              //border: 1px solid #999;
             // background: #aab;
              }
              
            div.scrollingArea { 
              height: 500px; 
              //overflow: auto; 
              }

          /*  table.scrollable thead tr {
              left: 0; top: 0;
              position: absolute;
              }*/
          
          .skin-blue .main-header .navbar {
                background-color: #4bacc6;
            }
            
        .skin-blue .main-header .logo {
            background-color: #4bacc6;
            text-align: left;
            line-height: 45px;
            font-weight: 400;
        }
        
        .qc{
            color:#fff; 
            font-size:23px;
            font-weight: bold;
            font-family: calibri, verdana, arial, helvetica, sans-serif;
            margin-top:8px;
            margin-left:5px;
        }

          
        .mainimage{
            display: block;
            margin-left:auto;
            margin-right:auto;
            margin-top:3%;
        }  
        
       
        </style>
  </head>
  
  <body class="hold-transition skin-blue sidebar-mini " >
    <div class="wrapper">
  
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo $view['router']->generate('anomalies') ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">
              <img src="<?php echo $view['assets']->getUrl('bundles/anomalies/images/qassurance.png') ?>" width="40" height="40">
          </span>   
          <span class="logo-lg" >
             <span>
                <img src="<?php echo $view['assets']->getUrl('bundles/anomalies/images/qassurance.png') ?>" width="40" height="40">
            </span>
              Menu
          </span>
        </a>
        
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
            
          <div class="navbar-custom-menu pull-left qc">
              Qualité Comptabilité     
          </div>
            
          <div class="navbar-custom-menu pull-right">
            <ul class="nav navbar-nav ">
              
                <li class="dropdown user user-menu">              
                    <a href="<?php echo $view['router']->generate('logout') ?>">
                      <span>Logout</span>          
                    </a>
                </li> 
            </ul>
          </div>  
        </nav>
      </header>
        
      <!-- Left side column. contains the logo and sidebar -->
      <div class="main-sidebar"  style="background-color: #fae1a9">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
       
          <ul class="sidebar-menu">
<!--            <li class="header" style="background-color: #fae1a9">NAVIGATION</li>-->
            
            <?php if($view['security']->isGranted('ROLE_AR_ADMINISTRATEUR')):?> 
            
                <li>
                  <a href="<?php echo $view['router']->generate('droitsacces') ?>">
                    <i class="fa fa-book"></i>   
                    <span>Droits acces</span>          
                  </a>
                </li>

                <li>
                  <a href="<?php echo $view['router']->generate('societes') ?>">
                    <i class="fa fa-book"></i>                       
                    <span>Liste des sociétés</span>          
                  </a>
                </li>

                <li>
                  <a href="<?php echo $view['router']->generate('naturerreur') ?>">
                    <i class="fa fa-book"></i>                       
                    <span>Nature de l'erreur</span>          
                  </a>
                </li>

                <li>
                  <a href="<?php echo $view['router']->generate('compteimpacte') ?>">
                    <i class="fa fa-book"></i>                       
                    <span>Compte impacté</span>          
                  </a>
                </li>

                <li >
                  <a href="<?php echo $view['router']->generate('cyclebilan') ?>">
                    <i class="fa fa-book"></i>                       
                    <span>Cycle du bilan</span>          
                  </a>
                </li>

               <li>
                  <a href="<?php echo $view['router']->generate('typologieanomalie') ?>">
                    <i class="fa fa-book"></i>                      
                    <span>Mot clé</span>          
                  </a>
                </li>

                <li>
                  <a href="<?php echo $view['router']->generate('qualificationerreur') ?>">
                    <i class="fa fa-book"></i>                      
                    <span>Impact financier</span>          
                  </a>
                </li>

                <li>
                  <a href="<?php echo $view['router']->generate('niveaurisque') ?>">
                    <i class="fa fa-book"></i>                       
                    <span>Gravité</span>          
                  </a>
                </li>

                <li>
                  <a href="<?php echo $view['router']->generate('departement') ?>">
                    <i class="fa fa-book"></i>                       
                    <span>Departement</span>          
                  </a>
                </li>


            <?php endif;?>     
                              
                
                <li>
                  <a href="<?php echo $view['router']->generate('processcontrol') ?>">
                    <i class="fa fa-book"></i>                       
                    <span>Process controles</span>          
                  </a>
                </li> 
                
                <li>
                  <a href="<?php echo $view['router']->generate('controles') ?>">
                    <i class="fa fa-book"></i>                       
                    <span>Controles</span>          
                  </a>
                </li>
                
                <li>
                  <a href="<?php echo $view['router']->generate('typesociete') ?>">
                    <i class="fa fa-book"></i>                       
                    <span>Type société</span>          
                  </a>
                </li>
                
                <li>
                  <a href="<?php echo $view['router']->generate('typetaches') ?>">
                    <i class="fa fa-book"></i>                       
                    <span>Type taches</span>          
                  </a>
                </li>
                
                <li>
                  <a href="<?php echo $view['router']->generate('typecontrole') ?>">
                    <i class="fa fa-book"></i>                       
                    <span>Type controle</span>          
                  </a>
                </li>
                
                
                
                
            <?php if($view['security']->isGranted('ROLE_AR_SUPERVISEUR')):?>     
                <li>
                  <a href="<?php echo $view['router']->generate('processanomalies') ?>">
                     <i class="fa fa-book"></i>                      
                    <span>Anomalies à remonter</span>          
                  </a>
                </li>
            <?php endif;?>   
                
            <?php if($view['security']->isGranted('ROLE_AR_SUPERVISEUR')):?>                        
                <li>
                  <a href="<?php echo $view['router']->generate('anomalieseasupervision') ?>">
                    <i class="fa fa-book"></i>                       
                    <span>En attente supervision</span>          
                  </a>
                </li>
            <?php endif;?>
                
            <?php if($view['security']->isGranted('ROLE_AR_SUPERVISEUR')):?> 
                <li>
                  <a href="<?php echo $view['router']->generate('reportingsupervision') ?>">
                     <i class="fa fa-book"></i>                      
                    <span>Reporting supervision</span>          
                  </a>
                </li>
            <?php endif;?>  
                
            <?php if($view['security']->isGranted('ROLE_AR_COMPTABLE_MANAGEUR')):?>             
                <li>
                  <a href="<?php echo $view['router']->generate('anomalieseacomptabilite') ?>">
                    <i class="fa fa-book"></i>   
                    <span>En attente comptabilité</span>          
                  </a>
                </li>
            <?php endif;?>             
            
            <?php if($view['security']->isGranted('ROLE_AR_COMPTABLE_MANAGEUR') ||$view['security']->isGranted('ROLE_AR_COMPTABLE')):?>       
            <li >
              <a href="<?php echo $view['router']->generate('reportingcomptabilite') ?>">
                    <i class="fa fa-book"></i>                   
                <span >Reporting comptabilité</span>          
              </a>
            </li>
            <?php endif;?> 
            
            <?php if($view['security']->isGranted('ROLE_AR_ADMINISTRATEUR')):?>             
            <li>
              <a href="<?php echo $view['router']->generate('site') ?>">
                <i class="fa fa-book"></i>                   
                <span>Site</span>          
              </a>
            </li>
            <?php endif;?>  
            
            <!--  ############################### -->
            
            <?php if($view['security']->isGranted('ROLE_AR_ADMINISTRATEUR')):?>             
            <li>
              <a href="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/pdf/MO_Comptabilite_Administrateur.pdf');?>" target='_blank'>
                <i class="fa fa-book"></i>                   
                <span>M.O. Administrateur</span>          
              </a>
            </li>
            <?php endif;?> 
            
            <?php if($view['security']->isGranted('ROLE_AR_COMPTABLE')):?>               
            <li>
              <a href="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/pdf/MO_Comptabilite_Comptable.pdf');?>" target='_blank'>
                <i class="fa fa-book"></i>                   
                <span>M.O. Comptable</span>          
              </a>
            </li>
            <?php endif;?> 
            
            <?php if($view['security']->isGranted('ROLE_AR_SUPERVISEUR')):?>              
            <li>
              <a href="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/pdf/MO_Comptabilite_Supervision.pdf')?>" target='_blank'>
                <i class="fa fa-book"></i>                   
                <span>M.O. Supervision</span>          
              </a>
            </li> 
            <?php endif;?>
            
            <?php if($view['security']->isGranted('ROLE_AR_COMPTABLE_MANAGEUR')):?>               
            <li>
              <a href="<?php echo $view['assets']->getUrl('bundles/'.$assets.'/pdf/MO_Comptabilite_Manageur_Comptable.pdf')?>" target='_blank'>
                <i class="fa fa-book"></i>                   
                <span>M.O. Manageur Comptable</span>          
              </a>
            </li>   
            <?php endif;?>            
            <!--  ############################### -->   
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </div>
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="background-color: #fff">
        <!-- Content Header (Page header) -->
<!--        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
            
          <ol class="breadcrumb">
              
            <li><a href="#">
                    <i class="fa fa-dashboard"></i> Home</a>
            </li>
            
            <li class="active">Dashboard</li>
          </ol>
        </section>-->
              
        <!-- Main content -->
        <section class="content">       
          <!-- Main row -->
          <div class="row">
              
            <!-- Left col -->
            <section class="col-lg-12">
                                                                                  
                <?php if ($view['slots']->has('list_societes')): ?>
                     <?php $view['slots']->output('list_societes') ?>     
                <?php elseif ($view['slots']->has('new_societes')): ?>
                    <?php $view['slots']->output('new_societes') ?>                 
                <?php elseif ($view['slots']->has('edit_societes')): ?>
                    <?php $view['slots']->output('edit_societes') ?> 
                
                <?php elseif ($view['slots']->has('list_processcontroles')): ?>
                     <?php $view['slots']->output('list_processcontroles') ?>     
                <?php elseif ($view['slots']->has('new_processcontroles')): ?>
                    <?php $view['slots']->output('new_processcontroles') ?>                 
                <?php elseif ($view['slots']->has('edit_processcontroles')): ?>
                    <?php $view['slots']->output('edit_processcontroles') ?>  
                
                <?php elseif ($view['slots']->has('list_controles')): ?>
                     <?php $view['slots']->output('list_controles') ?>     
                <?php elseif ($view['slots']->has('new_controles')): ?>
                    <?php $view['slots']->output('new_controles') ?>                 
                <?php elseif ($view['slots']->has('edit_controles')): ?>
                    <?php $view['slots']->output('edit_controles') ?>  
                
                <?php elseif ($view['slots']->has('list_typetaches')): ?>
                     <?php $view['slots']->output('list_typetaches') ?>     
                <?php elseif ($view['slots']->has('new_typetaches')): ?>
                    <?php $view['slots']->output('new_typetaches') ?>                 
                <?php elseif ($view['slots']->has('edit_typetaches')): ?>
                    <?php $view['slots']->output('edit_typetaches') ?>  
                
                
                <?php elseif ($view['slots']->has('list_typecontrole')): ?>
                     <?php $view['slots']->output('list_typecontrole') ?>     
                <?php elseif ($view['slots']->has('new_typecontrole')): ?>
                    <?php $view['slots']->output('new_typecontrole') ?>                 
                <?php elseif ($view['slots']->has('edit_typecontrole')): ?>
                    <?php $view['slots']->output('edit_typecontrole') ?>   
                
                <?php elseif ($view['slots']->has('list_naturerreur')): ?>
                    <?php $view['slots']->output('list_naturerreur') ?>                 
                <?php elseif ($view['slots']->has('new_naturerreur')): ?>
                    <?php $view['slots']->output('new_naturerreur') ?> 
               <?php elseif ($view['slots']->has('edit_naturerreur')): ?>
                    <?php $view['slots']->output('edit_naturerreur') ?>
                
                <?php elseif ($view['slots']->has('list_compteimpacte')): ?>
                    <?php $view['slots']->output('list_compteimpacte') ?> 
                <?php elseif ($view['slots']->has('new_compteimpacte')): ?>
                    <?php $view['slots']->output('new_compteimpacte') ?> 
                <?php elseif ($view['slots']->has('edit_compteimpacte')): ?>
                    <?php $view['slots']->output('edit_compteimpacte') ?> 

                
                <?php elseif ($view['slots']->has('list_cyclebilan')): ?>
                    <?php $view['slots']->output('list_cyclebilan') ?>               
               <?php elseif ($view['slots']->has('new_cyclebilan')): ?>
                    <?php $view['slots']->output('new_cyclebilan') ?>                   
                <?php elseif ($view['slots']->has('edit_cyclebilan')): ?>
                    <?php $view['slots']->output('edit_cyclebilan') ?> 
                
                <?php elseif ($view['slots']->has('list_typologieanomalie')): ?>
                    <?php $view['slots']->output('list_typologieanomalie') ?>                 
                <?php elseif ($view['slots']->has('new_typologieanomalie')): ?>
                    <?php $view['slots']->output('new_typologieanomalie') ?>                 
                <?php elseif ($view['slots']->has('edit_typologieanomalie')): ?>
                    <?php $view['slots']->output('edit_typologieanomalie') ?> 
                
                
                <?php elseif ($view['slots']->has('list_qualificationerreur')): ?>
                    <?php $view['slots']->output('list_qualificationerreur') ?>                 
                <?php elseif ($view['slots']->has('new_qualificationerreur')): ?>
                    <?php $view['slots']->output('new_qualificationerreur') ?>                
                <?php elseif ($view['slots']->has('edit_qualificationerreur')): ?>
                    <?php $view['slots']->output('edit_qualificationerreur') ?> 
                
                <?php elseif ($view['slots']->has('list_niveaurisque')): ?>
                    <?php $view['slots']->output('list_niveaurisque') ?>                 
                <?php elseif ($view['slots']->has('new_niveaurisque')): ?>
                    <?php $view['slots']->output('new_niveaurisque') ?>                
                <?php elseif ($view['slots']->has('edit_niveaurisque')): ?>
                    <?php $view['slots']->output('edit_niveaurisque') ?> 
                
                <?php elseif ($view['slots']->has('list_departement')): ?>
                    <?php $view['slots']->output('list_departement') ?>                 
                <?php elseif ($view['slots']->has('new_departement')): ?>
                    <?php $view['slots']->output('new_departement') ?>                
                <?php elseif ($view['slots']->has('edit_departement')): ?>
                    <?php $view['slots']->output('edit_departement') ?> 
                
                <?php elseif ($view['slots']->has('list_site')): ?>
                    <?php $view['slots']->output('list_site') ?>                 
                <?php elseif ($view['slots']->has('new_site')): ?>
                    <?php $view['slots']->output('new_site') ?>                
                <?php elseif ($view['slots']->has('edit_site')): ?>
                    <?php $view['slots']->output('edit_site') ?> 
                
                <?php elseif ($view['slots']->has('list_status')): ?>
                    <?php $view['slots']->output('list_status') ?>                 
                <?php elseif ($view['slots']->has('new_status')): ?>
                    <?php $view['slots']->output('new_status') ?>                
                <?php elseif ($view['slots']->has('edit_status')): ?>
                    <?php $view['slots']->output('edit_status') ?> 
                
                <?php elseif ($view['slots']->has('list_processanomalies')): ?>
                    <?php $view['slots']->output('list_processanomalies') ?>                 
                <?php elseif ($view['slots']->has('new_processanomalies')): ?>
                    <?php $view['slots']->output('new_processanomalies') ?>                
                <?php elseif ($view['slots']->has('edit_processanomalies')): ?>
                    <?php $view['slots']->output('edit_processanomalies') ?> 
                
                <?php elseif ($view['slots']->has('list_societecodsap')): ?>
                    <?php $view['slots']->output('list_societecodsap') ?>                 
                <?php elseif ($view['slots']->has('new_societecodsap')): ?>
                    <?php $view['slots']->output('new_societecodsap') ?>                
                <?php elseif ($view['slots']->has('edit_societecodsap')): ?>
                    <?php $view['slots']->output('edit_societecodsap') ?> 

                <?php elseif ($view['slots']->has('list_nomsociete')): ?>
                    <?php $view['slots']->output('list_nomsociete') ?>                 
                <?php elseif ($view['slots']->has('new_nomsociete')): ?>
                    <?php $view['slots']->output('new_nomsociete') ?>                
                <?php elseif ($view['slots']->has('edit_nomsociete')): ?>
                    <?php $view['slots']->output('edit_nomsociete') ?>    

                <?php elseif ($view['slots']->has('list_typesociete')): ?>
                    <?php $view['slots']->output('list_typesociete') ?>                 
                <?php elseif ($view['slots']->has('new_typesociete')): ?>
                    <?php $view['slots']->output('new_typesociete') ?>                
                <?php elseif ($view['slots']->has('edit_typesociete')): ?>
                    <?php $view['slots']->output('edit_typesociete') ?> 

                <?php elseif ($view['slots']->has('list_anomalieseasupervision')): ?>
                    <?php $view['slots']->output('list_anomalieseasupervision') ?>                 
                                    
                <?php elseif ($view['slots']->has('list_anomalieseacomptabilite')): ?>
                    <?php $view['slots']->output('list_anomalieseacomptabilite') ?> 

                <?php elseif ($view['slots']->has('list_reportingsupervision')): ?>
                    <?php $view['slots']->output('list_reportingsupervision') ?>                 
                
                <?php elseif ($view['slots']->has('list_reportingcomptabilite')): ?>
                    <?php $view['slots']->output('list_reportingcomptabilite') ?>  
                
                <?php elseif ($view['slots']->has('list_droitsacces')): ?>
                    <?php $view['slots']->output('list_droitsacces') ?> 
                <?php elseif ($view['slots']->has('new_droitsacces')): ?>
                    <?php $view['slots']->output('new_droitsacces') ?>                
                <?php elseif ($view['slots']->has('edit_droitsacces')): ?>
                    <?php $view['slots']->output('edit_droitsacces') ?>                 

                <?php elseif ($view['slots']->has('anomalies')): ?>
                    <?php $view['slots']->output('anomalies') ?> 
                
                <?php elseif ($view['slots']->has('login')): ?>
                    <?php $view['slots']->output('login') ?>              
                <?php endif; ?>
                
                

            </section><!-- /.Left col -->

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      
<!--    <footer class="main-footer" >
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.b
        </div>
        <strong>Copyright &copy; 2016 <a href="#">NOZ</a>.</strong> All rights reserved.
     </footer> -->


            <footer class="main-footer" 
                     style="
                           // float:left;
                            position: fixed;
                           // margin:0 auto;
                            //left: 0;
                           // top:20px;
                            bottom: 0;
                            height: 30px;
                            width: 100%;
                            background-color: #4BACC6;
                            //overflow:hidden;
                            "
                    >
                    <span style=' font-size:13px;color:#fff'>
                        <i>Amélioration continue  © <?php echo date('Y');?>.
                            Contact : <a href="mailto:poleweb@noz.fr" style='color:#fff'>poleweb@noz.fr</a>
                        </i>
                   </span>

            </footer>


      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
      
    </div><!-- ./wrapper -->


  </body>
</html>


