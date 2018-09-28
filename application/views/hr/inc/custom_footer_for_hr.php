<!-- add new site popup-->
<div class="modal in" id="modal_add_site" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm" style="width: 500px;">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #333;color: #FFF;">
				<h3 class="modal-title"><b><?php echo ADD_NEW_CONSTRUCTION_SITE;?></b></h3>
			</div>
			<div class="modal-body">
				<form method="post" action="#" id="add_site_form">
					<div class="col-md-12 col-sm-12">

						<div class="form-group">
							<label for="refference"><?php echo REFERENCE;?>:</label>
							<input type="text" pattern="[0-9\-]+" class="form-control" id="reference" name="reference" required="required" placeholder="<?php echo REFERENCE;?>">
						</div>
						<div class="form-group">
							<label for="description"><?php echo DESCRIPTION;?>:</label>
							<input type="text" class="form-control" id="description" name="description" required="required" placeholder="<?php echo DESCRIPTION;?>">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-round btn-danger" data-dismiss="modal"><?php echo CANCEL_BTN;?></button>
				<a class="btn btn-info btn-round btn-ok" id="add_new_site"><?php echo ADD_BTN;?></a>
			</div>
		</div>
	</div>
</div>

<div class="modal in" id="modal_error" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm" style="width: 500px;">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #333;color: #FFF;">
				<h3 class="modal-title"><b>Error</b></h3>
			</div>
			<div class="modal-body">
				<form method="post" action="#" id="add_site_form">
					<div class="col-md-12 col-sm-12">
						<p id="error_spam">error</p>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-round btn-danger" data-dismiss="modal"><?php echo CANCEL_BTN;?></button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	/*------------------- schedule calendar functions----------------*/
	/*-------------- for next-----------*/
	$("#schedule_next").click(function(){
		var current_week = $("#schedule_calendar").find(".worker_box .current").val();
		var last_week = $("#schedule_calendar").find(".worker_box .last").val();
		var year = $("#schedule_calendar").find(".worker_box .year.last").val();

	//alert('current:'+current_week+' last:'+last_week+' year:'+year);

	var request_url = SURL+"human_resource/working_hours/schedule_next";
	$.ajax({
		method: "POST",
		url: request_url,
		data: "current_week="+current_week+"&last_week="+last_week+"&year="+year,
	}).done(function (response) {
		var html = '';
		var result = JSON.parse(response,true);

		var j=1;
		$.each(result,function(i,v){
			var active = (j==1) ? 'active' : '';
			var current = (j==1) ? 'current' : '';
			var last = (j==6) ? 'last' : '';
			if(j==1){	  				
				load_schedule(this,v.week,v.year);
			}
			html+='<td>'+
			'<div class="worker_box '+active+'" onclick="load_schedule(this,'+v.week+','+v.year+')">'+	
			'<input type="hidden" name="week" class="week '+current+''+last+'" value="'+v.week+'">'+
			'<input type="hidden" name="year" class="year '+current+''+last+'" value="'+v.year+'">'+				
			'<span class="name">'+v.label+'</span>'+
			'<span class="profile">'+v.dates+'</span>'+
			'</div>'+
			'</td>';
			j++;})

		$("#schedule_calendar tr").html(html);

	});


})	;


	/*-------------- for prev -----------*/
	$("#schedule_prev").click(function(){
		var current_week = $("#schedule_calendar").find(".worker_box .current").val();
		var last_week = $("#schedule_calendar").find(".worker_box .last").val();
		var year = $("#schedule_calendar").find(".worker_box .year.current").val();

	//alert('current:'+current_week+' last:'+last_week+' year:'+year);

	var request_url = SURL+"human_resource/working_hours/schedule_prev";
	$.ajax({
		method: "POST",
		url: request_url,
		data: "current_week="+current_week+"&last_week="+last_week+"&year="+year,
	}).done(function (response) {
		var html = '';
		var result = JSON.parse(response,true);

		var j=1;
		$.each(result,function(i,v){
			var active = (j==1) ? 'active' : '';
			var current = (j==1) ? 'current' : '';
			var last = (j==6) ? 'last' : '';
			if(j==1){	  				
				load_schedule(this,v.week,v.year);
			}
			html+='<td>'+
			'<div class="worker_box '+active+'" onclick="load_schedule(this,'+v.week+','+v.year+')">'+	
			'<input type="hidden" name="week" class="week '+current+''+last+'" value="'+v.week+'">'+
			'<input type="hidden" name="year" class="year '+current+''+last+'" value="'+v.year+'">'+				
			'<span class="name">'+v.label+'</span>'+
			'<span class="profile">'+v.dates+'</span>'+
			'</div>'+
			'</td>';
			j++;})

		$("#schedule_calendar tr").html(html);

	});


})	;

	/*------------------- Site calendar functions----------------*/
	/*-------------- for next-----------*/
	$("#site_next").click(function(){
		var current_week = $("#site_calendar").find(".worker_box .current").val();
		var last_week = $("#site_calendar").find(".worker_box .last").val();
		var year = $("#site_calendar").find(".worker_box .year.last").val();

	//alert('current:'+current_week+' last:'+last_week+' year:'+year);

	var request_url = SURL+"human_resource/working_hours/schedule_next";
	$.ajax({
		method: "POST",
		url: request_url,
		data: "current_week="+current_week+"&last_week="+last_week+"&year="+year,
	}).done(function (response) {
		var html = '';
		var result = JSON.parse(response,true);

		var j=1;
		$.each(result,function(i,v){
			var active = (j==1) ? 'active' : '';
			var current = (j==1) ? 'current' : '';
			var last = (j==6) ? 'last' : '';
			if(j==1){	  				
				load_weekly_sitedata(this,v.week,v.year);
			}
			html+='<td>'+
			'<div class="worker_box '+active+'" onclick="load_weekly_sitedata(this,'+v.week+','+v.year+')">'+	
			'<input type="hidden" name="week" class="week '+current+''+last+'" value="'+v.week+'">'+
			'<input type="hidden" name="year" class="year '+current+''+last+'" value="'+v.year+'">'+				
			'<span class="name">'+v.label+'</span>'+
			'<span class="profile">'+v.dates+'</span>'+
			'</div>'+
			'</td>';
			j++;})

		$("#site_calendar tr").html(html);

	});


})	;


	/*-------------- for prev -----------*/
	$("#site_prev").click(function(){
		var current_week = $("#site_calendar").find(".worker_box .current").val();
		var last_week = $("#site_calendar").find(".worker_box .last").val();
		var year = $("#site_calendar").find(".worker_box .year.current").val();

	//alert('current:'+current_week+' last:'+last_week+' year:'+year);

	var request_url = SURL+"human_resource/working_hours/schedule_prev";
	$.ajax({
		method: "POST",
		url: request_url,
		data: "current_week="+current_week+"&last_week="+last_week+"&year="+year,
	}).done(function (response) {
		var html = '';
		var result = JSON.parse(response,true);

		var j=1;
		$.each(result,function(i,v){
			var active = (j==1) ? 'active' : '';
			var current = (j==1) ? 'current' : '';
			var last = (j==6) ? 'last' : '';
	  				// load weekly data for active week
	  				if(j==1){	  				
	  					load_weekly_sitedata(this,v.week,v.year);
	  				}
	  				html+='<td>'+
	  				'<div class="worker_box '+active+'" onclick="load_weekly_sitedata(this,'+v.week+','+v.year+')">'+	
	  				'<input type="hidden" name="week" class="week '+current+''+last+'" value="'+v.week+'">'+
	  				'<input type="hidden" name="year" class="year '+current+''+last+'" value="'+v.year+'">'+				
	  				'<span class="name">'+v.label+'</span>'+
	  				'<span class="profile">'+v.dates+'</span>'+
	  				'</div>'+
	  				'</td>';
	  				j++;})

		$("#site_calendar tr").html(html);

	});


})	;

	/*------------------- employee calendar functions----------------*/
	/*-------------- for next-----------*/
	$("#employee_next").click(function(){
		var current_week = $("#employee_calendar").find(".worker_box .current").val();
		var last_week = $("#employee_calendar").find(".worker_box .last").val();
		var year = $("#employee_calendar").find(".worker_box .year.last").val();

	//alert('current:'+current_week+' last:'+last_week+' year:'+year);

	var request_url = SURL+"human_resource/working_hours/schedule_next";
	$.ajax({
		method: "POST",
		url: request_url,
		data: "current_week="+current_week+"&last_week="+last_week+"&year="+year,
	}).done(function (response) {
		var html = '';
		var result = JSON.parse(response,true);

		var j=1;
		$.each(result,function(i,v){
			var active = (j==1) ? 'active' : '';
			var current = (j==1) ? 'current' : '';
			var last = (j==6) ? 'last' : '';

	  				// load weekly data for active week
	  				if(j==1){	  				
	  					load_weekly_userdata(this,v.week,v.year);
	  				}

	  				html+='<td>'+
	  				'<div class="worker_box '+active+'" onclick="load_weekly_userdata(this,'+v.week+','+v.year+')">'+	
	  				'<input type="hidden" name="week" class="week '+current+''+last+'" value="'+v.week+'">'+
	  				'<input type="hidden" name="year" class="year '+current+''+last+'" value="'+v.year+'">'+				
	  				'<span class="name">'+v.label+'</span>'+
	  				'<span class="profile">'+v.dates+'</span>'+
	  				'</div>'+
	  				'</td>';
	  				j++;})

		$("#employee_calendar tr").html(html);

	});


})	;


	/*-------------- for prev -----------*/
	$("#employee_prev").click(function(){
		var current_week = $("#employee_calendar").find(".worker_box .current").val();
		var last_week = $("#employee_calendar").find(".worker_box .last").val();
		var year = $("#employee_calendar").find(".worker_box .year.current").val();

	//alert('current:'+current_week+' last:'+last_week+' year:'+year);

	var request_url = SURL+"human_resource/working_hours/schedule_prev";
	$.ajax({
		method: "POST",
		url: request_url,
		data: "current_week="+current_week+"&last_week="+last_week+"&year="+year,
	}).done(function (response) {
		var html = '';
		var result = JSON.parse(response,true);

		var j=1;
		$.each(result,function(i,v){
			var active = (j==1) ? 'active' : '';
			var current = (j==1) ? 'current' : '';
			var last = (j==6) ? 'last' : '';

	  				// load weekly data for active week
	  				if(j==1){	  				
	  					load_weekly_userdata(this,v.week,v.year);
	  				}
	  				
	  				html+='<td>'+
	  				'<div class="worker_box '+active+'" onclick="load_weekly_userdata(this,'+v.week+','+v.year+')">'+	
	  				'<input type="hidden" name="week" class="week '+current+''+last+'" value="'+v.week+'">'+
	  				'<input type="hidden" name="year" class="year '+current+''+last+'" value="'+v.year+'">'+				
	  				'<span class="name">'+v.label+'</span>'+
	  				'<span class="profile">'+v.dates+'</span>'+
	  				'</div>'+
	  				'</td>';
	  				j++;})


		$("#employee_calendar tr").html(html);

	});


})	;

	/*-----------import securysat-------------*/
