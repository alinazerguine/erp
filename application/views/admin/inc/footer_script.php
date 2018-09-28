 <?php 
 $offer_dropdown='';
 foreach(get_offer_dropdown() as $data){
         $offer_dropdown.='<option value="'.$data['value'].'">'.$data['label'].'</option>';
  }

?>
<!-- confirm message for delete elements-->
<div class="modal in" id="modal_delete_element" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" style="width: 500px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #333;color: #FFF;">
        <h3 class="modal-title"><b>Are you sure?</b></h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12"><p>You want to delete this.</p></div>
        </div>            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn-round btn-ok">Delete</a>
      </div>
    </div>
  </div>
</div>

<!-- confirm message for delete elements-->
<div class="modal in" id="modal_end_construction" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" style="width: 500px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #333;color: #FFF;">
        <h3 class="modal-title"><b>Etes-vous sûr?</b></h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12"><p>Etes-vous sûr de vouloir clôturer le projet ? Cette action est irréversible</p></div>
        </div>            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-round btn-default" data-dismiss="modal"><?php echo CANCEL_BTN;?></button>
        <a class="btn btn-danger btn-round btn-ok"><?php echo END_SITE_BTN;?></a>
      </div>
    </div>
  </div>
</div>
<!-- caution confirmation popup-->
<div class="modal in" id="modal_caution" role="dialog" aria-hidden="true">
  <input type="hidden" name="site_id" id="site_id" value="">
  <div class="modal-dialog modal-sm" style="width: 500px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #333;color: #FFF;">
        <h3 class="modal-title"><b>Caution</b></h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12"><p>Est-ce qu’il y a une caution pour ce projet ?</p></div>
        </div>            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-round btn-default" onclick="is_caution(0);"><?php echo NO;?></button>
        <a class="btn btn-danger btn-round" onclick="is_caution(1);"><?php echo YES;?></a>
      </div>
    </div>
  </div>
</div>
<!-- rules reminder popup-->
<div class="modal in" id="modal_rules_reminder" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" style="width: 500px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #333;color: #FFF;">
        <h3 class="modal-title"><b>Merci de faire attention aux règles d’import</b></h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12"><p>Seule la première feuille de votre Excel sera prise en compte (métré). </p></div>
        </div>            
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-round btn-default" data-dismiss="modal"><?php echo CANCEL_BTN;?></button> -->
        <a class="btn btn-danger btn-round btn-reminder">OK</a>
      </div>
    </div>
  </div>
</div>

<!-- rules reminder popup-->
<div class="modal in" id="modal_end_site" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" style="width: 500px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #333;color: #FFF;">
        <h3 class="modal-title"><b>Fin de construction</b></h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12"><p>Vous pourrez clôturer le chantier une fois que ce dernier sera terminé à 100% et que les en-cours seront nuls. Veuillez réessayer lorsque ces deux conditions seront respectées.</p></div>
        </div>            
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-round btn-default" data-dismiss="modal"><?php echo CANCEL_BTN;?></button> -->
        <a class="btn btn-danger btn-round" data-dismiss="modal">OK</a>
      </div>
    </div>
  </div>
</div>
<!-- modal_status_rules_reminder rules reminder popup-->
<div class="modal in" id="modal_status_rules_reminder" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" style="width: 500px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #333;color: #FFF;">
        <h3 class="modal-title"><b>Merci de faire attention aux règles d’import</b></h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12"><p>Lorsque vous souhaitez ajouter ou modifier un état d'avancement, il convient de placer la feuille Excel correspondante en 2ème position dans votre fichier Excel (après votre métré). </p></div>
        </div>            
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-round btn-default" data-dismiss="modal"><?php echo CANCEL_BTN;?></button> -->
        <a class="btn btn-danger btn-round btn-status-reminder">OK</a>
      </div>
    </div>
  </div>
</div>

 <div id="printable"></div>
<script src="<?php echo SURL;?>assets/js/jquery-1.10.2.min.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->
<script src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script src="<?php echo SURL;?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo SURL;?>assets/js/scripts.js"></script>
<script src="<?php echo SURL;?>assets/js/bootstrap-select.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo SURL;?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo SURL;?>assets/js/bootstrap-filestyle.min.js"></script>
<script src="<?php echo SURL;?>assets/datepicker/js/moment.js" type="text/javascript"></script>
<script src="<?php echo SURL;?>assets/datepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo SURL;?>assets/js/doublescroll.js"></script>

<!-- ------------ notification count ------------- -->
<?php if( $this->uri->segment(1)=='administrator' || $this->uri->segment(1)=='admin'){?>
  </script>
  <script type="text/javascript">   
    $(document).ready(function() {
      count_notification();
    });
  setInterval(function(){ 
    count_notification();
  }, 5000);
   </script>
   <?php } ?>

   <!-- ------------ HR notification count ------------- -->
<?php if( $this->uri->segment(1)=='human_resource'){?>
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      count_hr_notification();
    });
  setInterval(function(){ 
    count_hr_notification();
  }, 5000);
   </script>
   <?php } ?>

<!-- ------------ reminder checked ------------- -->
<?php if(($this->uri->segment(2)=='offers' && $this->uri->segment(3)=='add' && $this->input->cookie('rule_reminder')!=1)){
    $controller_link = 'admin/offers';
  ?>
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#modal_rules_reminder").modal('show');
    });
    $(".btn-reminder").click(function(){
    $("#modal_rules_reminder").modal('hide');
    var controller_link = '<?php echo $controller_link?>';
    var request_url = SURL+controller_link+"/reminder";
       $.ajax({
        method: "POST",
        url: request_url,
       // data: "offer_ids="+offer_ids,
      }).done(function (result) {      
                 //alert(result);
              });

   });
   </script>
   <?php } ?>

<!-- ------------ reminder checked ------------- -->
<?php if(($this->uri->segment(3)=='import_status' && $this->input->cookie('rule_reminder')!=1 )){
    if($this->session->userdata('user_type')==1){
      $controller_link = 'admin/execution';
    }else{
    $controller_link = 'site_manager/sites';
  }
  ?>
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#modal_status_rules_reminder").modal('show');
    });
    $(".btn-status-reminder").click(function(){
    $("#modal_status_rules_reminder").modal('hide');
    var controller_link = '<?php echo $controller_link?>';
    var request_url = SURL+controller_link+"/reminder";
       $.ajax({
        method: "POST",
        url: request_url,
       // data: "offer_ids="+offer_ids,
      }).done(function (result) {      
                 //alert(result);
              });

   });
   </script>
   <?php } ?>
   
