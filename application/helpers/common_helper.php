<?php
function get_site_preferences() {
    $ci = & get_instance();
    $query = "SELECT * FROM site_preferences where setting_name  in ('site_name','footer_copyright_text','company_phone_number','company_phone_number2','company_contact_email','facebook','twitter','gplus','skype','company_address','company_address2','company_fax','is_google_captcha_on','cashwithdrawalsallowed','chequewithdrawalsallowed')";
    $get = $ci->db->query($query);
    //echo $ci->db->last_query();exit;
    $data = $get->result_array();
    foreach ($data as $key => $val) {
        $site_preference[$val['setting_name']] = $val['setting_value'];
    }
    return $site_preference;
}

function get_progress_bar($site_id) {
    $ci = & get_instance();

        $ci->db->select(array("o.cost_price","SUM(sp.period_bill) as progress"));
        $ci->db->from("offers o");
        $ci->db->join("site_progress sp","o.reference_no= sp.reference_no");
        $ci->db->where("o.id",$site_id);

        /*$ci->db->select(array("o.working_hours","SEC_TO_TIME(SUM(TIME_TO_SEC(ewh.total_accountable_hours))) as total_worked_hours"));
        $ci->db->from("offers o");
        $ci->db->join("employees_working_hours ewh","ewh.site_id=o.id","left");
        $ci->db->where("o.id",$site_id);*/

        $query = $ci->db->get();
        $result = $query->row();
        $total_value = $result->cost_price;
        $progress = $result->progress;

        $return = ($total_value) ? round(($progress/$total_value)*100,2) : 0;
        /*$working_hours = $result->working_hours;
        if($result->total_worked_hours>0){
            $total_worked_hours = decimalHours($result->total_worked_hours);
        }else{
            $total_worked_hours = 0;
        }

        if($working_hours>0){
            $return = round(($total_worked_hours / $working_hours)*100,2);
        }else{
            $return = 0;
        }*/

        return ($return>100) ? 100 : $return;

}

function get_exact_document($reference_no) {
    $ci = & get_instance();

        $ci->db->select(array("*"));
        $ci->db->from("cron_documents");
        $ci->db->where("reference_no",$reference_no);

        $query = $ci->db->get();
        $result = $query->result();
        
        return $result;

}

function count_exact_document($reference_no) {
    $ci = & get_instance();

        $ci->db->select(array("*"));
        $ci->db->from("cron_documents");
        $ci->db->where("reference_no",$reference_no);

        $query = $ci->db->get();
        $result = $query->num_rows();
        
        return $result;

}

function get_exact_document_dt($reference_no) {
    $ci = & get_instance();

    $column_order = array("supplier_name","document_url","created","purchase"); //set column field database for datatable orderable
        $column_search = array("supplier_name","document_url","created","purchase"); //set column field database for datatable searchable 
        $order = array('created' => 'asc'); // default order 
        
        $ci->db->select(array("*"));
        $ci->db->from("cron_documents");
        $ci->db->where("reference_no",$reference_no);

        $i = 0;

        foreach ($column_search as $key=>$item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

               $search_value = $_POST['search']['value'];
               /*if(strpos($search_value, 'active') !== false){
                $search_text = 1;
            }elseif(strpos($search_value, 'inactive') !== false){
                $search_text = 0;
            }else{

                $search_text = $search_value;
            }*/

            $search_text = $search_value;


                if($i===0) // first loop
                {
                    $ci->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $ci->db->like($item, $search_text);
                }
                else
                {
                    $ci->db->or_like($item, $search_text);
                }

                if(count($column_search) - 1 == $i) //last loop
                    $ci->db->group_end(); //close bracket
                }
                elseif($_POST['columns']) // if datatable send POST for coulumn search
                {

                 $search_value = $_POST['columns'][$key]['search']['value'];               

                 $search_text = $search_value;


                 if($search_text!='')
                 {
                    $ci->db->where($item, $search_text);
                }

               /* if(count($column_search) - 1 == $i) //last loop
               $this->db->group_end(); //close bracket*/
           }


                $i++;
            }

        if(isset($_POST['order'])) // here order processing
        {
            $ci->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($order))
        {
            $order = $order;
            $ci->db->order_by(key($order), $order[key($order)]);
        }

        if($_POST['length'] != -1)
            $ci->db->limit($_POST['length'], $_POST['start']);
        //echo $ci->db->get_compiled_select();exit;
        $query = $ci->db->get();
        return $query->result();   

}