function employee_prev(data_id){
	var total_user = $("#secursat_user_table tr td").length;
	if(data_id>=1 && data_id<=total_user){
	load_user_data(data_id);
	var prev_user = (data_id>1) ? data_id - 1 : data_id;
	var next_user = prev_user + 1;
	$(".worker_box").removeClass('active');
	$("#data_id_"+data_id).addClass('active');
	$("#validate_btn").attr('onclick','validate_securysat_row('+data_id+')');
	$("#absent_btn").attr('onclick','add_absent('+data_id+')');
	$("#employee_prev").attr('onclick','employee_prev('+prev_user+')');
	$("#employee_next").attr('onclick','employee_next('+next_user+')');
	var leftPos = $('div#scroll_div').scrollLeft();
  $("div#scroll_div").animate({scrollLeft: leftPos - 200}, 800);
	}else{
		alert('no data');
	}
}
function employee_next(data_id){
	var total_user = $("#secursat_user_table tr td").length;
	if(data_id>=1 && data_id<=total_user){
	load_user_data(data_id);
	var next_user = (data_id<total_user) ? data_id + 1 : data_id;
	var prev_user = (data_id<total_user) ? data_id - 1 : next_user - 1;

	$(".worker_box").removeClass('active');
	$("#data_id_"+data_id).addClass('active');
	$("#validate_btn").attr('onclick','validate_securysat_row('+data_id+')');
	$("#absent_btn").attr('onclick','add_absent('+data_id+')');
	$("#employee_prev").attr('onclick','employee_prev('+prev_user+')');
	$("#employee_next").attr('onclick','employee_next('+next_user+')');
	 /*var pos = $('div#scroll_div').scrollLeft() + 200;
    $('div#scroll_div').scrollLeft(pos);*/
    var leftPos = $('div#scroll_div').scrollLeft();
  $("div#scroll_div").animate({scrollLeft: leftPos + 200}, 800);
	}else{
		alert('no data');
	}
}