<script type="text/javascript">

  /*$(document).ready(function() {
  $('.double-scroll').doubleScroll();
  $('#print_schedule').doubleScroll({
    resetOnWindowResize: true
  });
});*/
/*----------------------------------------------------------------------------*/
$(function () {
    $('.wrapper1').on('scroll', function (e) {
        $('.wrapper2').scrollLeft($('.wrapper1').scrollLeft());
    }); 
    $('.wrapper2').on('scroll', function (e) {
        $('.wrapper1').scrollLeft($('.wrapper2').scrollLeft());
    });
});
$(window).on('load', function (e) {
    $('.div1').width($("#employee_schedule_table").width());
});

/*$("#employee_schedule_table tr td select").on('change', function(event) {
    $('.div1').width($("#employee_schedule_table").width());
});*/

$("#employee_schedule_table").on('change', function(event) {
    $('.div1').width($("#employee_schedule_table").width());
});

/*----------------------------------------------------------------------------*/
$(document).ready(function() {
   $('select.form-control').each(function() {
   var current = $(this).val();
   if(current==''){
    $(this).css('color','#999');
   }else{
     $(this).css('color','#555');
   }
   }); 
    
    $('select.form-control').change(function() {
       var current = $('select.form-control').val();
       if (current != '') {
          $(this).css('color','#555');
       } else {
           $(this).css('color','#999');
       }
    }); 

    $('input[type="date"]').css('color','#999');
    $('input[type="date"]').change(function() {
       var current = $('input[type="date"]').val();
       if (current != '') {
           $(this).css('color','#555');
       } else {
           $(this).css('color','#999');
       }
    }); 
});

$(function() {
        var date         = new Date();
        var currentMonth = date.getMonth();
        var currentDate  = date.getDate();
        var currentYear  = date.getFullYear();
        $(".datepicker").datetimepicker({
            format: 'DD/MM/YYYY',
            minDate: new Date(currentYear, currentMonth, currentDate)
        });
       
        /* swal({
            title: "Something is going wrong!",
            title: "Are you sure?",
            text: "Are you sure that you want to leave this page?",
            icon: "warning",
            dangerMode: true,
        }); */
    });
/*------------------- check unread message every 5 sec-------*/
   function count_notification(){
    //alert('sss');
    var request_url = SURL+"admin/administrator/unread_message";
    $.ajax({
        method: "POST",
        url: request_url,
        //data: 'voucher_id='+id+'status='+value,
    })
            .done(function (responseText) {

            var result = JSON.parse(responseText);
            var count = result.count;
            //alert(count);
             var list = result.list;
            var str ='';
            if(list!='' && list !='[]'){
              var see_all_notify = '<?php echo SEE_ALL_NOTIFICATION ?>';
                $.each(list,function(i,v){
                  var message = v.detail;
                  str+='<li><a onclick="read_message('+v.id+',\''+v.link+'\')">'+                         
                          '<div class="notification_desc">'+
                            '<p>'+v.title+'</p>'+
                            '<p><span>'+v.created_time+'</span></p>'+
                          '</div>'+
                          '<div class="clearfix"></div>'+ 
                        '</a></li>';
                })
                str+='<li>'+
                          '<div class="notification_bottom">'+
                            '<a href="'+SURL+'admin/administrator">'+see_all_notify+'</a>'+
                          '</div>'+ 
                        '</li>';
                $("#show_msg_count").html(count);
                $("#new_msg_list").html(str);
            }else{
              //alert('sss');
              str+='<li>'+
                        '<div class="notification_bottom"><a href="#">No new notification.</a></div> '+ 
                        '</li>';
                $("#show_msg_count").html(count);
                $("#new_msg_list").html(str);
            }
      });
   }

function read_message(id,link){
      var request_url = SURL+"/admin/administrator/read_message/"+id;
       $.ajax({
        method: "POST",
        url: request_url,
       // data: "offer_ids="+offer_ids,
      }).done(function (result) {   
                  window.location.href=link;   
                  count_notification();
              });
   }

function count_hr_notification(){
    //alert('sss');
     var see_all_notify = '<?php echo SEE_ALL_NOTIFICATION ?>';
    var request_url = SURL+"human_resource/dashboard/unread_message/1";
    $.ajax({
        method: "POST",
        url: request_url,
        //data: 'voucher_id='+id+'status='+value,
    })
            .done(function (responseText) {

            var result = JSON.parse(responseText);
            var count = result.count;
            //alert(count);
             var list = result.list;
            var str ='';
            if(list!='' && list !='[]'){             
                $.each(list,function(i,v){
                  var message = v.detail;
                  str+='<li><a onclick="read_hr_message('+v.id+',\''+v.link+'\')">'+                         
                          '<div class="notification_desc">'+
                            '<p>'+v.title+'</p>'+
                            '<p><span>'+v.created_time+'</span></p>'+
                          '</div>'+
                          '<div class="clearfix"></div>'+ 
                        '</a></li>';
                })
                str+='<li>'+
                          '<div class="notification_bottom">'+
                            '<a href="'+SURL+'human_resource/dashboard">'+see_all_notify+'</a>'+
                          '</div>'+ 
                        '</li>';
                $("#show_msg_count").html(count);
                $("#new_msg_list").html(str);
            }else{
              //alert('sss');
              str+='<li>'+
                        '<div class="notification_desc"><p>No new notification.</p></div> '+ 
                        '</li>';
               str+='<li>'+
                          '<div class="notification_bottom">'+
                            '<a href="'+SURL+'human_resource/dashboard">'+see_all_notify+'</a>'+
                          '</div>'+ 
                        '</li>';          
                $("#show_msg_count").html(count);
                $("#new_msg_list").html(str);
            }
      });
   }
   function read_hr_message(id,link){
      var request_url = SURL+"/human_resource/dashboard/read_message/"+id;
       $.ajax({
        method: "POST",
        url: request_url,
       // data: "offer_ids="+offer_ids,
      }).done(function (result) {  
       window.location.href=link;    
                  count_hr_notification(1);
              });
   }


  function confirm_delete(href){
   $("#modal_delete_element").modal('show');
   $("#modal_delete_element").find('.btn-ok').attr('href', href);

 }

  function end_site_popup(){
   $("#modal_end_site").modal('show');
 }

 function confirm_end_construction(href){
   $("#modal_end_construction").modal('show');
   $("#modal_end_construction").find('.btn-ok').attr('href', href);

 }

 function show_offer(value){
  //alert(value);
  var html=' <option value="">--select--</option>';  
  var offer_dropdown='<?php echo $offer_dropdown?>';
    if(value=='Entreprise générale'){
        html+=offer_dropdown;
    }

    $("#offer_form #offer").html(html);
 }

 /*-------------- for offer page-----------*/
 function delete_checked_offers(){
   var offer_ids = [];
   $('input:checkbox.checkbox').each(function () {
       //var sThisVal = (this.checked ? $(this).val() : "");      
       if(this.checked){
        offer_ids.push($(this).attr('data'));
      }       
    });
   // console.log(offer_ids);

   var request_url = SURL+"/admin/offers/delete_offer";
   $.ajax({
    method: "POST",
    url: request_url,
    data: "offer_ids="+offer_ids,
  }).done(function (result) {      
   if(result=='OK'){
    $(".show_msg").html('<div class="alert alert-success alert-dismissable">-Selected offer deleted successfully!</div>');
              //get_coupon_codes();
              $('#offers_table').DataTable().ajax.reload();
            }else{
              $(".show_msg").html('<div class="alert alert-danger">Something went wrong</div>')
            }
            setTimeout(function(){$(".show_msg").html('');},5000);
          });


}

