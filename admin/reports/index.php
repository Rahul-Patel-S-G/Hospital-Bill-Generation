<?php
session_start();
if(isset($_SESSION['name']) && $_SESSION['name']=="admin")
{
	
}
else{
	header('Location: ../../login/index.html');
	die();
	
}
?>

<!DOCTYPE html>
<html>
<head>


<link rel="stylesheet" href="../../css/sidebar-menu.css">
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/style.css">
<link href='../../css/fullcalendar.css' rel='stylesheet' />
<link href='../../css/fullcalendar.print.css' rel='stylesheet' media='print' />

  <link rel="stylesheet" href="../../css/datepicker/jquery-ui.css" >
<script src='../../js/jquery.min.js'></script>
<script src="../../js/bootstrap.min.js"></script> 
<script src="../../js/angular.min.js"></script>
<script src="../../js/custom.js"></script>
<script src="../../js/custom_jquery.js"></script>	
	
<script src='../../js/moment.min.js'></script>
<script src='../../js/moment.min.js'></script>
<script src="../../js/datepicker/jquery-ui.js"></script>

</head>

<body ng-app="reports">
	
<div class=" container-fluid" ng-controller="reports_controller" >




		
		

<div ng-include="'include/header.html'"></div>
		

	
<div class="col-md-9 col-lg-9 col-xs-9 col-sm-9 adjust-margin disp-dept-cont">
<div class="col-md-8 col-lg-8 col-xs-8 col-sm-8">
		
 </div>

 </div>
	
	
<div class="row" >

  <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 " ng-show="show_op" id="opdayreport">
	<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3"></div>
		<div class="col-md-9 col-lg-9 col-xs-9 col-sm-9 ">
		  <h3>OP REPORTS</h3>
		
		   <div class="col-md-4 col-lg-4 col-xs-4 col-sm-4 ">
             From Date <input  class="datepicker" ng-model="op.fromdate" />
		   </div>
		   <div class="col-md-4 col-lg-4 col-xs-4 col-sm-4 ">
             To Date <input class="datepicker" ng-model="op.todate"/>
		   </div>
		    <div class="col-md-4 col-lg-4 col-xs-4 col-sm-4 ">
             <select class="form-control drop-down-btn" id="country" name="country" ng-model="op.recep_id" ng-change="displayreports()">
													<option  value=""selected="selected">Select Receptionist</option>
													<option  value="All">All</option>
													<option name="" ng-repeat="receptionist in receptionists" value="{{receptionist.user_id}}">{{receptionist.username}}</option>
													
												  </select>
		   </div>
	  </div>

 
 <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
	<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3"></div>

	<div class="col-md-9 col-lg-9 col-xs-9 col-sm-9 table-top-space" ng-show="show_op_div">
					
					 
						 <table id="tbl"  class="table tble-size  table-condensed tbl-shadow " cellpadding="10"  cellspacing="10">
									<thead>
									  <tr class=" font-14 font-os-semibold border-btm" >
										<th class=" left-padding" >Sl No</th>
										<th >Perticular</th>
										<th >Date</th>
										<th >Cash Amount</th>
										<th >Card Amount</th>
										<th>Amount</th>
										
										<th  ></th>
									  </tr>
									</thead>
									<tbody>
									  <tr class="border-data-btm" ng-repeat="opdetails in display_op" > 
										
										<td class=" left-padding" >{{$index+1}}</td>
										<td> OP Billing</td>
										<td>{{opdetails.date}}</td>
										<td>{{opdetails.cashamt}}</td>
										<td>{{opdetails.cardamt}}</td>
										<td>{{opdetails.totalamt}}</td>
										
										
										
									  </tr>
									  <tr>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td>Cash Total : {{cash}}</td>
										 <td>Card Total : {{card}}</td>
										 <td>Total : {{total}}</td>
									 </tr>
									  
								
									</tbody>
					  </table>
					  
					  <div class="calender-size hidden"  id="cal" >
							<div id='calendar' class="inner-calender" ></div>
					  </div>
					  
					  
					 
					 
		</div>
 </div>