function get_user_data(data_id){
		var name = $("#data_id_"+data_id+" .name").text();
	//alert(data_id+' - '+name);
	load_user_data(data_id);
	$(".worker_box").removeClass('active');
	$("#data_id_"+data_id).addClass('active');
	$("#validate_btn").attr('onclick','validate_securysat_row('+data_id+')');
	$("#absent_btn").attr('onclick','add_absent('+data_id+')');
}

function validate_securysat_row(data_id){
	var total_user = $("#secursat_user_table tr td").length;
	var name = $("#data_id_"+data_id+" .name").text();

	$("#secursat_user_data tfoot tr td #user_name").val(name);
	var request_url = SURL+"human_resource/importdata/post_user_data";
	$.post( request_url, $( "#user_data_form" ).serialize())
	.done(function( data ) {
		if(data=='OK'){
			$("#data_id_"+data_id).addClass('valid');
			if(data_id<total_user) {
				data_id++;
				get_user_data(data_id);
			}else{
				delete_temp_data();
			}
		}else{
			//alert('Something wrong');
			$("#modal_error #error_spam").html('Aucun site n’est sélectionné. Merci d’en sélectionner et valider à nouveau.');
			$("#modal_error").modal('show');
		}
	});	
}

function add_absent(data_id){
	var total_user = $("#secursat_user_table tr td").length;
	var name = $("#data_id_"+data_id+" .name").text();

	$("#secursat_user_data tfoot tr td #user_name").val(name);

	var request_url = SURL+"human_resource/importdata/add_absent";
	$.post( request_url, 'name='+name)
	.done(function( data ) {
		if(data=='OK'){
			$("#data_id_"+data_id).removeClass('valid');
			if(data_id<total_user) {
				data_id++;
				get_user_data(data_id);
			}else{
				delete_temp_data();
			}
		}else{
			alert('Something wrong');
		}
	});	
}

