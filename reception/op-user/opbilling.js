var app = angular.module('patient', []);

app.controller('patient_controller', ['$scope', '$http', function ($scope, $http) {
        // scope variables
        $scope.display_doctor={};
        $scope.display_specialization={};
		$scope.add_doct={};
		$scope.edit_doct={};
        $scope.doctor_hide=false;
		$scope.errormsg=false;
		$scope.errormsg2=false;
		$scope.errormsg3=false;
		$scope.payment_mode={};
			$scope.services_add={};
		
		$scope.others=false;
		$scope.specia=true;
		$scope.devide=false;
	
		
		//on load funtions
		$http.get("display_doctor.php")
						.success(function(doctor){
							 
							$scope.display_doctor = doctor;
						
						})
						.error(function() {
							$scope.data = "error in fetching data";
						});
						
						
		$http.get("display_specialization.php")
                .success(function(specialization){
				     
                    $scope.display_specialization = specialization;
               
				
                })
                .error(function() {
                    $scope.data = "error in fetching data";
                });	
		
		// on click funtions
		
		// add patient
		$scope.patient_add={};
		$scope.patient_details={};
		$scope.patient_add.gender="Male";		
        $scope.add_patients = function() {
		
		     
			      
				  if(!($scope.add_patient.patient_name.$error.required || $scope.add_patient.patient_age.$error.required || $scope.add_patient.patient_phone.$error.required || $scope.add_patient.patient_address.$error.required))
                    {

                      		  
						$http({     
						                method : 'POST' ,
										url: 'add_patient.php',
										data: $scope.patient_add
										
								}).success(function(data){
										$scope.patient_details=data;
									

                                        if($scope.patient_details.patient_id == "DUP")
                                        {
											alert("Patient is Already Registered with given Phone Number:" + $scope.patient_add.phone);
											$scope.patient_id=" ";
											angular.element('#add_patient').modal('hide');
											$scope.show_button=true;
											$scope.doctor_hide=false;
											$scope.patient_add=null;
										
										}
                                        else{										
											
											alert("Registration Successful");
											$scope.patient_id=$scope.patient_details.patient_id;
											angular.element('#add_patient').modal('hide');
											$scope.show_button=true;
											$scope.doctor_hide=false;
											$scope.patient_add=null;
											
										}
						       }).error(function(data, status) {
						                 alert("error");
					   });

               }					   
	    };

		//edit specific doctor
         $scope.edit_doctor = function(doctor_id) {
                   
                                 			
													$http.post("edit_doctor.php",{doctor__id : doctor_id})
														.success(function(data,status,headers,config){
														
														
														   $scope.edit_doct = data;
												
														}).error(function(data, status) {
														   alert("error");
													   });  
      };	
     
	 //service starts
			$http.get("display_service.php")
                .success(function(data){
				    
                    $scope.display_service = data;
					
                })
                .error(function() {
                    $scope.data = "error in fetching data";
                });
	  
	  $scope.service_price = function() {
					 
								
						
						$http({     
						                method : 'POST' ,
										url: 'display_service_price.php',
										data: {service_id:$scope.service.list_service}
										
								}).success(function(data){
							             
										$scope.display_service_price = data;
										 		            
						       }).error(function(data, status) {
						                 alert("error");
					   });
	    };
		
		 // add temp service
		   $scope.disp_service=[];
		   $scope.disbale_button= true;
		   $scope.add_temp_service = function() {
			    $scope.show_div = true;
				
				console.log($scope.service.list_service);
				
				 $http({     
						                method : 'POST' ,
										url: 'service_name.php',
										data: {service_id:$scope.service.list_service}
										
								}).success(function(data){
									
								
							          
											$scope.ser_name = data;
											//console.log($scope.ser_name);
										 	$scope.disp_service.push({ patient_id: $scope.patientname.patient_id, service_id :$scope.service.list_service,price : $scope.display_service_price.price, service_name:$scope.ser_name.service_name });
											console.log($scope.disp_service);
											$scope.disbale_button= false;
						       }).error(function(data, status) {
						                 alert("error");
					   });
		        
				
						  
		};
		$scope.delete_temp_service = function(name) {
			    
		        $scope.disp_service.splice(name,1);
				//console.log($scope.disp_service);
						  
		};
		
		// add service_details
	    
			
        $scope.service_add_details = function() {
						
								
						$scope.services_add=$scope.disp_service;
						
                 
						 $scope.disbale_button= false;
					
						
								
						
						$http({     
						                method : 'POST' ,
										url: 'service_adding.php',
										data: {service : $scope.services_add,patient_id : $scope.patientname.patient_id}
										
								}).success(function(data){
							            
										$scope.disbale_button= true;
										$scope.show_service_taken=data;
										//console.log(data);
										angular.element('#add_service').modal('hide');
										var total=0; 
										
									
									 	for(var i in data){
											
										   total += parseInt(data[i][4],10);
										   
										}
                                        $scope.totalamt=total;
										$scope.doctor_hide=true;
										$scope.doctor_hide=true;
										$scope.disp_service=[];
										
										$scope.display_service_price.price="";
										
						       }).error(function(data, status) {
						                 alert("error");
					   });
	
		};
		
		$(function() {
      $("#patientid" ).autocomplete({
      source: 'patient-details.php',
	  select: function( event, ui ) {
	    
            var patient_id = ui.item.value;
			$scope.patient_id=patient_id;
			$scope.display_patient_details();
		 }	 
	  
    });
  });
		
		
		
		
		
		$scope.show_button=false;
		 $scope.display_patient_details= function () {
	

	
	    $scope.doctor_hide=false;
		$scope.errormsg=false;
		$scope.errormsg2=false;
		$scope.errormsg3=false;
	        
       
			$http({     
						                method : 'POST' ,
										url: 'display_services.php',
										data:{patient_id: $scope.patient_id}
										
								}).success(function(data){
							
							            $scope.show_service_taken=data;
									
										
										
									  							  
									   if($scope.show_service_taken=="")
									  {
										  
										$scope.show_button=true;
										$scope.doctor_hide=false;
										$scope.errormsg2=true;											  
									
									  }
									  else
									  {
									  
									      
										  var total=0; 
										
									
									 	for(var i in data){
											
										   total += parseInt(data[i][4],10);
										   
										}
                                        $scope.totalamt=total;
										$scope.doctor_hide=true;
									    $scope.show_button=true;
										
									  }
									  if($scope.show_service_taken.Error=="404")
                                      {
									  
									     
                                           $scope.errormsg=true;										   
                                           $scope.errormsg2=false;										   
                                           $scope.errormsg3=false;										   
									       $scope.doctor_hide=false;
									    $scope.show_button=false;
									  }		
									  if($scope.show_service_taken.Error=="405")
                                      {
									  
									  
                                           $scope.errormsg=false;										   
                                           $scope.errormsg3=true;										   
                                           $scope.errormsg2=false;										   
									       $scope.doctor_hide=false;
									    $scope.show_button=false;
									  }
									  
									  
									  
									  
									   }).error(function(data, status) {
						                 alert("error");
					   });
        //do something
    };

	   //service ends
	   
	   //consultation starts
	   
	   $scope.consultation=function(){
		 
			$http({     
						                method : 'POST' ,
										url: 'consultation.php',
										data: {patient_id : $scope.patient_id}
										
								}).success(function(data){
							            $scope.patientname=data;
										$http.get("display_doctor.php")
									.success(function(doctor){
										 
										$scope.display_doctor = doctor;
									
									})
									.error(function() {
										$scope.data = "error in fetching data";
									});
										
						       }).error(function(data, status) {
						                 alert("error");
					   });
		   
	   };
	   
	   $scope.services=function(){
		 
			$http({     
						                method : 'POST' ,
										url: 'consultation.php',
										data: {patient_id : $scope.patient_id}
										
								}).success(function(data){
							            $scope.patientname=data;		
						       }).error(function(data, status) {
						                 alert("error");
					   });
		   
	   };
	   
	   
	   
	   
	  
	   $scope.doctor_details=function(){
				
               if($scope.doctors.doctor_list=="21")
			   {
                          		$scope.others=true; 
                                $scope.specia=false;								
			   
			   }
			   else{
			              $scope.others=false; 
                                $scope.specia=true;								
			   
			   
			   }
			   
			   
			   
		$http({     
						                method : 'POST' ,
										url: 'doctor_details.php',
										data: {doctor_id : $scope.doctors.doctor_list}
										
								}).success(function(data){
							            $scope.doctor_specialization=data;
									
										
						       }).error(function(data, status) {
						                 alert("error");
					   });
		
	   };
	   
	   	   $scope.addConsutation=function(){
				

		$http({     
						                method : 'POST' ,
										url: 'add_consultation.php',
										data: {doctor_id : $scope.doctors.doctor_list,patient_id:$scope.patientname.patient_id,fee:$scope.doctor_specialization.fee}
										
								}).success(function(data){
							           	 $scope.show_service_taken=data;
										 angular.element('#consultation').modal('hide');
										 var total=0; 
										
									
									 	for(var i in data){
											
										   total += parseInt(data[i][4],10);
										   
										}
                                        $scope.totalamt=total;
										$scope.doctor_hide=true;
											
										
										
						       }).error(function(data, status) {
						                 alert("error");
					   });
		
	   };

	   
	   
       //select doctor
	   $scope.take_op_appoint = function(doctor_id,patient_id) {
	   
	                                       
                                               $scope.d_id=doctor_id;
											   $scope.patient_id=patient_id;
                                 				$http.post("select_doctor.php",{doctor_id : $scope.d_id, patient_id : $scope.patient_id})
														.success(function(data,status,headers,config){
													
														   $scope.select_doctor = data;
													
														}).error(function(data, status) {
														   alert("error");
													   });  
      };
	  
	  
	   $scope.click_payment=function(id){
		   
		   
		   
		      
			  if(id=="Cash" || id=="Card")
			  {
			        
			         
					 $scope.devide=false;
					 
			  
			  }
			  else{
			  
			       $scope.devide=true;
			       
			  
			  }
			    
			  $scope.show_print_discharge=true;
			   console.log($scope.display_pay_details.devidetotalamt);
			  
			  
		   };
	 
      //select doctor
	   $scope.print_receipt = function() {
                              $scope.details=$scope.show_service_taken;	
							
							$http({     
						                method : 'POST' ,
										url: 'op_make_payment.php',
										data: {patient_id:$scope.patient_id,totalamt:$scope.totalamt,details : $scope.details,payment:$scope.payment_mode,paymode:$scope.display_pay_details}
										
								}).success(function(data){						
														$scope.make_payment=data;
															console.log(data);
														
														   setTimeout(function(){
														var innerContents = document.getElementById("printsection").innerHTML;
														var popupWinindow = window.open('', '_blank', 'width=600,height=700,scrollbars=no,menubar=no,toolbar=no,location=no,status=no,titlebar=no');  
														popupWinindow.document.open();
														popupWinindow.document.write('<html><head><link rel="stylesheet" type="text/css" href="style.css" /></head><body onload="window.print()">' + innerContents + '</html>');
														popupWinindow.document.close();		

											},500);
											
											$scope.doctor_hide=false;
									        $scope.show_button=false;
											$scope.patient_id=" ";
											
														   
														   
														
														}).error(function(data, status) {
														   alert("Not Done Try Again");
													   });  
      };
	  
     
}]);