function show_visit(value){
  if(value==1){
    $("#visitModal").modal('show');
  }else{
   $("#visitModal").modal('hide');
 }
}

function save_comment(id,comment){
  //alert(id+' '+comment);

  var request_url = SURL+"/admin/offers/update_comment";
  $.ajax({
    method: "POST",
    url: request_url,
    data: "comment="+comment+"&offer_id="+id,
  }).done(function (result) {
   if(result=='OK'){
    $(".show_msg").html('<div class="alert alert-success alert-dismissable">comment updated successfully!</div>');
              //get_coupon_codes();
              $('#offers_table').DataTable().ajax.reload();
            }else{
              $(".show_msg").html('<div class="alert alert-danger">Something went wrong</div>')
            }
            setTimeout(function(){$(".show_msg").html('');},5000);

          });
}

$("#add_technical_visit").click(function(){
  $("#offer_form input[name='visit_date']").val($("#technical_visit_form #visit_date").val());
  $("#offer_form input[name='visit_address']").val($("#technical_visit_form #visit_address").val());
  $("#offer_form input[name='visit_contact_person']").val($("#technical_visit_form #visit_contact_person").val());
  $("#offer_form input[name='visit_gsm']").val($("#technical_visit_form #visit_gsm").val());
  $("#offer_form input[name='visit_phone']").val($("#technical_visit_form #visit_phone").val());

           // $("#technical_visit_form").reset();
           $("#technical_visit_form").trigger("reset");
           $("#visitModal").modal('hide');
 });

function cancel_tech_visit(){
  $("#technical_meeting").prop("selectedIndex", 0);
}

function update_offer_status(status,offer_id){
  var is_caution=0;
  if(status=='Accepté'){
    $("#modal_caution").modal('show');
    $("#modal_caution #site_id").val(offer_id);
  }else{
    var request_url = SURL+"/admin/offers/update_status";
    $.ajax({
      method: "POST",
      url: request_url,
      data: "status="+status+"&offer_id="+offer_id+"&is_caution="+is_caution,
    }).done(function (result) {
      if(result=='OK'){
        $(".show_msg").html('<div class="alert alert-success alert-dismissable">Le statut de l’offre est maintenant “'+status+'”.</div>');
      }else{
        $(".show_msg").html('<div class="alert alert-danger">Something went wrong</div>')
      }
      setTimeout(function(){$(".show_msg").html('');},5000);
    });
  }
}

function is_caution(is_caution){
  var offer_id= $("#modal_caution #site_id").val();
 
    var request_url = SURL+"/admin/offers/update_status";
    $.ajax({
      method: "POST",
      url: request_url,
     data: "status=Accepté&offer_id="+offer_id+"&is_caution="+is_caution,
    }).done(function (result) {
      if(result=='OK' && is_caution==1){
        $(".show_msg").html('<div class="alert alert-success alert-dismissable">Le statut de l’offre est maintenant “Accepté”. Et la caution est ajoutée.</div>');
        $("#modal_caution").modal('hide');
      }else if(result=='OK' && is_caution==0){
        $(".show_msg").html('<div class="alert alert-success alert-dismissable">Le statut de l’offre est maintenant “Accepté”.</div>');
        $("#modal_caution").modal('hide');
      }else{
        $(".show_msg").html('<div class="alert alert-danger">Something went wrong</div>')
      }
      setTimeout(function(){$(".show_msg").html('');},5000);
    });

}
/*----------------------------------------*/
/*function convertHrsToHrsMins(hrs) {
  let h = Math.floor(hrs);
  let m = hrs * 60;
  h = h < 10 ? '0' + h : h;
  m = m < 10 ? '0' + m : m;
  return `${h}:${m}`;
}*/

function convertToHHMM(info) {
  var hrs = parseInt(Number(info));
  var min = Math.round((Number(info)-hrs) * 60);
  hrs = (hrs==0 || hrs<10) ? '0'.hrs : hrs;
  min = (min==0 || min<10) ? '0'+min : min;
  return hrs+'h'+min;
}