</div> 
		
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 " ng-show="show_ip" id="ipdayreport">
	<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3"></div>
		<div class="col-md-9 col-lg-9 col-xs-9 col-sm-9 ">
		    <h3>IP REPORTS</h3>
		   <div class="col-md-4 col-lg-4 col-xs-4 col-sm-4 ">
             From Date <input  class="datepicker" ng-model="ip.fromdate" />
		   </div>
		   <div class="col-md-4 col-lg-4 col-xs-4 col-sm-4 ">
             To Date <input class="datepicker" ng-model="ip.todate"/>
		   </div>
		    <div class="col-md-4 col-lg-4 col-xs-4 col-sm-4 ">
             <select class="form-control drop-down-btn" id="country" name="country" ng-model="ip.recep_id" ng-change="displayipreports()">
													<option  value=""selected="selected">Select Receptionist</option>
													<option  value="All">All</option>
													<option name="" ng-repeat="receptionist in receptionists" value="{{receptionist.user_id}}">{{receptionist.username}}</option>
													
												  </select>
		   </div>
		   
		   
	  </div>

 
 <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
	<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3"></div>

	<div class="col-md-9 col-lg-9 col-xs-9 col-sm-9 table-top-space" ng-show="show_ip_div">
					
					 
						 <table id="tbl"  class="table tble-size  table-condensed tbl-shadow " cellpadding="10"  cellspacing="10">
									<thead>
									  <tr class=" font-14 font-os-semibold border-btm" >
										<th class=" left-padding" >Sl No</th>
										<th >Perticular</th>
										<th >Patient Name</th>
										<th>Date</th>
										<th>Payment Mode</th>
										<th>Cash Total</th>
										<th>Card Total</th>
										<th>Total</th>
										
										
										<th  ></th>
									  </tr>
									</thead>
									<tbody>
									  <tr class="border-data-btm" ng-repeat="ipdetails in display_ip" > 
										
										<td class=" left-padding" >{{$index+1}}</td>
										<td> Ip Billing-{{ipdetails.bill_no}}</td>
										<td>{{ipdetails.patient_name}}</td>
										<td>{{ipdetails.date}}</td>
										<td>{{ipdetails.paymentmode}}</td>
										<td>{{ipdetails.cashamt}}</td>
										<td>{{ipdetails.cardamt}}</td>
										<td>{{ipdetails.totalamt}}</td>
										
										
										
									  </tr>
									  <tr>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td></td>
										 <td></td>
										 <td>Cash Total : {{cashamt}}</td>
										 <td>Card Total : {{cardamt}}</td>
										 <td>Total : {{totalamt}}</td>
									 </tr>
									  
								
									</tbody>
					  </table>
					  
					  <div class="calender-size hidden"  id="cal" >
							<div id='calendar' class="inner-calender" ></div>
					  </div>
					  
					  
					 
					 
		</div>
 </div>
</div> 
	
	
			
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 " ng-show="show_package" id="package_report">
	<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3"></div>
		<div class="col-md-9 col-lg-9 col-xs-9 col-sm-9 ">
		    <h3>PACKAGE REPORTS</h3>
		   <div class="col-md-4 col-lg-4 col-xs-4 col-sm-4 ">
             From Date <input  class="datepicker" ng-model="package1.fromdate" />
		   </div>
		   <div class="col-md-4 col-lg-4 col-xs-4 col-sm-4 ">
             To Date <input class="datepicker" ng-model="package1.todate"/>
		   </div>
		    <div class="col-md-4 col-lg-4 col-xs-4 col-sm-4 ">
             <select class="form-control drop-down-btn" id="country" name="country" ng-model="package1.recep_id" ng-change="packagereport()">
													<option  value=""selected="selected">Select Receptionist</option>
													<option  value="All">All</option>
													<option name="" ng-repeat="receptionist in receptionists" value="{{receptionist.user_id}}">{{receptionist.username}}</option>
													
												  </select>
		   </div>
	  </div>

 
 <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
	<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3"></div>

	<div class="col-md-9 col-lg-9 col-xs-9 col-sm-9 table-top-space"  ng-show="show_package_div" >
					
					 
						 <table id="tbl"  class="table tble-size  table-condensed tbl-shadow " cellpadding="10"  cellspacing="10">
									<thead>
									  <tr class=" font-14 font-os-semibold border-btm" >
										<th class=" left-padding" >Sl No</th>
										<th >Perticular</th>
										<th >Date</th>
										<th >Cash Amount</th>
										<th >Card AMount</th>
										<th>Amount</th>
										
										
										
										<th  ></th>
									  </tr>
									</thead>
									<tbody>
									  <tr class="border-data-btm" ng-repeat="package_disp in package_disp" > 
										
										<td class=" left-padding" >{{$index+1}}</td>
										<td> {{package_disp.description}}</td>
										<td> {{package_disp.date}}</td>
										<td> {{package_disp.cashamt}}</td>
										<td> {{package_disp.cardamt}}</td>
										<td>{{package_disp.totalamount}}</td>
									
										
										
										
									  </tr>
									  <tr>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td>Cash Total:{{packagecash}}</td>
									    
										 <td>Card Total:{{packagecard}}</td>
										 <td>Total:{{packageamt}}</td>
									 </tr>
									  
								
									</tbody>
					  </table>
					  
					  <div class="calender-size hidden"  id="cal" >
							<div id='calendar' class="inner-calender" ></div>
					  </div>
					  
					  
					 
					 
		</div>
 </div>