/*$("#site").change(function(){
	var value = $(this).val();
	if(value=='add_new_site'){
		get_next_site_refernce();
	}
});*/

function add_new_site(value,row_id){
	if(value=='add_new_site'){
		get_next_site_refernce();
	}
}

function load_user_data(userid){

	var request_url = SURL+"human_resource/importdata/get_user_data/"+userid;
	$.ajax({
		method: "POST",
		url: request_url,
	   // data: "",
	}).done(function (response) {
		var html = '';
		var result = JSON.parse(response,true);
	  			//alert(response);	  			
	  			$("#secursat_user_data tbody").html(result.html);
	  			$("#secursat_user_data tfoot").html(result.tfooter);
	  			
	  			$('.selectpicker').selectpicker('refresh');

				});

}


function get_next_site_refernce(){

	var request_url = SURL+"human_resource/importdata/get_next_site_refernce";
	$.ajax({
		method: "POST",
		url: request_url,
				   // data: "checked_rows="+checked,
				}).done(function (response) {

					$("#modal_add_site").modal('show');
					$("#modal_add_site").find("#reference").val(response);
				});
}

$("#add_new_site").click(function(){
	var reference = $("#add_site_form #reference").val();
	var description = $("#add_site_form #description").val();
	if(reference=='' || description==''){
		if(reference==''){
			$("#add_site_form #reference").css("border", "1px solid red");
		}else{
			$("#add_site_form #reference").css("border", "1px solid #ccc");
		}
		if(description==''){
			$("#add_site_form #description").css("border", "1px solid red");
		}else{
			$("#add_site_form #reference").css("border", "1px solid #ccc");
		}
	}else{
		var userid = $(".worker_box.active").attr("userid");
		var request_url = SURL+"human_resource/importdata/add_new_site";
		$.ajax({
			method: "POST",
			url: request_url,
			data: $( "#add_site_form" ).serialize(),
		}).done(function (response) {
			if(response=='OK'){
				$("#modal_add_site").modal('hide');
				get_user_data(userid);
			}

		});
	}

})


