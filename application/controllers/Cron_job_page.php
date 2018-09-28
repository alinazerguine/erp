<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_job_page extends CommonController {

	function __construct() {
        // Call the Model constructor
		parent::__construct();
		$this->load->model('mod_cron_jobs');
		$this->load->model('mod_common');
		ini_set('max_execution_time', 0);      
	}

	public function index()
	{
		$this->mod_common->exact_connect();
		//$this->mod_cron_jobs->update_token();
		echo "Exact data is being synchronized.";
		#--------------turnover_api-----------#
		$turnover = $this->mod_cron_jobs->turnover_api();
		if($turnover){
			echo 'Turn over is completed.';
		}
		#--------------purchase-----------#
		$this->mod_cron_jobs->update_token();
		$purchase = $this->mod_cron_jobs->purchase_api();
		if($purchase){
			echo '<br>Purchase are completed.';
		}
		#--------------invoices-----------#
		$this->mod_cron_jobs->update_token();
		$invoices = $this->mod_cron_jobs->invoice_api();
		if($invoices){
			echo '<br>Invoices are completed.';
		}
		#--------------documents-----------#
		$this->mod_cron_jobs->update_token();
		$docs = $this->mod_cron_jobs->documents_api();
		if($docs){
			echo '<br>Documents are completed.';
			// echo '<script type="text/javascript">window.close();</script>';
		}

		$this->load->view('cron');

	}

	
}
