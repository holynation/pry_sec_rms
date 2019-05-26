<?php 
// include "template/header.php";
// include "template/sidebar.php";
// for testing
include "template/header.php";
if ($this->webSessionManager->getCurrentUserProp('user_type')=='admin') {
  include "template/sidebar.php";
}
 ?>
 <!-- the breadcrump for pages that needed it -->
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- the content page -->
 <!-- Main content -->
 <div class="print-content">
  <?php foreach ($reports as $report): ?>
    <?php
      $reportData=$report['report'];
      $student = $report['student'];
      $extraReport = $report['extraReport'];
      $resultCount = $report['resultCount'];
      $totalPercentage = $report['totalPercentage'];
    ?>
  <section class="content" style="page-break-after: always;">
    <div style="background: white;">
       <div id="f_wrap" style="width:100%">
      <!-- this is the beginning of the header report -->
        <div class="table-header" style="background-color:#357CA5">
          <table class="table noBorder table-header" style="max-width: 100%;">
            <tr>
              <td colspan="2" class="noBorder">
                 <div class="col-sm-5" style="text-align: center;">
                 <img width="120" height="100" src="<?php echo base_url(@$school->school_logo); ?>" alt="swot logo">
                </div>
              </td>
             <td colspan="12" class="noBorder">
                 <div style="text-align:right;margin-top:-20px;text-transform: uppercase;">
                    <h2>
                      <div style="color:red;font-weight:bold;font-size:7rem;margin-bottom: -17px;color:#fff;"><?php echo @$school->school_report_first_header; ?></div>
                      <br />
                      <div style="margin-top: -28px;font-size: 22px;color: #dbbf43;"><?php echo @$school->school_report_second_header; ?></div>
                    </h2>
                 </div>
              </td>
            </tr>
            <tr>
              <td colspan="12" class="noBorder">
                <div style="color:#fff;text-align: right;margin-right: 5px;margin-top: -5px;">
                  <p><?php echo @$school->location; ?></p>
                  <p style="margin-top: -5px;">
                    <b style="color:#dbbf43;">Tel:</b> <?php echo @$school->telephone1; ?>, <?php echo @$school->telephone2 ?>. <b style="color:#dbbf43;">Email:</b> <?php echo @$school->school_mail; ?>, Website: <?php echo @$school->school_website; ?>
                  </p>
                </div>
                  <p style="text-align:right;line-height: 1;">
                    Creche | <b style="color:#dbbf43;">Pre School</b> | Nursery | <b style="color: #dbbf43;">Basic</b> | <b style="color: #dbbf43;">After School Care</b> | <span style="color: red;">technology & test</span> | <b style="color: #dbbf43;">ICT</b> _____________________
                  </p>
              </td>
            </tr>
          </table>
        </div>
      <!-- end of the header -->
      <hr>
      <div style="max-width: 100%;">
        <table style="margin-bottom: 18px;margin-top:30px">
          <tr>
            <td>
              <div style="margin-bottom: 10px;">
                <table>
                  <tr>
                    <td style="padding-left:10px;"><b>Session</b></td>
                    <td><div style="border-bottom:1px solid #000;width: 120px;margin-left: 10px;"><?php echo $currentSession; ?></div></td>
                  </tr>
                </table>
                
              </div>
            </td>
            
          </tr>
          <tr>
            <td>
                <div>
                   <!-- /.box-header -->
                   <div class="">
                       <table class="mini-table" border="1">
                           <tr>
                              <td style="padding-left:10px;width:120px;">Name</td>
                              <td style="padding: 0 10px;"><?php echo strtoupper($student->surname.' '.$student->firstname.' '. $student->middlename); ?></td>
                           </tr>
                           <tr>
                              <td style="padding: 0 10px;">Class</td>
                              <td style="padding: 0 10px;">
                                <?php loadClass($this->load,'school_class');$class = new School_class(array('ID'=>$currentClass));$class->load(); 
                                echo $class->class_name;
                              ?>
                              </td>
                           </tr>
                           <tr>
                              <td style="padding-left: 10px;">Percentage</td>
                              <td style="padding: 0 10px;"><?php echo $totalPercentage .'%'; ?></td>
                           </tr>
                       </table>
                   </div>

               </div>
            </td>
            <td>
              <table class="mini-table" border="1" style="margin-left:10rem;">
                 <tr>
                    <td style="padding: 0 10px;">Term</td>
                    <td style="padding-left: 10px;width: 120px;">
                      <?php loadClass($this->load,'term');$term = new Term(array('ID'=>$sessionTerm));$term->load(); 
                        echo $term->term_name .' Term';
                      ?>
                  </tr>
                  <tr>
                    <td style="padding: 0 10px;">No. in Class</td>
                    <td style="padding-left: 10px;width: 120px"><?php echo $totalStudent; ?></td>
                  </tr>
                  <tr>
                    <td style="padding: 0 10px;">Grade</td>
                    <td></td>
                  </tr>
              </table>
            </td>
            <td>
              <div>
                <td style="text-align: right;">
                  <img src="<?php echo base_url($student->img_path); ?>" alt="student pic" width='100px' height='100px' style="margin-left: 110px;margin-top: -25px;float:right;border-radius: 3px;margin-right:15px">
                </td>
              </div>
            </td>
          </tr>
        </table>
      </div>
      
      <?php $cummCa1 =0;
            $cummCa2 = 0;
            $cummExam = 0;
            $cummTotal = 0;
            $cummPer = 0;
       ?>
      <div>
        <div class="rows">
          <div class="table-wrapper" style="margin-bottom: 25px;">
          <?php foreach ($reportData as $key=>$sessionReport): ?>
            <?php if (!empty($sessionReport['result'])): ?>
              <h2></h2>
            <table class="format-table1" border="1" width="100%">
                <tr class="format-header1">
                  <th rowspan="2" style="text-align: center;width: 100px;">ACADEMIC SUBJECTS</th>
                  <th colspan="2">First summary</th>
                  <th colspan="2">Second summary</th>
                  <th colspan="2">Extra Curriculum</th>
                  <th colspan="2">Examination</th>
                  <th colspan="3">Summary of the Term Work</th>
                  <th rowspan="2"><div>Remarks</div></th>
                </tr>
                  <tr class="format-header2">
                   <th style="padding: 0px!important;">Mark(First CA)</th>
                   <th style="padding: 0px!important;">Mark ()</th>
                   <th style="padding: 0px!important;">Marks (Second CA)</th>
                   <th style="padding: 0px!important;">Mark ()</th>
                   <th style="padding: 0px!important;">Mark Exam</th>
                   <th style="padding: 0px!important;">Mark ()</th>
                   <th style="padding: 0px!important;">Mark Total</th>
                   <th style="padding: 0px!important;">Mark ()</th>
                   <th style="padding: 0px!important;">Total</th>
                   <th style="padding: 0px!important;">Class Average</th>
                   <th style="padding: 0px!important;">Position</th>
                  </tr>
                  <?php foreach ($sessionReport['result'] as $index => $value): ?>
                  <tr class="format-value">
                     <td style="padding: 0px!important;"><?php echo $value['subject_title']; ?></td>
                     <td style="padding: 0px!important;"><?php echo $value['ca_score1']; $cummCa1+=$value['ca_score1']; ?></td>
                     <td style="padding: 0px!important;"></td>
                     <td style="padding: 0px!important;"><?php echo $value['ca_score2']; $cummCa2+=$value['ca_score2']; ?></td>
                     <td style="padding: 0px!important;"></td>
                     <td style="padding: 0px!important;"><?php echo $value['exam_score']; $cummExam+=$value['exam_score']; ?></td>
                     <td style="padding: 0px!important;"></td>
                     <td style="padding: 0px!important;"><?php echo $value['score']; $cummTotal+=$value['score']; ?></td>
                     <td style="padding: 0px!important;"></td>
                     <td style="padding: 0px!important;"></td>
                     <td style="padding: 0px!important;"></td>
                     <td style="padding: 0px!important;"></td>
                     <td style="padding: 0px!important;"><?php echo $value['point']?"PASSED":"FAILED"; ?></td>
                  </tr>
                  <?php endforeach; ?>
                <tfoot>
                  <tr style="text-align: center;font-weight: bold;">
                    <th>Total</th>
                    <td><?php echo $cummCa1; ?></td>
                    <td></td>
                    <td><?php echo $cummCa2; ?></td>
                    <td></td>
                    <td><?php echo $cummExam; ?></td>
                    <td></td>
                    <td><?php echo $cummTotal; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tfoot>
            </table>
            <?php else: ?>
              <div class="alert alert-danger text-uppercase">
                <p>Sorry, no result found for the student in this Class....</p>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
          </div>
          <div class="table-wrapper-right">
            <table border='1' class="result-table" width="100%">
               <thead>
                 <tr class="first-header">
                  <th>BEHAVIOUR</th>
                  <th>5</th>
                  <th>4</th>
                  <th>3</th>
                  <th>2</th>
                  <th>1</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                  <tr>
                    <th>Punctuality</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Attendance in Class</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Attentiveness</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>`
                  </tr>
                  <tr>
                    <th>Neatness</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Politeness</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Honest</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Relationship with</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Peer Group</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Sense of</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Responsibility</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Perseverance</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Self Control</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Relationship with Staff</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Turn in Assignment</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Punctuation</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Fluency</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Sports & Games</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                 </tr>
               </tbody>
            </table>
          </div>
           <div class="clearfix"></div>
      </div>
       <!-- space -->
        <div class="rows">
          <div class="t-right">
               <div style="display: flex;flex-direction: row;">
                 <div>
                  <label style="color: #ccc">Number of Time School Open</label>
                  <label class="footer-report1"><?php echo $extraReport['times_school_open']; ?></label>
                  </div>
                  <div>
                  <label style="color: #ccc">Number of Time Present</label>
                  <label class="footer-report1"><?php echo $extraReport['time_present']; ?></label>
                 </div>
               </div>
                <div style="display: flex;flex-direction: row;justify-content: space-between;">
                    <div style="margin-bottom: 15px;">
                    <label style="color: #ccc">Class Teacher's Comment</label>
                    <label class="footer-report2"><?php echo $extraReport['teacher_comment']; ?></label>
                    </div>
                </div>
                <div style="margin-bottom: 15px;">
                  <div>
                    <label style="color: #ccc">Head Teacher's Comment</label>
                    <label class="footer-report2"><?php echo $extraReport['head_teacher_comment']; ?></label>
                  </div>
                </div>
                <div style="display: flex;flex-direction: row;">
                  <div>
                    <label>Next Term Begins</label>
                    <label class="footer-report1"><?php echo $extraReport['next_term_begins']; ?></label>
                  </div>
                  <div>
                    <label style="margin-left: 20px">Sign/Stamp</label>
                  </div>
                </div>
          </div>
          <div class="t-left">
            <table border='1' id="result-table" class="result-table" style="width: 100px;">
               <thead>
                 <tr class="first-header">
                  <th colspan="2">ACADEMIC RATING</th>
                 </tr>
               </thead>
                <tbody>
                  <tr class="rate-header">
                    <tr>
                      <th>A</th>
                      <td>Excellent</td>
                    </tr>
                    <tr>
                      <th>B</th>
                      <td>V.Good</td>
                    </tr>
                    <tr>
                      <th>C</th>
                      <td>Good</td>
                    </tr>
                    <tr>
                      <th>D</th>
                      <td>Fair</td>
                    </tr>
                    <tr>
                      <th>E</th>
                      <td>Poor</td>
                    </tr>
                  </tr>
                </tbody>
            </table>
            <table border='1' id="result-table" class="result-table" style="width: 100px;">
               <thead>
                 <tr class="first-header">
                  <th colspan="2">KEY TO REPORT RATING & PERFORMANCES</th>
                 </tr>
               </thead>
                <tbody>
                  <tr class="rate-header">
                    <tr>
                      <th>5</th>
                      <td>Excellent</td>
                    </tr>
                    <tr>
                      <th>4</th>
                      <td>V.Good</td>
                    </tr>
                    <tr>
                      <th>3</th>
                      <td>Fair</td>
                    </tr>
                    <tr>
                      <th>2</th>
                      <td>Poor</td>
                    </tr>
                    <tr>
                      <th>1</th>
                      <td>Very Poor</td>
                    </tr>
                  </tr>
                </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
        </div>

         <div class="row">
          <?php if(@$extraReport): ?>
          <div class="col-md-8" style="margin-bottom:20px;">
         
          </div>
          <?php else: ?>
            <div class="alert alert-danger">
              <p>Please go to the Configure Report Section to state the Report Configuration...</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
     
        
      </div>
    </div>
  </section>
    <!-- /.content -->
  <?php endforeach; ?>
    
    
<style>
  .footer-report1{
    border-bottom: 1px solid #000;
    width:150px;
    text-align: center;
  }
  .footer-report2{
    border-bottom: 1px solid #000;
    width:100%;
    text-align: left;
  }
  .mini-table{
  font-size: 0.9em;
  font-weight: bold;
  font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
  padding: 2px;
  border: thin solid #f25989;
}
tr.rate-header>tr>th{
  color:red;
}
  .noBorder{
      border:none !important;
    }
  .table-header{
    background-color: #357CA5;
    color:#fff;
    margin-top: -10px;
    margin-bottom: -30px;
  }
  .format-table1 {
    border: thin solid #f25989;
    letter-spacing: 0px;
    font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
    font-size: 1.2rem;
}
tr.format-header1 > th{
  color:inherit;
  text-align: center;
}
tr.format-value td:nth-child(1){
  font-weight: bold;
}
tr.format-header2 > th{
  width: 15px;
  text-align: center;
}
tr > th > div{
  text-align: center;
  vertical-align: middle;
  white-space: nowrap;
  -webkit-transform: rotate(-50deg); 
  -moz-transform: rotate(-50deg); 
}
tr.format-value > td{
  color:inherit;
  text-align: center;
}
.result-table{
  border: thin solid #f25989;
  font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
  font-size: 1.15rem;
  font-weight: 400;
  line-height: 1.2;
  color: inherit;
}
.result-table tr.first-header >th{
  padding-left: 0px;
  padding-right:0px;
  color:#fff;
  background-color: #f25989;
  text-align: center;
}
.result-table td{
  padding-left:10px;
}
.rows{
  width: 100%;
}
.table-wrapper{
  width: 30%;
  float: left;
  margin-right: 53%
}
.table-wrapper-right{
  width: 15%;
  float: left;
}
.t-left{
  float: right;
  width: 20%;
  margin-right: -8%;
}
.t-right{
  float: left;
  width: 70%;
}
#result-table{
  margin-top: 10px;
}
</style>
</div>
  <div class="btn btn-success pull-right print">Print</div>
  </div>
</div>
 <?php include "template/footer.php" ?>
 