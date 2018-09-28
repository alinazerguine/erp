<link rel="stylesheet" href="<?php echo base_url() ?>assets/scripts/fullcalendar/fullcalendar.min.css" />
 
<script src="<?php echo SURL;?>assets/js/jquery-1.10.2.min.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->
<script src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script src="<?php echo SURL;?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo SURL;?>assets/js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo SURL;?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo SURL;?>assets/js/bootstrap-filestyle.min.js"></script>


 <script src="<?php echo base_url() ?>assets/scripts/fullcalendar/lib/moment.min.js"></script>
 <script src="<?php echo base_url() ?>assets/scripts/fullcalendar/fullcalendar.min.js"></script>
 <script src="<?php echo base_url() ?>assets/scripts/fullcalendar/gcal.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#calendar').fullCalendar({
    weekNumbers: false,
    firstDay: 1,
    defaultView:'basicWeek',
    views: 'month,basicWeek,basicDay',
    eventOrder: 'start,end',
   header: {
        center: 'month,basicWeek,basicDay' // buttons for switching between views
    },
     /*views: {
        agendaFourDay: {
            type: 'agenda',
            duration: { week: 4 },
            buttonText: '5 week'
        }
    }
*/
/*visibleRange: function(currentDate) {
    alert('sss');
        return {
            start: currentDate.clone().subtract(1, 'days'),
            end: currentDate.clone().add(3, 'days') // exclusive end, so 3
        };
    },*/
dayClick: function(date, jsEvent, view) {

       // alert('Clicked on: ' + date.format());

        /*alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

        alert('Current view: ' + view.name);*/

        // change the day's background color just for fun
        $("tr td.fc-day").each(function(){
             $(this).removeClass('active');
        })
        $(this).addClass('active');
        $("#addModal").modal('show');

    },
viewRender: function (view, element) {
    var b = $('#calendar').fullCalendar('getDate');
    alert(b.format('L'));
 },

});
});
</script>