function numberFormat($amount){

    return number_format($amount, 2, ',', '.');
}

/*function numberDeFormat($amount){

    return number_format($amount, 2, '.', ',');
}*/

function checkValidDate($date){
    $newdate = str_replace('/', '-', $date); 
    $converted_date =  date('d/m/Y', strtotime($newdate));
    return $converted_date;
}

function count_unread_notification($notify_to=0){
$ci = & get_instance();
 $ci->db->select(array("*"));
 $ci->db->from("notifications");
 $ci->db->where("notify_to",$notify_to);
 $ci->db->where("is_new",1);

 $query = $ci->db->get();
 return $query->num_rows(); 
}
#------------Retunr total number of weeks in year--------#
function getIsoWeeksInYear($year) {
    $date = new DateTime;
    $date->setISODate($year, 53);
    return ($date->format("W") === "53" ? 53 : 52);
}
#----------------- return the week number form date-------#
function weekOfMonth($qDate) {
    $dt = strtotime($qDate);
    $day  = date('j',$dt);
    $month = date('m',$dt);
    $year = date('Y',$dt);
    $totalDays = date('t',$dt);
    $weekCnt = 1;
    $retWeek = 0;
    for($i=1;$i<=$totalDays;$i++) {
        $curDay = date("N", mktime(0,0,0,$month,$i,$year));
        if($curDay==7) {
            if($i==$day) {
                $retWeek = $weekCnt+1;
            }
            $weekCnt++;
        } else {
            if($i==$day) {
                $retWeek = $weekCnt;
            }
        }
    }
    return $retWeek;
}

#----------------- return the week number and year from date-------#
function weeknYearOfMonth($qDate) {
    $dt = strtotime($qDate);
    $day  = date('j',$dt);
    $month = date('m',$dt);
    $year = date('Y',$dt);
    $totalDays = date('t',$dt);
    $weekCnt = 1;
    $retWeek = 0;
    for($i=1;$i<=$totalDays;$i++) {
        $curDay = date("N", mktime(0,0,0,$month,$i,$year));
        if($curDay==7) {
            if($i==$day) {
                $retWeek = $weekCnt+1;
            }
            $weekCnt++;
        } else {
            if($i==$day) {
                $retWeek = $weekCnt;
            }
        }
    }
    return $retWeek.'_'.$year;
}

#------------- return week start and end date-----------#
function getStartAndEndDate($week, $year) {
  $dto = new DateTime();
  $dto->setISODate($year, $week);
  $week_start = $dto->format('d/m/y');
  $dto->modify('+6 days');
  $week_end = $dto->format('d/m/y');
  return $week_start.' à '.$week_end;
}

function get_week_dates($week, $year) {
  $dto = new DateTime();
  $dto->setISODate($year, $week);
  $week_start = $dto->format('Y-m-d');
  $dto->modify('+6 days');
  $week_end = $dto->format('Y-m-d');
  return $week_start.'_'.$week_end;
}

function getYear($week, $year) {
  $dto = new DateTime();
  $dto->setISODate($year, $week);
  $dto->modify('+6 days');
  $year = $dto->format('Y');

  return $year;
}

function getYear_prev($week, $year) {
  $dto = new DateTime();
  $dto->setISODate($year, $week);
  $dto->modify('-6 days');
  $year = $dto->format('Y');

  return $year;
}

function getWeekDates($year, $week, $start=true)
{
    $from = date("Y-m-d", strtotime("{$year}-W{$week}-1")); //Returns the date of monday in week
    $to = date("Y-m-d", strtotime("{$year}-W{$week}-7"));   //Returns the date of sunday in week

    /*if($start) {
        return $from;
    } else {
        return $to;
    }*/
    return "Week {$week} in {$year} is from {$from} to {$to}.";
}

function TimeIsBetweenTwoTimes($from, $till, $input) {
    $f = DateTime::createFromFormat('H:i:s', $from);
    $t = DateTime::createFromFormat('H:i:s', $till);
    $i = DateTime::createFromFormat('H:i:s', $input);
   // if ($f > $t) $t->modify('+1 day');
    return ($f <= $i && $i <= $t) ;
}