</div> 
	
	

<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 " ng-show="show_test" id="test">


	<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3"></div>
		<div class="col-md-9 col-lg-9 col-xs-9 col-sm-9 ">
		    <h3>TEST REPORTS</h3>
		   <div class="col-md-4 col-lg-4 col-xs-4 col-sm-4 ">
             From Date <input  class="datepicker" ng-model="op_test.fromdate" />
		   </div>
		   <div class="col-md-4 col-lg-4 col-xs-4 col-sm-4 ">
             To Date <input class="datepicker" ng-model="op_test.todate"/>
		   </div>
		        <div class="col-md-4 col-lg-4 col-xs-4 col-sm-4 ">
             <select class="form-control drop-down-btn" id="country" name="country" ng-model="op_test.recep_id" ng-change="testreport()">
													<option  value=""selected="selected">Select Receptionist</option>
													<option  value="All">All</option>
													<option name="" ng-repeat="receptionist in receptionists" value="{{receptionist.user_id}}">{{receptionist.username}}</option>
													
												  </select>
		   </div>
	  </div>

 
 <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
	<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3"></div>

	<div class="col-md-9 col-lg-9 col-xs-9 col-sm-9 table-top-space"  ng-show="show_test_div">
					
					 
						 <table id="tbl"  class="table tble-size  table-condensed tbl-shadow " cellpadding="10"  cellspacing="10">
									<thead>
									  <tr class=" font-14 font-os-semibold border-btm" >
										<th class=" left-padding" >Sl No</th>
										<th >Perticular</th>
										<th >Date</th>
										<th >Cash Amount</th>
										<th >Card Amount</th>
										<th >Additional Charges</th>
										<th >Amount</th>
										
										
										
										<th  ></th>
									  </tr>
									</thead>
									<tbody>
									  <tr class="border-data-btm" ng-repeat="testdetails in testdetails" > 
										
										<td class=" left-padding" >{{$index+1}}</td>
										<td> Test Billing-{{testdetails.lab_billno}}</td>
										<td>{{testdetails.date}}</td>
										<td>{{testdetails.cashamt}}</td>
										<td>{{testdetails.cardamt}}</td>
											<td>{{testdetails.add_charge}}</td>
										<td>{{testdetails.amount}}</td>
										
										
										
										
									  </tr>
									  <tr>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td></td>
									    <td>Cash Total :{{testcash}}</td>
									 
										 <td>Card Total:{{testcard}}</td>
										 <td>Total : {{testamount}}</td>
									 </tr>
									  
								
									</tbody>
					  </table>
					  
					  <div class="calender-size hidden"  id="cal" >
							<div id='calendar' class="inner-calender" ></div>
					  </div>
					  
					  
					 
					 
		</div>
 </div>
</div> 	
		
		
	</div>
 
 
 
 
</div> 
</div>  <!-- Container End -->

   <script>
  $( function() {
    $( ".datepicker" ).datepicker(
	   {
           dateFormat: 'yy-mm-dd'	   
 	   }
	
	
	
	);
  
  });
  </script>
   <script src="../../js/adminreportscript/reportscript.js"></script> 
</body> <!-- Body End -->
</html>