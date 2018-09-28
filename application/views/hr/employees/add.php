<div id="page-wrapper">
 <div class="float-left" style="width: 50%;">
  <h2><?php echo ADD_EMPLOYEE_TITLE;?></h2>
</div>

<div class="graphs" style="float: left; width: 100%;">   
  <?php
  if ($this->session->flashdata('err_message')) { ?>
  <div class="alert alert-danger"> <?php echo $this->session->flashdata('err_message'); ?> </div>
  <?php
}
if ($this->session->flashdata('ok_message')) {
  ?>
  <div class="alert alert-success alert-dismissable"> <?php echo $this->session->flashdata('ok_message'); ?> </div>
  <?php
}
?>   
<div class="xs tabls">      
  <div class="bs-example4" data-example-id="simple-responsive-table">
   
    <div class="col-md-12 col-sm-12">
      <form method="post" action="<?php echo SURL.HR.'/employees/add'?>" enctype="multipart/form-data">
        <div class="col-md-6">
          <div class="form-group">
            <label for="fname"><?php echo EMP_FIRST_NAME;?> :</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="ex : Jean" required="required">
          </div>
          <div class="form-group">
            <label for="lname"><?php echo EMP_LAST_NAME;?> :</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="ex : Dubois" required="required">
          </div>

          <div class="form-group">
            <label for="address"><?php echo ADDRESS;?> :</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="ex : Rue de la Gruerie" required="required">
          </div>
          <div class="form-group">
            <label for="address"></label>
            <input type="text" class="form-control" id="add_address" name="add_address" placeholder="ex : Complément adresse">
          </div> 
          <div class="form-group">
            <label for="address"></label>
            <input type="text" class="form-control" id="place" name="place" placeholder="ex : Wavre" style="width: 40%;">
            <input type="text" class="form-control" id="place2" name="place2" placeholder="ex : 1300" style="width: 19%; margin-left: 3px;">
          </div>

          <div class="form-group">
            <label for="national_number"><?php echo NATIONAL_REGISTRATION_NUMBER;?> :</label>
            <input type="text" class="form-control" id="national_number" name="national_number" placeholder="ex : 710323-541-01" required="required">
          </div>
          <div class="form-group">
            <label for="dob"><?php echo BIRTH_DATE;?> :</label>
            <input type="date" class="form-control" id="dob" name="dob" placeholder="ex : 23/03/1971">
          </div>
          <div class="form-group">
            <label for="bplace"><?php echo BIRTH_PLACE;?> :</label>
            <input type="text" class="form-control" id="birth_place" name="birth_place" placeholder="ex : Wavre">
          </div>
          <div class="form-group">
            <label for="nationality"><?php echo NATIONALITY;?> :</label>
            <input type="text" class="form-control" id="nationality" name="nationality" placeholder="ex : belge" required="required">
          </div>
          <div class="form-group">
            <label for="mobile"><?php echo MOBILE;?> :</label>
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="ex : 0472 23 54 86">
          </div>
          <div class="form-group">
            <label for="show_size"><?php echo SHOE_SIZE;?> :</label>
            <input type="text" class="form-control" id="show_size" name="show_size" placeholder="ex : 43">
          </div>

          <div class="form-group">
            <label for="high_waist"><?php echo HIGH_WAIST;?> :</label>
            <input type="text" class="form-control" id="high_waist" name="high_waist" placeholder="ex : XL">
          </div>

          <div class="form-group">
            <label for="low_waist"><?php echo LOW_WAIST;?> :</label>
            <input type="text" class="form-control" id="low_waist" name="low_waist" placeholder="ex : 42">
          </div>              

        </div>

        <div class="col-md-6">              
          <div class="form-group">
            <label for="position"><?php echo POSITION;?> :</label>
            <input type="text" class="form-control" id="position" name="position" placeholder="ex : ouvrier">
          </div>
          <div class="form-group">
            <label for="civil_status"><?php echo CIVIL_STATUS;?> :</label>
            <select class="form-control" id="civil_status" name="civil_status">
              <option value="0"><?php echo SINGLE;?></option>
              <option value="1"><?php echo MARRIED;?></option>
              <option value="2"><?php echo SPOUSE_WITH_DEPENDENTS;?></option>
              <option value="3"><?php echo WIDOW;?></option>
            </select>
          </div>
          <div class="form-group">
            <label for="spouse_name"><?php echo SPOUSE_NAME;?> :</label>
            <input type="text" class="form-control" id="spouse_name" name="spouse_name" placeholder="ex : Marie Dubois">
          </div>
          <div class="form-group">
            <label for="dependent_child"><?php echo DEPENDENT_CHILDREN;?> :</label>
            <input type="number" min="0" class="form-control" id="dependent_child" name="dependent_child" placeholder="ex : 2">
          </div>
          <div class="form-group">
            <label for="bank_name"><?php echo BANK_NAME;?> :</label>
            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="ex : BNP">
          </div>
          <div class="form-group">
            <label for="account_number"><?php echo ACCOUNT_NUMBER;?> :</label>
            <input type="text" class="form-control" id="account_number" name="account_number" placeholder="ex : BE21 5402 4932 5867" style="width: 30%;margin-right: 10px;">
            <label for="account_number" style="width: 8%; margin-top: 5px;">BIC :</label>
            <input type="text" class="form-control" id="bic_code" name="bic_code" placeholder="ex : BBRUBEBB" style="width: 20%">
          </div>
          <div class="form-group">
            <label for="mutual_name"><?php echo MUTUAL_NAME;?> :</label>
            <input type="text" class="form-control" id="mutual_name" name="mutual_name" placeholder="ex : Partena">
          </div>
          <div class="form-group">
            <label for="affiliation"><?php echo AFFILIATION;?> :</label>
            <input type="text" class="form-control" id="affiliation" name="affiliation" placeholder="ex : BBRUBEBB">
          </div>
          <div class="form-group">
            <label for="work_place"><?php echo WORKPLACE_KM;?> :</label>
            <input type="text" class="form-control" id="workplace" name="workplace" placeholder="ex : 14">
          </div>
          <div class="form-group">
            <label for="study_level"><?php echo STUDY_LEVEL;?> :</label>
            <input type="text" class="form-control" id="study_level" name="study_level" placeholder="ex : 2 années professionnellles inférieur">
          </div>


          <div class="form-group">
            <label for="status"><?php echo EMP_STATUS;?> :</label>
            <select class="form-control" id="status" name="status">
              <option value="1"><?php echo ACTIVE;?></option>
              <option value="0"><?php echo INACTIVE;?></option>
            </select>
          </div>
        </div>
        <div class="col-md-12 col-sm-12" style="text-align: right; padding-right: 60px;">
          <button type="submit" class="btn-success btn"><?php echo SAVE_BTN;?></button>
          <a href="<?php echo SURL.HR.'/employees'?>"><span class="label btn_6 label-danger medium"><?php echo CANCEL_BTN;?></span></a>
        </div>            
      </form>
    </div>
  </div>
</div>
</div>
</div>