function sum_time() {
    $i = 0;
    foreach (func_get_args() as $time) {
        sscanf($time, '%d:%d:%d', $hour, $min,$sec);
        $i += $hour * 60 + $min;
    }
    if ($h = floor($i / 60)) {
        $i %= 60;
    }

    
    return sprintf('%02d:%02d', $h, $i);
}

function sum_the_time($time1, $time2) {
  $times = array($time1, $time2);
  $seconds = 0;
  foreach ($times as $time)
  {
    list($hour,$minute,$second) = explode(':', $time);
    $seconds += $hour*3600;
    $seconds += $minute*60;
    $seconds += $second;
  }
  $hours = floor($seconds/3600);
  $seconds -= $hours*3600;
  $minutes  = floor($seconds/60);
  $seconds -= $minutes*60;
  // return "{$hours}:{$minutes}:{$seconds}";
  return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); // Thanks to Patrick
}
#---------- time into decimal-------#
function decimalHours($time)
{
   
    $hms = explode(":", $time);
    //echo count($hms).'-';
    if(count($hms)>1){
    return round(($hms[0] + ($hms[1]/60) + ($hms[2]/3600)),2);
    }else{
        return 0;
    }
}

#---------- decimal value into time-----#
function convertTime($dec)
{
    if($dec==0){
        return '';
    }else{
    // start by converting to seconds
    $seconds = ($dec * 3600);
    // we're given hours, so let's get those the easy way
    $hours = floor($dec);
    // since we've "calculated" hours, let's remove them from the seconds variable
    $seconds -= $hours * 3600;
    // calculate minutes left
    $minutes = floor($seconds / 60);
    // remove those from seconds as well
    $seconds -= $minutes * 60;
    // return the time formatted HH:MM:SS
    //return lz($hours).":".lz($minutes).":".lz(round($seconds));
    return lz($hours)."h".lz($minutes);
}
}

// lz = leading zero
function lz($num)
{
    return (strlen($num) < 2) ? "0{$num}" : $num;
}

/*------------- schedule fropdown for sites----------*/
function get_schedule_site_dropdown($name,$data,$selected_id=''){
    $dropdown = '<select class="form-control selectpicker" data-container="body" data-size="5" data-live-search="true" title="" name="'.$name.'[]" id="morning_schedule" style="width:100%;">
                <option value=""></option>';
                if($data){
                    foreach($data as $site){
                        $selected = ($selected_id && $selected_id==$site->id) ? "selected" : '';
                       
                        $dropdown.= '<option value="'.$site->id.'" '.$selected.'>#'.$site->reference_no.'-'.$site->description.'</option>';
                    }}                                          
                $dropdown .= '</select>';

    return $dropdown;
}
/*------------- schedule fropdown for sites end----------*/

function lastquery() {
    $ci = & get_instance();
    echo $ci->db->last_query();
}

function get_market_dropdown(){
    return array(
        array('value'=>'Public','label'=> PUBLIC_TEXT),
        array('value'=>'Privé','label'=>PRIVATE_TEXT),
    );
}

function get_client_dropdown(){
    return array(
        array('value'=>'Entreprise générale','label'=>GENERAL_COMPANIES),
        array('value'=>'Pouvoir public','label'=>PUBLIC_ENTITIES),
        array('value'=>'Privé - Entreprise','label'=>PRIVATE_COMPANY),
        array('value'=>'Privé - Particulier','label'=>PRIVATE_PERSON),
    );
}

function get_offer_dropdown(){
    return array(
        array('value'=>'Affaire ferme','label'=>CONCRETE_BUSINESS),
        array('value'=>'submission','label'=>SUBMISSION),
    );
}
function get_status_dropdown(){
    return array(
        array('value'=>'En attente','label'=>PROCESSING),
        array('value'=>'Annulé','label'=>CANCEL),
        array('value'=>'Rejeté','label'=>REJECTED),
        array('value'=>'Accepté','label'=>ACCEPTED),
    );
}

// handy function to output server side stuff in console
function console_print($data) {

    echo '<script type="text/javascript">';
    echo "console.log('$data')";

    echo '</script>';
}

// handy funtion to print debug info

function printme($data, $exit_status = 0) {

    echo '<pre>';
    print_r($data);
    echo '</pre>';

    if ($exit_status) {
        exit;
    }
}