var table;
$(document).ready(function() {
 $("#user_form .buttonText").text('Choisir le fichier');
$("#import_securt .buttonText").text('<?php echo SELECT_SECURYSAT;?>');
 $('[data-toggle="tooltip"]').tooltip(); 

 setTimeout(function(){ 
  $(".alert-success").hide(); 
  $(".alert-danger").hide(); 
}, 5000);

    //var table = $('#datatable').DataTable();
     table = $('#datatable').DataTable( /*{
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
      } */);
     /*----------------------  offers table------------------*/
     table = $('#offers_table').DataTable({ 
      "pageLength": 10,
      "bInfo": true,
      "oLanguage": {
        "oPaginate": {
          "sFirst": "First page", // This is the link to the first page
          "sPrevious": "Précédent", // This is the link to the previous page
          "sNext": "Suivant", // This is the link to the next page
          "sLast": "Last page" // This is the link to the last page
        },
        "infoFiltered": "(filtered from _MAX_ total records)",
        "sSearch": "Recherche:",
        "sLengthMenu": "Montre _MENU_ éléments",
        "sZeroRecords": "No record found!",
        "sInfo": "Montre _START_ à _END_ des _TOTAL_ éléments",
        "sInfoEmpty": "_TOTAL_ éléments",
        
      },
      "fnDrawCallback": function(oSettings) {                 
        if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
          $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
        }
      },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": SURL+"admin/offers/get_offers/",
          "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [ 
        { "targets": [0],"orderable": false,},
        { "targets": [1],"orderable": false,},
        { "targets": [2],"orderable": false,},
       // { "targets": [3],"orderable": false,},  
        { "targets": [4],"orderable": false,},   
        { "targets": [5],"orderable": false,},
        { "targets": [6],"orderable": false,},
        //{ "targets": [7],"orderable": false,},
        //{ "targets": [8],"orderable": false,},
        { "targets": [9],"orderable": false,},
        { "targets": [10],"orderable": false,}, 
        ],

        'createdRow': function( row, data, dataIndex ) {
          var row_id = $(row).find("#row_id").val();
          var is_new = $(row).find("#is_new").val();
          if(is_new==1){
          $(row).attr('class', 'new-row clickable-row');
        }else{
          $(row).attr('class', 'clickable-row');
        }
          $(row).attr('data-href', SURL+'admin/offers/detail/'+row_id);
          

        },
        initComplete: function () {
            this.api().columns().every( function (i) {
                
                if(i==4 || i==5 || i==6 || i==9){
                var column = this;
                var select_text='';
                if(i==4){
                  select_text='Marché';
                }else if(i==5){
                  select_text='Client';
                }else if(i==6){
                  select_text='Offre';
                }else if(i==9){
                  select_text='Statut';
                }

                var select = $('<select><option value="">'+select_text+'</option></select>')
                    .appendTo( $(column.header()))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                        .search( val ? val: '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                  if(d){
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                  }
                    /* if(i==5){
                    select.append( '<option value="public">public</option><option value="private">private</option>' )
                  }
                  if(i==6){
                    select.append( '<option value="general companies">general companies</option><option value="public entities">public entities</option><option value="private company">private company</option><option value="private person">private person</option>' )
                  }
                   if(i==7){
                    select.append( '<option value="concrete business">concrete business</option><option value="submission">submission</option>' )
                  }
                  if(i==10){

                   select.append( '<option value="process">process</option><option value="cancel">cancel</option><option value="rejected">rejected</option><option value="approved">approved</option>' )
                  }*/
                } );
              }
            } );
          }
        
        });

     $('#offers_table').on( 'click', 'tbody tr.clickable-row', function () {
        window.location.href = $(this).data('href');
      });

     $('#offers_table').on( 'click', 'tbody tr.clickable-row td input', function (e) {
         e.stopPropagation();
      });
     $('#offers_table').on( 'click', 'tbody tr.clickable-row td textarea', function (e) {
         e.stopPropagation();
      });

     /*----------------------  order book table------------------*/
     table = $('#orderbook_table').DataTable({ 
      "pageLength": 10,
      "bInfo": true,
       "oLanguage": {
        "oPaginate": {
          "sFirst": "First page", // This is the link to the first page
          "sPrevious": "Précédent", // This is the link to the previous page
          "sNext": "Suivant", // This is the link to the next page
          "sLast": "Last page" // This is the link to the last page
        },
        "infoFiltered": "(filtered from _MAX_ total records)",
        "sSearch": "Recherche:",
        "sLengthMenu": "Montre _MENU_ éléments",
        "sZeroRecords": "No record found!",
        "sInfo": "Montre _START_ à _END_ des _TOTAL_ éléments",
        "sInfoEmpty": "_TOTAL_ éléments",
        
      },
      "fnDrawCallback": function(oSettings) {                 
        if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
          $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
        }
      },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": SURL+"admin/orderbook/get_offers/",
          "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [ 
         { "targets": [0],"orderable": false,},
         { "targets": [1],"orderable": false,},
         //{ "targets": [2],"orderable": false,},
         { "targets": [3],"orderable": false,},
         { "targets": [4],"orderable": false,},
         //{ "targets": [5],"orderable": false,},
         //{ "targets": [6],"orderable": false,},
         { "targets": [7],"orderable": false,"visible": false},
         { "targets": [8],"orderable": false,"visible": false},


        ],
        'createdRow': function( row, data, dataIndex ) {
          var row_id = $(row).find("#row_id").val();
          $(row).attr('class', 'clickable-row');
          $(row).attr('data-href', SURL+'admin/orderbook/detail/'+row_id);

        },
         initComplete: function () {
            this.api().columns().every( function (i) {
                
                if(i==3 || i==4 ){
                var column = this;
                 var select_text='';
                if(i==3){
                  select_text='Marché';
                }else if(i==4){
                  select_text='Client';
                }
                var select = $('<select><option value="">'+select_text+'</option></select>')
                    .appendTo( $(column.header()))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                        .search( val ? val: '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                  if(d){
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                  }
                   
                } );
              }
            } );
          },
        "footerCallback": function ( row, data, start, end, display ) {
          var api = this.api(), data;

            // converting to interger to find total
            var intVal = function ( i ) {
              return typeof i === 'string' ?
              i.replace(/[\$,]/g, '')*1 :
              typeof i === 'number' ?
              i : 0;
            };

            var total_sites =0;
            // Total over this page
            pageTotal = api
            .column( 0, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
              return total_sites++;
            }, 0 );

      // computing column Total of the complete result 
      var hours=0;
      hours = api
      .column( 7 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      var price = api
      .column( 8 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      
      

            // Update footer by showing the total with the reference of the column index 
            $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 1 ).footer() ).html(total_sites+' sites');
            $( api.column( 5 ).footer() ).html((hours>0) ? convertToHHMM(hours) : '00h00');
            $( api.column( 6 ).footer() ).html(numberFormat(price));

          },

        });

     $('#orderbook_table').on( 'click', 'tbody tr.clickable-row', function () {
        window.location.href = $(this).data('href');
      });

     /*----------------------  execution table------------------*/
     table = $('#execution_table').DataTable({ 
      "pageLength": 10,
      "bInfo": true,
      "oLanguage": {
        "oPaginate": {
          "sFirst": "First page", // This is the link to the first page
          "sPrevious": "Précédent", // This is the link to the previous page
          "sNext": "Suivant", // This is the link to the next page
          "sLast": "Last page" // This is the link to the last page
        },
        "infoFiltered": "(filtered from _MAX_ total records)",
        "sSearch": "Recherche:",
        "sLengthMenu": "Montre _MENU_ éléments",
        "sZeroRecords": "No record found!",
        "sInfo": "Montre _START_ à _END_ des _TOTAL_ éléments",
        "sInfoEmpty": "_TOTAL_ éléments",
        
      },
      "fnDrawCallback": function(oSettings) {                 
        if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
          $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
        }
      },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": SURL+"admin/execution/get_executed_offers/",
          "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [ 
          { "targets": [0],"orderable": false,},
         { "targets": [1],"orderable": false,},
        // { "targets": [2],"orderable": false,},
         { "targets": [3],"orderable": false,},
         { "targets": [4],"orderable": false,},
         { "targets": [5],"orderable": false,},
        // { "targets": [6],"orderable": false,},
        // { "targets": [7],"orderable": false,},
         { "targets": [8],"orderable": false,"visible": false},
        ],
         'createdRow': function( row, data, dataIndex ) {
          var row_id = $(row).find("#row_id").val();
          $(row).attr('class', 'clickable-row');
          $(row).attr('data-href', SURL+'admin/execution/detail/'+row_id);

        },
         initComplete: function () {
            this.api().columns().every( function (i) {
                
                if(i==3 || i==4 || i==5  ){
                var column = this;
                 var select_text='';
                if(i==3){
                  select_text='Marché';
                }else if(i==4){
                  select_text='Client';
                }else if(i==5){
                  select_text='En-cours';
                }
                var column = this;
                var select = $('<select><option value="">'+select_text+'</option></select>')
                    .appendTo( $(column.header()))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                        .search( val ? val: '', true, false )
                            .draw();
                    } );
                if(i==5){                  
                       select.append( '<option value="green">Vert</option><option value="orange">Jaune</option><option value="red">Rouge</option>' );
                }else{
                column.data().unique().sort().each( function ( d, j ) {
                  if(d){
                    select.append( '<option value="'+d+'">'+d+'</option>' )                  
                  }
                   
                } );
              }
              }
            } );
          },
        "footerCallback": function ( row, data, start, end, display ) {
          var api = this.api(), data;

            // converting to interger to find total
            var intVal = function ( i ) {
              return typeof i === 'string' ?
              i.replace(/[\$,]/g, '')*1 :
              typeof i === 'number' ?
              i : 0;
            };

            var total_sites =0;
            // Total over this page
            pageTotal = api
            .column( 0, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
              return total_sites++;
            }, 0 );

            // computing column Total of the complete result 

           var remaining_bill = api
            .column( 8 )
            .data()
            .reduce( function (a, b) {
              return parseFloat(a) + parseFloat(b);
            }, 0 );

             /*var price = api
            .column( 6 )
            .data()
            .reduce( function (a, b) {
              return parseFloat(a) + parseFloat(b);
            }, 0 );*/

            


            // Update footer by showing the total with the reference of the column index 
            $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 1).footer() ).html(total_sites+' sites');
            $( api.column( 6 ).footer() ).html(numberFormat(remaining_bill));

          },

        });
     $('#execution_table').on( 'click', 'tbody tr.clickable-row', function () {
        window.location.href = $(this).data('href');
      });

     /*----------------------  end construction table------------------*/

     table = $('#end_construction_table').DataTable({ 
      "pageLength": 10,
      "bInfo": true,
      "oLanguage": {
        "oPaginate": {
          "sFirst": "First page", // This is the link to the first page
          "sPrevious": "Précédent", // This is the link to the previous page
          "sNext": "Suivant", // This is the link to the next page
          "sLast": "Last page" // This is the link to the last page
        },
        "infoFiltered": "(filtered from _MAX_ total records)",
        "sSearch": "Recherche:",
        "sLengthMenu": "Montre _MENU_ éléments",
        "sZeroRecords": "No record found!",
        "sInfo": "Montre _START_ à _END_ des _TOTAL_ éléments",
        "sInfoEmpty": "_TOTAL_ éléments",
        
      },
      "fnDrawCallback": function(oSettings) {                 
        if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
          $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
        }
      },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": SURL+"admin/endconstruction/get_completed_sites/",
          "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [ 
          { "targets": [0],"orderable": false,},
         { "targets": [1],"orderable": false,},
         //{ "targets": [2],"orderable": false,},
         { "targets": [3],"orderable": false,},
         { "targets": [4],"orderable": false,},
         //{ "targets": [5],"orderable": false,},
        // { "targets": [6],"orderable": false,},
         { "targets": [7],"orderable": false,"visible": false},
         { "targets": [8],"orderable": false,"visible": false},
        ],
        'createdRow': function( row, data, dataIndex ) {
          var row_id = $(row).find("#row_id").val();
          $(row).attr('class', 'clickable-row');
          $(row).attr('data-href', SURL+'admin/endconstruction/detail/'+row_id);

        },
         initComplete: function () {
            this.api().columns().every( function (i) {
                
                if(i==3 || i==4 ){
                var column = this;
                var select_text='';
                if(i==3){
                  select_text='Marché';
                }else if(i==4){
                  select_text='Client';
                }
                var select = $('<select><option value="">'+select_text+'</option></select>')
                    .appendTo( $(column.header()))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                        .search( val ? val: '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                  if(d){
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                  }
                   
                } );
              }
            } );
          },
        "footerCallback": function ( row, data, start, end, display ) {
          var api = this.api(), data;

            // converting to interger to find total
            var intVal = function ( i ) {
              return typeof i === 'string' ?
              i.replace(/[\$,]/g, '')*1 :
              typeof i === 'number' ?
              i : 0;
            };

            var total_sites =0;
            // Total over this page
            pageTotal = api
            .column( 0, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
              return total_sites++;
            }, 0 );
            // computing column Total of the complete result 
             var hours=0;
            hours = api
            .column( 7 )
            .data()
            .reduce( function (a, b) {
              return parseFloat(a) + parseFloat(b);
            }, 0 );

            var price = api
            .column( 8 )
            .data()
            .reduce( function (a, b) {
              return parseFloat(a) + parseFloat(b);
            }, 0 );

            

            // Update footer by showing the total with the reference of the column index 
            $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 1 ).footer() ).html(total_sites+' sites');
            $( api.column( 5 ).footer() ).html((hours>0) ? convertToHHMM(hours) : '00h00');
            $( api.column( 6 ).footer() ).html(numberFormat(price));

          },

        });

      $('#end_construction_table').on( 'click', 'tbody tr.clickable-row', function () {
        window.location.href = $(this).data('href');
      });


     /*----------------------  User management table------------------*/
     table = $('#users_table').DataTable({ 
      "pageLength": 10,
      "bInfo": true,
      "oLanguage": {
        "oPaginate": {
          "sFirst": "First page", // This is the link to the first page
          "sPrevious": "Précédent", // This is the link to the previous page
          "sNext": "Suivant", // This is the link to the next page
          "sLast": "Last page" // This is the link to the last page
        },
        "infoFiltered": "(filtered from _MAX_ total records)",
        "sSearch": "Recherche:",
        "sLengthMenu": "Montre _MENU_ éléments",
        "sZeroRecords": "No record found!",
        "sInfo": "Montre _START_ à _END_ des _TOTAL_ éléments",
        "sInfoEmpty": "_TOTAL_ éléments",
        
      },
      "fnDrawCallback": function(oSettings) {                 
        if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
          $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
        }
      },

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": SURL+"admin/users/get_users/",
          "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [ 
        { "targets": [ 0],"orderable": false,},
        { "targets": [4],"orderable": false,},
       
        ],
        'createdRow': function( row, data, dataIndex ) {
          var row_id = $(row).find("#row_id").val();
          $(row).attr('class', 'clickable-row');
          $(row).attr('data-href', SURL+'admin/users/edit/'+row_id);

        },
      }); 
     $('#users_table').on( 'click', 'tbody tr.clickable-row', function () {
        window.location.href = $(this).data('href');
      });


     /*----------------------  employee management table------------------*/
     table = $('#employees_table').DataTable({       
      "pageLength": 10,
      "bInfo": true,
      "oLanguage": {
        "oPaginate": {
          "sFirst": "First page", // This is the link to the first page
          "sPrevious": "Précédent", // This is the link to the previous page
          "sNext": "Suivant", // This is the link to the next page
          "sLast": "Last page" // This is the link to the last page
        },
        "infoFiltered": "(filtered from _MAX_ total records)",
        "sSearch": "Recherche:",
        "sLengthMenu": "Montre _MENU_ éléments",
        "sZeroRecords": "No record found!",
        "sInfo": "Montre _START_ à _END_ des _TOTAL_ éléments",
        "sInfoEmpty": "_TOTAL_ éléments",
        
      },
      "fnDrawCallback": function(oSettings) {                 
        if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
          $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
        }
      },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": SURL+HR+"/employees/get_employees/",
          "type": "POST"
        },


        //Set column definition initialisation properties.
        "columnDefs": [ 
        { "targets": [ 0],"orderable": false,},
       { "targets": [ 3],"orderable": false,},
        ],

        'createdRow': function( row, data, dataIndex ) {
          var row_id = $(row).find("#row_id").val();
          $(row).attr('class', 'clickable-row');
          $(row).attr('data-href', SURL+HR+'/employees/edit/'+row_id);

        },
         initComplete: function () {
            this.api().columns().every( function (i) {
                
                if(i==3 ){
                var column = this;
                var select_text='';
                if(i==3){
                  select_text='Statut';
                }
                var select = $('<select><option value="">'+select_text+'</option></select>')
                    .appendTo( $(column.header()))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                        .search( val ? val: '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                  if(d){
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                  }
                   
                } );
              }
            } );
          },

        }); 

      $('#employees_table').on( 'click', 'tbody tr.clickable-row', function () {
        window.location.href = $(this).data('href');
      });

      /*----------------- working hours employee--------------------*/
      table = $('#working_employee_table').DataTable({ 
      "pageLength": 10,
      "bInfo": true,
      "oLanguage": {
        "oPaginate": {
          "sFirst": "First page", // This is the link to the first page
          "sPrevious": "Précédent", // This is the link to the previous page
          "sNext": "Suivant", // This is the link to the next page
          "sLast": "Last page" // This is the link to the last page
        },
        "infoFiltered": "(filtered from _MAX_ total records)",
        "sSearch": "Recherche:",
        "sLengthMenu": "Montre _MENU_ éléments",
        "sZeroRecords": "No record found!",
        "sInfo": "Montre _START_ à _END_ des _TOTAL_ éléments",
        "sInfoEmpty": "_TOTAL_ éléments",
        
      },
      "fnDrawCallback": function(oSettings) {                 
        if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
          $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
        }
      },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": SURL+"human_resource/working_hours/get_employees/",
          "type": "POST",
          data: function(d){
            d.month_id = $('#month_filter').val();            
        },
        },

        //Set column definition initialisation properties.
        "columnDefs": [ 
        { "targets": 0,"orderable": false,},
        { "targets": [1],"orderable": false,},
        { "targets": [2],"orderable": false,},
        //{ "targets": [3],"orderable": false,},  
        //{ "targets": [4],"orderable": false,}, 
        //{ "targets": [5],"orderable": false,}, 
        ],

        'createdRow': function( row, data, dataIndex ) {
          var row_id = $(row).find("#row_id").val();
          $(row).attr('class', 'clickable-row');
          $(row).attr('data-href', SURL+'human_resource/working_hours/employee_hours/'+row_id);

        },
       
        
        });

      $('#working_employee_table').on( 'click', 'tbody tr.clickable-row', function () {
        window.location.href = $(this).data('href');
      }); 

      $('<select class="form-control" id="month_filter">'+
      '<option>select</option>'+
      '<option value="1">Jan</option>'+
      '<option value="2">Feb</option>'+
      '<option value="3">Mar</option>'+
      '<option value="4">Apr</option>'+
      '<option value="5">May</option>'+
      '<option value="6">Jun</option>'+
      '<option value="7">Jul</option>'+
      '<option value="8">Aug</option>'+
      '<option value="9">Sep</option>'+
      '<option value="10">Oct</option>'+
      '<option value="11">Nov</option>'+
      '<option value="12">Dec</option>'+
    '</select>').appendTo("#working_employee_table_wrapper #working_employee_table_length");

      $('#month_filter').on('change', function () {
         $('#working_employee_table').DataTable().ajax.reload();
    } );

     /*----------------- working hours site--------------------*/
      table = $('#working_sites_table').DataTable({ 
      "pageLength": 10,
      "bInfo": true,
      "oLanguage": {
        "oPaginate": {
          "sFirst": "First page", // This is the link to the first page
          "sPrevious": "Précédent", // This is the link to the previous page
          "sNext": "Suivant", // This is the link to the next page
          "sLast": "Last page" // This is the link to the last page
        },
        "infoFiltered": "(filtered from _MAX_ total records)",
        "sSearch": "Recherche:",
        "sLengthMenu": "Montre _MENU_ éléments",
        "sZeroRecords": "No record found!",
        "sInfo": "Montre _START_ à _END_ des _TOTAL_ éléments",
        "sInfoEmpty": "_TOTAL_ éléments",
        
      },
      "fnDrawCallback": function(oSettings) {                 
        if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
          $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
        }
      },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": SURL+"human_resource/working_hours/get_sites/",
          "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [ 
        { "targets": 0,"orderable": false,},
        { "targets": [1],"orderable": false,},
        { "targets": [2],"orderable": false,},
       // { "targets": [3],"orderable": false,},  
      //  { "targets": [4],"orderable": false,}, 
       // { "targets": [5],"orderable": false,}, 
        ],

        'createdRow': function( row, data, dataIndex ) {
          var row_id = $(row).find("#row_id").val();
          $(row).attr('class', 'clickable-row');
          $(row).attr('data-href', SURL+'human_resource/working_hours/site_hours/'+row_id);

        },
       
        
        });

     $('#working_sites_table').on( 'click', 'tbody tr.clickable-row', function () {
        window.location.href = $(this).data('href');
      }); 


      /*----------------- working site manager--------------------*/
      table = $('#manager_sites_table').DataTable({ 
      "pageLength": 10,
      "bInfo": true,
      "oLanguage": {
        "oPaginate": {
          "sFirst": "First page", // This is the link to the first page
          "sPrevious": "Précédent", // This is the link to the previous page
          "sNext": "Suivant", // This is the link to the next page
          "sLast": "Last page" // This is the link to the last page
        },
       "infoFiltered": "(filtered from _MAX_ total records)",
        "sSearch": "Recherche:",
        "sLengthMenu": "Montre _MENU_ éléments",
        "sZeroRecords": "No record found!",
        "sInfo": "Montre _START_ à _END_ des _TOTAL_ éléments",
        "sInfoEmpty": "_TOTAL_ éléments",
      },
      "fnDrawCallback": function(oSettings) {                 
        if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
          $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
        }
      },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": SURL+"site_manager/sites/get_manager_sites/",
          "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [ 
        { "targets": 0,"orderable": false,},
        { "targets": [1],"orderable": false,},
       // { "targets": [2],"orderable": false,},
        //{ "targets": [3],"orderable": false,},  
       // { "targets": [4],"orderable": false,}, 
        { "targets": [5],"orderable": false,}, 
        ],

        'createdRow': function( row, data, dataIndex ) {
          var row_id = $(row).find("#row_id").val();
          $(row).attr('class', 'clickable-row');
          $(row).attr('data-href', SURL+'site_manager/sites/detail/'+row_id);

        },
         initComplete: function () {
            this.api().columns().every( function (i) {
                
                if( i==5 ){
                var column = this;
                var select_text='';
                if(i==5){
                  select_text='En-cours';
                }
                var select = $('<select><option value="">'+select_text+'</option></select>')
                    .appendTo( $(column.header()))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                        .search( val ? val: '', true, false )
                            .draw();
                    } );
 
                if(i==5){                  
                       select.append( '<option value="green">Vert</option><option value="orange">Jaune</option><option value="red">Rouge</option>' );
                }else{
                column.data().unique().sort().each( function ( d, j ) {
                  if(d){
                    select.append( '<option value="'+d+'">'+d+'</option>' )                  
                  }
                   
                } );
              }
              }
            } );
          },
       
        
        });

     $('#manager_sites_table').on( 'click', 'tbody tr.clickable-row', function () {
        window.location.href = $(this).data('href');
      });   


     /*----------------- CAUTION SITES--------------------*/
      table = $('#caution_sites_table').DataTable({ 
      "pageLength": 10,
      "bInfo": true,
      "oLanguage": {
        "oPaginate": {
          "sFirst": "First page", // This is the link to the first page
          "sPrevious": "Précédent", // This is the link to the previous page
          "sNext": "Suivant", // This is the link to the next page
          "sLast": "Last page" // This is the link to the last page
        },
        "infoFiltered": "(filtered from _MAX_ total records)",
        "sSearch": "Recherche:",
        "sLengthMenu": "Montre _MENU_ éléments",
        "sZeroRecords": "No record found!",
        "sInfo": "Montre _START_ à _END_ des _TOTAL_ éléments",
        "sInfoEmpty": "_TOTAL_ éléments",
        
      },
      "fnDrawCallback": function(oSettings) {                 
        if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
          $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
        }
      },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": SURL+"human_resource/caution/get_sites/",
          "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [ 
        { "targets": 0,"orderable": false,},
        { "targets": [1],"orderable": false,},
        { "targets": [2],"orderable": false,},
        { "targets": [3],"orderable": false,},  
        { "targets": [4],"orderable": false,}, 
        { "targets": [5],"orderable": false,}, 
        { "targets": [6],"orderable": false,}, 
        { "targets": [7],"orderable": false,}, 
        ],

        'createdRow': function( row, data, dataIndex ) {
          var row_id = $(row).find("#row_id").val();
          $(row).attr('class', 'clickable-row');
          $(row).attr('data-href', SURL+'human_resource/caution/detail/'+row_id);

        },
       
        
        });

     $('#caution_sites_table').on( 'click', 'tbody tr.clickable-row', function () {
        window.location.href = $(this).data('href');
      });   

     /*------------------ documents----------*/
     table = $('#exec_document_table').DataTable({ 
      "pageLength": 10,
      "bInfo": true,
      "oLanguage": {
        "oPaginate": {
          "sFirst": "First page", // This is the link to the first page
          "sPrevious": "Précédent", // This is the link to the previous page
          "sNext": "Suivant", // This is the link to the next page
          "sLast": "Last page" // This is the link to the last page
        },
        "infoFiltered": "(filtered from _MAX_ total records)",
        "sSearch": "Recherche:",
        "sLengthMenu": "Montre _MENU_ éléments",
        "sZeroRecords": "No record found!",
        "sInfo": "Montre _START_ à _END_ des _TOTAL_ éléments",
        "sInfoEmpty": "_TOTAL_ éléments",
        
      },
      "fnDrawCallback": function(oSettings) {                 
        if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
          $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
        }
      },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": SURL+"admin/execution/get_documents/"+referenceNo,
          "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [ 
        { "targets": 0,"orderable": true},
        { "targets": [1],"orderable": false,},
        { "targets": [2],"orderable": true,},
        { "targets": [3],"orderable": true}
        ],
       
        
        });

     /*------------------ site manager documents----------*/
     table = $('#manager_document_table').DataTable({ 
      "pageLength": 10,
      "bInfo": true,
      "oLanguage": {
        "oPaginate": {
          "sFirst": "First page", // This is the link to the first page
          "sPrevious": "Précédent", // This is the link to the previous page
          "sNext": "Suivant", // This is the link to the next page
          "sLast": "Last page" // This is the link to the last page
        },
        "infoFiltered": "(filtered from _MAX_ total records)",
        "sSearch": "Recherche:",
        "sLengthMenu": "Montre _MENU_ éléments",
        "sZeroRecords": "No record found!",
        "sInfo": "Montre _START_ à _END_ des _TOTAL_ éléments",
        "sInfoEmpty": "_TOTAL_ éléments",
        
      },
      "fnDrawCallback": function(oSettings) {                 
        if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
          $(oSettings.nTableWrapper).find('.dataTables_paginate').show();
        }
      },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": SURL+"site_manager/sites/get_documents/"+referenceNo,
          "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [ 
        { "targets": 0,"orderable": true},
        { "targets": [1],"orderable": false,},
        { "targets": [2],"orderable": true,},
        { "targets": [3],"orderable": true}
        ],
       
        
        });


   });