function delete_temp_data(){

	var request_url = SURL+"human_resource/importdata/delete_temp_data";
	$.ajax({
		method: "POST",
		url: request_url,
// data: "",
}).done(function (response) {

		if(response=='OK'){
			window.location.href = SURL+'human_resource/working_hours/employees';
		}
	});

}

function load_weekly_sitedata(thisDiv,week,year){
	$(".worker_box").removeClass('active');
	$(thisDiv).addClass('active');
	var site_id = $("#site_id").val();

	var request_url = SURL+"human_resource/working_hours/load_weekly_sitedata/"+site_id+"/"+week+"/"+year;
	$.ajax({
		method: "POST",
		url: request_url,
	   // data: "",
	}).done(function (response) {
		var html = '';
		var result = JSON.parse(response,true);
	  			//alert(response);	  			
	  			$("#site_hour_table tbody").html(result.html);
	  			$("#site_hour_table tfoot").html(result.footer);
	  		});
}

function load_weekly_userdata(thisDiv,week,year){

	$(".worker_box").removeClass('active');
	$(thisDiv).addClass('active');
	var userid = $(".employee_hour_table #userid").val();

	var request_url = SURL+"human_resource/working_hours/load_weekly_userdata/"+userid+"/"+week+"/"+year;
	$.ajax({
		method: "POST",
		url: request_url,
	   // data: "",
	}).done(function (response) {
		var html = '';
		var result = JSON.parse(response,true);
	  			//alert(response);	  			
	  			$("#employee_hour_table tbody").html(result.html);
	  			$("#employee_hour_table_footer").html(result.footer);
	  			$('[data-toggle="tooltip"]').tooltip(); 
	  		});
}

function load_schedule(thisDiv,week,year){

	$(".worker_box").removeClass('active');
	$(thisDiv).addClass('active');

	var request_url = SURL+"human_resource/working_hours/load_schedule/"+week+"/"+year;
	$.ajax({
		method: "POST",
		url: request_url,
	   // data: "",
	}).done(function (response) {
		var html = '';	 
		  			
		$("#employee_schedule_table tbody").html(response);
		$(".selectpicker").selectpicker('refresh');
		$("#week_number").val(week);
		$("#current_year").val(year);
	});
}


$("#delete_worker_row_btn").click(function(){

	var userid = $(".worker_box.active").attr("userid");
	var checked = [];
	$("#secursat_user_data input[name='is_del']").each(function(){
		if($(this).is(':checked')){
			checked.push($(this).val());
		}
	})

	var request_url = SURL+"human_resource/importdata/remove_employee_row";
	$.ajax({
		method: "POST",
		url: request_url,
		data: "checked_rows="+checked,
	}).done(function (response) {
		if(response=='OK'){
			get_user_data(userid);
		}
	  			/*$("#user_data input[name='is_del']").each(function(){
			 		if($(this).is(':checked')){
			 			//checked.push($(this).val());
			 			$('#user_data tr#row_'+$(this).val()).remove();
			 		}
			 	})*/
			 });

});