function printx($data, $exit_status = 0, $comment = "") {

    if ($comment != "") {

        echo '<pre>';
        echo $comment;
        echo '</pre>';

    }

    echo '<pre>';
    print_r($data);
    echo '</pre>';

    if ($exit_status) {
        exit;
    }
}

function showsetting($setting=array()) {

	if($setting['inputtype']=="text"){
		$returnsetting='<input type="hidden" name="id" value="'.$setting['id'].'"> <input type="text" name="setting_value" value="'.$setting['setting_value'].'" class="form-control">';		
		
	}elseif($setting['inputtype']=="textarea"){
		$returnsetting='<input type="hidden" name="id" value="'.$setting['id'].'"><textarea class="form-control" name="setting_value">'.$setting['setting_value'].'</textarea>';
	}elseif($setting['inputtype']=="select"){
		$options=explode(",",$setting['inputoption']);
		//printme($options);
		$returnsetting='<input type="hidden" name="id" value="'.$setting['id'].'">';
		$returnsetting.='<select name="setting_value" class="form-control">';
		foreach($options as $k => $v){
			if($v==$setting['setting_value']){
				$selected='selected';
			}else{
				$selected='';
			}
			$returnsetting.='<option  value="'.$v.'" '.$selected.'>'.$v.'</option>';
		}
		$returnsetting.='</select>';
	}
	return $returnsetting;
}
//Date display function
function display_date($date) {
    return date('d M Y', strtotime($date));
}
//Short date display function
function display_date_short($date) {
    return date('M d', strtotime($date));
}
//Date & time display function
function display_datetime($date) {
    return date('d M Y H:i:s', strtotime($date));
}

//Currency format
function dispalycurrency($amount) {
    return number_format($amount, 2, '.', ',');

}

//display images
function display_profile_image($imagename){
	if (file_exists(FCPATH."assets/profile_images/thumb/".$imagename) && $imagename!="") {
		$imageurl=SURL."assets/profile_images/thumb/".$imagename;
	}else{
		$imageurl=SURL."assets/images/noprofile.jpg";

	}
	return $imageurl;
}

function getchatattachment($job_id,$send_to,$me,$filename){
    $folder_path ='';
    $filepath = '';
    if (is_dir(FCPATH."assets/chat/".md5($job_id.$send_to.$me))){
      $folder_path = './assets/chat/'.md5($job_id.$send_to.$me);
      $filepath=SURL.'assets/chat/'.md5($job_id.$send_to.$me);
  }elseif(is_dir(FCPATH."assets/chat/".md5($job_id.$me.$send_to))){
      $folder_path = './assets/chat/'.md5($job_id.$me.$send_to);
      $filepath=SURL.'assets/chat/'.md5($job_id.$me.$send_to);
  }
  if (file_exists($folder_path."/".$filename) && $filename!="") {
      $fpath=base64_encode($filepath."/".$filename);
  }else{
      $fpath="#";
  }
  return $fpath;
}

function getchatattachment_delivered($order_id,$me,$filename){
    $folder_path ='';
    $filepath = '';
    $folder_path = FCPATH."assets/order_complete/".md5($order_id.$me);
    if (file_exists($folder_path."/".$filename) && $filename!="") {
        $filepath=SURL.'assets/order_complete/'.md5($order_id.$me);
        $fpath=base64_encode($filepath."/".$filename);
    }else{
        $fpath="#";
    }
    return $fpath;
}


function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' kB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}


function country_dropdown_options($selected = '', $comare_by = 'country_name') {
    $ci = & get_instance();
    $ci->db->dbprefix('countries');
    $ci->db->order_by('country_name', 'asc');
    $get_data = $ci->db->get('countries');
    //echo $ci->db->last_query(); 
    $data = $get_data->result_array();
    $country_options = '<option value="">Select Country </option>';
    foreach ($data as $country) {
        $selected_tag = ($selected == $country[$comare_by]) ? 'selected="selected"' : '';
        $country_options.='<option ' . $selected_tag . ' value="' . $country[$comare_by] . '">' . $country['country_name'] . '</option>';
    }
    //printme($data,1);
    return $country_options;
}

function country_list() {
    $ci = & get_instance();
    $ci->db->dbprefix('countries');
    $ci->db->order_by('name', 'asc');
    $get_data = $ci->db->get('countries');
    //echo $ci->db->last_query(); 
    $data = $get_data->result_array();
    return $data;
}

