<div id="page-wrapper">
 <div class="float-left" style="width: 50%;">
  <h2><?php echo EDIT_EMPLOYEE_TITLE;?></h2>
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
      <form method="post" action="<?php echo SURL.HR.'/employees/update/'.$employee->id?>" enctype="multipart/form-data">
        <div class="col-md-6">
          <div class="form-group">
            <label for="fname"><?php echo EMP_FIRST_NAME;?> :</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="ex : Jean" value="<?php echo $employee->fname;?>">
          </div>
          <div class="form-group">
            <label for="lname"><?php echo EMP_LAST_NAME;?> :</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="ex : Dubois" value="<?php echo $employee->lname;?>">
          </div>

          <div class="form-group">
            <label for="address"><?php echo ADDRESS;?> :</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="ex : Rue de la Gruerie" value="<?php echo $employee->address;?>">
          </div>
          <div class="form-group">
            <label for="address"></label>
            <input type="text" class="form-control" id="add_address" name="add_address" placeholder="ex : Complément adresse" value="<?php echo $employee->add_address;?>">
          </div> 
          <div class="form-group">
            <label for="address"></label>
            <input type="text" class="form-control" id="place" name="place" placeholder="ex : Wavre" style="width: 40%;" value="<?php echo $employee->place;?>">
            <input type="text" class="form-control" id="place2" name="place2" placeholder="ex : 1300" style="width: 19%; margin-left: 3px;" value="<?php echo $employee->place2;?>">
          </div>

          <div class="form-group">
            <label for="national_number"><?php echo NATIONAL_REGISTRATION_NUMBER;?> :</label>
            <input type="text" class="form-control" id="national_number" name="national_number" placeholder="ex : 710323-541-01" value="<?php echo $employee->national_reg_no;?>">
          </div>
          <div class="form-group">
            <label for="dob"><?php echo BIRTH_DATE;?> :</label>
            <input type="date" class="form-control" id="dob" name="dob" placeholder="ex : 23/03/1971" value="<?php echo $employee->dob;?>">
          </div>
          <div class="form-group">
            <label for="bplace"><?php echo BIRTH_PLACE;?> :</label>
            <input type="text" class="form-control" id="birth_place" name="birth_place" placeholder="ex : Wavre" value="<?php echo $employee->birth_place;?>">
          </div>
          <div class="form-group">
            <label for="nationality"><?php echo NATIONALITY;?> :</label>
            <input type="text" class="form-control" id="nationality" name="nationality" placeholder="ex : belge" value="<?php echo $employee->nationality;?>">
          </div>
          <div class="form-group">
            <label for="mobile"><?php echo MOBILE;?> :</label>
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="ex : 0472 23 54 86 " value="<?php echo $employee->mobile;?>">
          </div>
          <div class="form-group">
            <label for="show_size"><?php echo SHOE_SIZE;?> :</label>
            <input type="text" class="form-control" id="show_size" name="show_size" placeholder="ex : 43" value="<?php echo $employee->show_size;?>">
          </div>

          <div class="form-group">
            <label for="high_waist"><?php echo HIGH_WAIST;?> :</label>
            <input type="text" class="form-control" id="high_waist" name="high_waist" placeholder="ex : XL" value="<?php echo $employee->high_waist;?>">
          </div>

          <div class="form-group">
            <label for="low_waist"><?php echo LOW_WAIST;?> :</label>
            <input type="text" class="form-control" id="low_waist" name="low_waist" placeholder="ex : 42" value="<?php echo $employee->low_waist;?>">
          </div>              

        </div>

        <div class="col-md-6">              
          <div class="form-group">
            <label for="position"><?php echo POSITION;?> :</label>
            <input type="text" class="form-control" id="position" name="position" placeholder="ex : ouvrier" value="<?php echo $employee->position;?>">
          </div>
          <div class="form-group">
            <label for="civil_status"><?php echo CIVIL_STATUS;?> :</label>
            <select class="form-control" id="civil_status" name="civil_status">
             <option value="0" <?php if($employee->civil_status==0){echo "selected";}?> ><?php echo SINGLE;?></option>
             <option value="1" <?php if($employee->civil_status==1){echo "selected";}?> ><?php echo MARRIED;?></option>
             <option value="2" <?php if($employee->civil_status==2){echo "selected";}?> ><?php echo SPOUSE_WITH_DEPENDENTS;?></option>
             <option value="3" <?php if($employee->civil_status==3){echo "selected";}?> ><?php echo WIDOW;?></option>
           </select>
         </div>
         <div class="form-group">
          <label for="spouse_name"><?php echo SPOUSE_NAME;?> :</label>
          <input type="text" class="form-control" id="spouse_name" name="spouse_name" placeholder="ex : Marie Dubois" value="<?php echo $employee->spouse_name;?>">
        </div>
        <div class="form-group">
          <label for="dependent_child"><?php echo DEPENDENT_CHILDREN;?> :</label>
          <input type="number" min="0" class="form-control" id="dependent_child" name="dependent_child" placeholder="ex: 2" value="<?php echo $employee->dependent_child;?>">
        </div>
        <div class="form-group">
          <label for="bank_name"><?php echo BANK_NAME;?> :</label>
          <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="ex : BNP" value="<?php echo $employee->bank_name;?>">
        </div>
        <div class="form-group">
          <label for="account_number"><?php echo ACCOUNT_NUMBER;?> :</label>
          <input type="text" class="form-control" id="account_number" name="account_number" placeholder="ex : BE21 5402 4932 5867" style="width: 30%;margin-right: 10px;" value="<?php echo $employee->account_number;?>">
          <label for="account_number" style="width: 8%; margin-top: 5px;">BIC :</label>
          <input type="text" class="form-control" id="bic_code" name="bic_code" placeholder="ex : BBRUBEBB" style="width: 20%" value="<?php echo $employee->bic_code;?>">
        </div>
        <div class="form-group">
          <label for="mutual_name"><?php echo MUTUAL_NAME;?> :</label>
          <input type="text" class="form-control" id="mutual_name" name="mutual_name" placeholder="ex : Partena" value="<?php echo $employee->mutual_name;?>">
        </div>
        <div class="form-group">
          <label for="affiliation"><?php echo AFFILIATION;?> :</label>
          <input type="text" class="form-control" id="affiliation" name="affiliation" placeholder="ex : BBRUBEBB" value="<?php echo $employee->affiliation;?>">
        </div>
        <div class="form-group">
          <label for="work_place"><?php echo WORKPLACE_KM;?> :</label>
          <input type="text" class="form-control" id="workplace" name="workplace" placeholder="ex : 14" value="<?php echo $employee->workplace;?>">
        </div>
        <div class="form-group">
          <label for="study_level"><?php echo STUDY_LEVEL;?> :</label>
          <input type="text" class="form-control" id="study_level" name="study_level" placeholder="ex : 2 années professionnellles inférieur" value="<?php echo $employee->study_level;?>">
        </div>


        <div class="form-group">
          <label for="status"><?php echo EMP_STATUS;?> :</label>
          <select class="form-control" id="status" name="status">
            <option value="1" <?php if($employee->status==1){ echo "selected";}?>><?php echo ACTIVE;?></option>
            <option value="0" <?php if($employee->status==0){ echo "selected";}?>><?php echo INACTIVE;?></option>
          </select>
        </div>
      </div>
      <div class="col-md-12 col-sm-12" style="text-align: right; padding-right: 60px;">
        <button type="submit" class="btn-success btn"><?php echo UPDATE_BTN;?></button>
        <a href="<?php echo SURL.HR.'/employees'?>"><span class="label btn_6 label-danger medium"><?php echo CANCEL_BTN;?></span></a>
      </div>            
    </form>
  </div>
</div>
</div>
</div>
</div>