/*------------ clickable row start-------*/
$(document).ready(function() {

  $("tr.clickable-row").click(function() {
    window.location = $(this).data("href");
  });

  $('tr.clickable-row input').click(function(e) {
    e.stopPropagation();
  });
  $('tr.clickable-row textarea').click(function(e) {
    e.stopPropagation();
  });

});

$("tr.clickable-row").click(function() {
    window.location = $(this).data("href");
  });

  $('tr.clickable-row input').click(function(e) {
    e.stopPropagation();
  });
  $('tr.clickable-row textarea').click(function(e) {
    e.stopPropagation();
  });

/*------------ clickable row end-------*/


function readURL(input) {
 if (input.files && input.files[0]) {
   var reader = new FileReader();

   reader.onload = function (e) {
     $('#uploaded_image')
     .attr('src', e.target.result);
   };

   reader.readAsDataURL(input.files[0]);
 }
}

function get_path(){
      var filename = $('#status_file')[0].files.length ? ('#status_file')[0].files: "";
      console.log(filename);

}

/*--------------- function to format money------------*/
function numberFormat(amount){

    var locale = 'de';
    var options = {style: 'currency', currency: 'eur', minimumFractionDigits: 2, maximumFractionDigits: 2};
    var formatter = new Intl.NumberFormat(locale, options);
    return formatter.format(amount);
}