function admin_menu_tree() {

    $ci = & get_instance();
    $ci->db->dbprefix('admin_menu');
    $ci->db->where('parent_id', '0');
    $ci->db->where('show_in_nav', '1');
    $ci->db->order_by('display_order', 'asc');
    $get_data = $ci->db->get('admin_menu');
    $data = $get_data->result_array();

    foreach ($data AS $key => $val) {
        $sub_items = get_sub_menu($val['id']);
        $data[$key]["sub_item"] = $sub_items;
    }
	//print_r($data);exit;
    return $data;
}


function get_sub_menu($parent_id) {
    $ci = & get_instance();
    $ci->db->dbprefix('admin_menu');
    $ci->db->where('parent_id', $parent_id);
    $ci->db->where('show_in_nav', '1');
    $ci->db->order_by('display_order', 'asc');
    $get_data = $ci->db->get('admin_menu');
    $data = $get_data->result_array();
    return $data;
}

function create_thumbnail($filename, $src, $dest, $width = 150, $height = 150) {
    $ci = & get_instance();
    $config_resize['image_library'] = 'gd2';
//    $config_resize['library_path'] = '/usr/bin/mogrify';
    $config_resize['source_image'] = $src;
    $config_resize['quality'] = 80;
    $config_resize['new_image'] = $dest;
//  $config_resize['file_name'] = $filename;
    $config_resize['maintain_ratio'] = FALSE;
    $config_resize['create_thumb'] = FALSE;
    $config_resize['width'] = $width;
    $config_resize['height'] = $height;
//
    // echo $src;
    $data = getimagesize($src);
    $width1 = $data[0];
    $height1 = $data[1];
    if ($width1 != $height1) {

        $config_resize['maintain_ratio'] = TRUE;
        $config_resize['master_dim'] = 'auto';
        $ci->load->library('image_lib');
        $ci->image_lib->initialize($config_resize);
        if ($ci->image_lib->resize()) {

            $dfile = $dest . "/" . $filename;

            $im = imagecreatetruecolor($width, $height);
//        $stamp = imagecreatefromjpeg('img.jpg');

            if (preg_match('/[.](jpg)$/', $filename)) {
                $stamp = imagecreatefromjpeg($dfile);
            } else if (preg_match('/[.](gif)$/', $filename)) {
                $stamp = imagecreatefromgif($dfile);
            } else if (preg_match('/[.](png)$/', $filename)) {
                $stamp = imagecreatefrompng($dfile);
            } else if (preg_match('/[.](jpeg)$/', $filename)) {

                $stamp = imagecreatefromjpeg($dfile);
            } else if (preg_match('/[.](JPG)$/', $filename)) {

                $stamp = imagecreatefromjpeg($dfile);
            }


            $red = imagecolorallocate($im, 255, 255, 255);
            imagefill($im, 0, 0, $red);



            $sx = imagesx($stamp);
            $sy = imagesy($stamp);


            $oy = imagesx($stamp);
            $ox = imagesy($stamp);


            $d = getimagesize($dfile);
            $wd = $d[0];
            $hg = $d[1];

            if ($wd < $width) {
                $mg = $width - $wd;
                $marge_right = $mg / 2;
            } else {
                $marge_right = 0;
            }
            if ($hg < $height) {

                $mgh = $height - $hg;
                $marge_bottom = $mgh / 2;
            } else {
                $marge_bottom = 0;
            }
            $imgg = imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, $sx, $sy);
            /* matiullah*/
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            switch($ext) {
               case "gif": $ctype="image/gif"; break;
               case "png": $ctype="image/png"; break;
               case "jpeg":
               case "jpg": $ctype="image/jpeg"; break;
               default: $ctype="image/png"; break;
           }
			//	 console_print($ctype);
            //@header('Content-type: ' . $ctype);
           /* matiullah */
            //@imagepng($im, $dfile);
			//@imagejpeg($im, $dfile);
            //@imagedestroy($im);
       } else {

            // echo $ci->image_lib->display_errors();
       }
   } else {

// echo "resized ".$src;
    $ci->load->library('image_lib');
    $ci->image_lib->initialize($config_resize);
    $ci->image_lib->resize();
}

