<div id="page-wrapper">
	<div class="float-left">
		<h2>Calendar</h2>
	</div>
	
	<div class="graphs" style="float: left; width: 100%;">	
		<div class="xs tabls">			
			<div class="bs-example4" data-example-id="simple-responsive-table">
                <div class="col-md-12 col-sm-12">
				<div class="table-responsive">
					<div id="calendar" style="width: 60%;">
                        <?php echo $calendar;?>
</div>
				</div><!-- /.table-responsive -->
            </div>
           <div class="col-md-12 col-sm-12" style="margin-top: 25px;">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr class="warning">
                                <th>EMPLOYEE</th>
                                <th>Monday</th>
                                <th>Tuesday</th>
                                <th>Wednesday</th>
                                <th>Thursday</th>
                                <th>Friday</th>
                                <th>Saturday</th>
                                <th>Sunday</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Michael Dubois</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td></td>
                                <td></td>                                                       
                            </tr>
                            <tr>
                                <td>Martin Fernandez</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td></td>
                                <td></td>                                                       
                            </tr>
                            <tr>
                                <td>Corentin Deprez</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td></td>
                                <td></td>                                                       
                            </tr>
                            <tr>
                                <td>Thomas Hilt</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td>Bruxelles formation</td>
                                <td></td>
                                <td></td>                                                       
                            </tr>
                        </tbody>
                        
                    </table>

                </div><!-- /.table-responsive -->
            </div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title" id="myModalLabel">Add Calendar Event</h4>
             </div>
             <div class="modal-body">
                  Form Goes Here
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 <button type="button" class="btn btn-primary">Save changes</button>
             </div>
        </div>
    </div>
</div>