function print_price_sheet(print_schedule)
    {

      var printContents = document.getElementById(print_schedule).innerHTML;
      document.getElementById('printable').innerHTML = printContents;
      window.print();
      document.getElementById('printable').innerHTML = '';
}

function print_schedule(print_schedule)
    {

      var header = '';
       header +='<tr>';
      $("#employee_schedule_table thead tr").each(function() {
        $(this).find('th:not(:last-child)').each(function() {
              //alert($(this).find(':first-child').html());
              header +='<th>';
                header +=$(this).html();              
              header +='</th>';
            });
      });
       header +='<tr>';
      var tbody = '';
      $("#employee_schedule_table tbody tr ").each(function(i,v) {   
      var td_count = $(this).find('td').length;    
          tbody +='<tr>';
          
          if(td_count==9){
          tbody +='<td rowspan="2" valign="top" style="height:20px;">';
           tbody +=$(this).find('td:first-child').html();
            tbody +='</td>';
            $(this).find('td:not(:first-child, :last-child)').each(function() {
              tbody +='<td>';
              tbody +=($(this).find('button').attr('title')) ? $(this).find('button').attr('title') : '&nbsp;';   
              tbody +='</td>';
            });
         }else if(td_count==8){
         // tbody +='<td>&nbsp;</td>';
          $(this).find('td:not(:last-child)').each(function() {
             tbody +='<td>';
              tbody +=($(this).find('button').attr('title')) ? $(this).find('button').attr('title') : '&nbsp;';   
              tbody +='</td>';
            });
         }
            
            tbody +='</tr>';
            //alert(tbody);
      });
      //alert(header);

      var table = '<table border="1" id="employee_schedule_table" style="width:100%;"><thead>'+header+'</thead><tbody>'+tbody+'</tbody></table>'

     // var printContents = document.getElementById(print_schedule).innerHTML;
      document.getElementById('printable').innerHTML = table;
      window.print();
      document.getElementById('printable').innerHTML = '';
    }

setInterval(function(){ 
    update_token();
  }, 60000);

  function update_token(){
      var request_url = SURL+"/admin/administrator/update_token/";
       $.ajax({
        method: "POST",
        url: request_url,
       // data: "offer_ids="+offer_ids,
      }).done(function (result) {   
                 
              });
   }

</script>


<div id="printable"></div>