//      $ci->image_lib->fit();
//
//
//
//    $ci->image_lib->clear();
}
function create_thumbnail_ratio($filename, $src, $dest, $width = 150, $height = 150) {
    $ci = & get_instance();

//    //resize:
    $config_resize['image_library'] = 'gd2';
    $config_resize['library_path'] = '/usr/bin/mogrify';
    $config_resize['source_image'] = $src;
    $config_resize['quality'] = 80;
    $config_resize['new_image'] = $dest;
    $config_resize['maintain_ratio'] = FALSE;
    $config_resize['width'] = $width;
    $config_resize['height'] = $height;


    $ci->load->library('image_lib');
    $ci->image_lib->initialize($config_resize);
    $ci->image_lib->resize();
}

function create_fixed_thumbnail($filename, $src, $dest, $width = 150, $height = 150) {
    $ci = & get_instance();
//
//    //resize:
    $config_resize['image_library'] = 'gd2';
    $config_resize['library_path'] = '/usr/bin/mogrify';
    $config_resize['source_image'] = $src;
    $config_resize['quality'] = 80;
    $config_resize['new_image'] = $dest;
    $config_resize['maintain_ratio'] = FALSE;
    $config_resize['width'] = $width;
    $config_resize['height'] = $height;


    $ci->load->library('image_lib');
    $ci->image_lib->initialize($config_resize);
    $ci->image_lib->resize();
}

function create_optimize($filename, $src, $dest) {
    $ci = & get_instance();

    //resize:
    $config_resize['image_library'] = 'gd2';
//     $config_resize['library_path'] = '/usr/bin/composite';
    $config_resize['source_image'] = $src;
    $config_resize['quality'] = 80;
    $config_resize['new_image'] = $dest;
    $config_resize['maintain_ratio'] = TRUE;

    $ci->load->library('image_lib');
    $ci->image_lib->initialize($config_resize);
    $ci->image_lib->resize();

    $ci->image_lib->clear();
}

function random_code_generator($len, $number_of_codes) {
    $result = array();
    $chars = "abGTyHqr$*#sTuvwxyz^%67891230";
    $charArray = str_split($chars);
    for ($j = 0; $j < $number_of_codes; $j++) {
        for ($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            if ($i == 0) {
                $result[$j] = "" . $charArray[$randItem];
                continue;
            }
            $result[$j] .= "" . $charArray[$randItem];
        }
    }
    return $result;
}


function get_all_packages() {
    $ci = & get_instance();
    $query = "SELECT * FROM packages where status='1' order by packages_id ASC";
    $get = $ci->db->query($query);
//    echo $ci->db->last_query();exit;
    return $data = $get->result_array();
}


function package_name($package_id) {
    $ci = & get_instance();
    $query = "SELECT * FROM packages where status='1' and packages_id='$package_id'";
    $get = $ci->db->query($query);
//    echo $ci->db->last_query();exit;
    return $data = $get->row_array();
}

function random_password_generator($len = 8, $number_of_codes = 1) {
    $result = array();
    $chars = "abGTyHqr$*#sTuvwxyz^%67891230";
    $charArray = str_split($chars);
    for ($j = 0; $j < $number_of_codes; $j++) {
        for ($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            if ($i == 0) {
                $result[$j] = "" . $charArray[$randItem];
                continue;
            }
            $result[$j] .= "" . $charArray[$randItem];
        }
    }
    return $result[0];
}

//Get customer ranking

function admin_notifications() {

    $ci = & get_instance();
    $query = "SELECT * FROM notifications where status='0' order by id DESC limit 5";
    $get = $ci->db->query($query);
       // echo $ci->db->last_query();exit;
    return $data = $get->result_array();
}

    // get all categories with subcategories 
function get_parent_and_subcategory() {
   $ci = & get_instance();
   $query = "SELECT * FROM categories where is_active='1' and parent_category='0' order by sortorder ASC";
   $get = $ci->db->query($query);
   $row = $get->result_array();

   foreach($row as $key=>$val) {

    $row[$key]['subcats'] = get_subcats($val['id']);

}

return $row;

}

function get_subcats($id) {

    $ci = & get_instance();
    $query = "SELECT * FROM categories where is_active='1' and parent_category='$id' order by sortorder ASC";
    $get = $ci->db->query($query);
    $row = $get->result_array();

    return $row;


}

function is_website_accessed_from_mobile($useragent) {

    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $device = "mobile";
    }else {
        $device = "desktop";
    }

    return $device;


}





?>