function copy_schedule(userid){
	$("#copied_id").val(userid);
	//alert(userid);
 	/*$("tr#row_"+userid+"_0 td .selectpicker").each(function(i,v){
 		console.log(v.value);
 	})*/
 }

 function paste_schedule(userid){
 	var copied_id = $("#copied_id").val();
 	var selcted_0 = [];
 	var selcted_1 = [];
 	if(copied_id){
 		$("tr#row_"+copied_id+"_0 td .selectpicker").each(function(i,v){
 			selcted_0.push(v.value);
 		});
 		$("tr#row_"+copied_id+"_1 td .selectpicker").each(function(i,v){
 			selcted_1.push(v.value);
 		});

 		$("tr#row_"+userid+"_0 td .selectpicker").each(function(i,v){
 			$(this).val(selcted_0[i]);
 			//$('.selectpicker').selectpicker('refresh');
 		})

 		$("tr#row_"+userid+"_1 td .selectpicker").each(function(i,v){
 			$(this).val(selcted_1[i]);
 			//
 		});
 		$('.selectpicker').selectpicker('refresh');

 	}else{
 		alert("Please first select a row.");
 	}


 	/*$("tr#row_"+userid+"_0 td .selectpicker").val(15);
 	$('.selectpicker').selectpicker('refresh');*/
 }

 function sum_time_working(){

 	var totals = [0,0,0];

    var $dataRows = $("#secursat_user_data tr:not(':first')");

    $dataRows.each(function () {
        $(this).find('.working_hours').each(function (i) {
        	//alert($(this).val());
            time = $(this).val().split(":")
            totals[2] += parseInt(time[2]);
            if(totals[2] >= 60)
            {
                totals[2] %= 60;
                totals[1] += parseInt(time[1]) + 1;          
            }
            else
                totals[1] += parseInt(time[1]);
                
            if(totals[1] >= 60)
            {
                totals[1] %= 60;
                totals[0] += parseInt(time[0]) + 1;          
            }
            else
                totals[0] += parseInt(time[0]);
        });
    });
    var hours = (totals[0] <10) ? '0'+totals[0] : totals[0];
    var mins = (totals[1] <10) ? '0'+totals[1] : totals[1];
    var seconds = (totals[2] <10) ? '0'+totals[2] : totals[2];

    $("#totalWorkingHour").html('<strong>'+hours+':'+mins+':'+seconds+'</strong><input type="hidden" name="total_working_hours" id="total_working_hours" value="'+hours+':'+mins+':'+seconds+'">');

 }
 function sum_time_real(){

 	var totals = [0,0,0];

    var $dataRows = $("#secursat_user_data tr:not(':first')");

    $dataRows.each(function () {
        $(this).find('.real_hours').each(function (i) {
        	//alert($(this).val());
            time = $(this).val().split(":")
            totals[2] += parseInt(time[2]);
            if(totals[2] >= 60)
            {
                totals[2] %= 60;
                totals[1] += parseInt(time[1]) + 1;          
            }
            else
                totals[1] += parseInt(time[1]);
                
            if(totals[1] >= 60)
            {
                totals[1] %= 60;
                totals[0] += parseInt(time[0]) + 1;          
            }
            else
                totals[0] += parseInt(time[0]);
        });
    });

    var hours = (totals[0] <10) ? '0'+totals[0] : totals[0];
    var mins = (totals[1] <10) ? '0'+totals[1] : totals[1];
    var seconds = (totals[2] <10) ? '0'+totals[2] : totals[2];

    $("#totalRealHour").html('<strong>'+hours+':'+mins+':'+seconds+'</strong><input type="hidden" name="total_real_hours" id="total_real_hours" value="'+hours+':'+mins+':'+seconds+'">');

 }
function sum_time_accountable(){

 	var totals = [0,0,0];

    var $dataRows = $("#secursat_user_data tr:not(':first')");

    $dataRows.each(function () {
        $(this).find('.accountable_hours').each(function (i) {
        	//alert($(this).val());
            time = $(this).val().split(":")
            totals[2] += parseInt(time[2]);
            if(totals[2] >= 60)
            {
                totals[2] %= 60;
                totals[1] += parseInt(time[1]) + 1;          
            }
            else
                totals[1] += parseInt(time[1]);
                
            if(totals[1] >= 60)
            {
                totals[1] %= 60;
                totals[0] += parseInt(time[0]) + 1;          
            }
            else
                totals[0] += parseInt(time[0]);
        });
    });

    var hours = (totals[0] <10) ? '0'+totals[0] : totals[0];
    var mins = (totals[1] <10) ? '0'+totals[1] : totals[1];
    var seconds = (totals[2] <10) ? '0'+totals[2] : totals[2];

    $("#totalAccountableHour").html('<strong>'+hours+':'+mins+':'+seconds+'</strong><input type="hidden" name="total_accountable_hours" id="total_accountable_hours" value="'+hours+':'+mins+':'+seconds+'">');

 }
</script>