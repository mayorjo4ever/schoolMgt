 $(function(){
	 //   showpop('good. working'); 
	// alert('hi');
//    register user via ajax        
    
    loadStaffRoles(); 
    
    // check if you are on adding new student page 
    
    loadStudentAdmLevels(); 
    hideInactiveTables();
    
    if($('#country').length > 0 ){
        $('#country').trigger('change'); 
       //  setTimeout(load_student_state_of_origin(),1000);    
    }
      // creating new student 
   
    if($('#my-roles,#acad_session,#reg_session').length > 0 ){       
        $('#my-roles,#acad_terms').select2(); 
        $('#my-subjects,#to_reg').select2(); 
        $('#my-class-groups,#my-class-room').select2(); 
       //  setTimeout(load_student_state_of_origin(),1000);    
    }
    
    // check for count down timer 
    if($('#countdown').length >0){
        course_registration_countdown(); 
        count_selected_courses();
    }
    
    
    // creating new student       
   
     $(document).on('submit','#new-student-form',function(evt){
         evt.preventDefault();
          var  forms = $(this).serialize(); var btn = ".add-new-student-btn";
           $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/add-new-student',
            data:forms,
            beforeSend :function(){ startLoader(btn); } , 
            success:function(resp){ stopLoader(btn);  
                showpop(resp.message,resp.status);
                 if(resp.status==='success'){
                  setTimeout(()=> window.location.href=resp.dir , 2000); 
               }
            }, 
           error:function(jhx,textStatus,errorThrown){ stopLoader(btn);
                checkStatus(jhx.status); 
                }
            });          
     });
    
    
    /*************************************/
        $('#current_password').on('keyup',function(){
        var current_password = $(this).val();
        $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/check-admin-password',
            data:{current_password:current_password},
            success:function(resp){
                 if(resp == "false") { $("#check_password").html("<font color='red'>current password is incorrect </font>");}
                 else if(resp == "true") { $("#check_password").html("<font color='green'>current password is correct </font>");}
            }, 
           error:function(jhx,textStatus,errorThrown){  
                checkStatus(jhx.status); 
                }
        });
    });
  
$(document).on('click','.updateAdminStatus',function(){   
    var status = $(this).children('i').attr('status');
    var admin_id = $(this).attr('admin_id');
     $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/update-admin-status',
            data:{status:status,admin_id:admin_id},
            success:function(resp){ // alert(resp);
                 if(resp['status'] == "0") { $("#admin-"+admin_id).html("<i class='pe-7s-attention pe-2x font-weight-bold  text-danger' status='inactive'></i>");}
                 else if(resp['status'] == "1") { $("#admin-"+admin_id).html("<i class='pe-7s-check pe-2x font-weight-bold  text-success' status='active'></i>");}
				 showToastPosition('bottom-right','Successful',"<span class='font-16 bold text-uppercase'>NOW "+resp['status']+"</span>",'success');
            }, 
		error:function(jhx,textStatus,errorThrown){  
                checkStatus(jhx.status); 
                }
        });
});
// update-section-status 
$(document).on('click','.updateScheduleStatus',function(){   
    var status = $(this).children('i').attr('status');
    var schedule_id = $(this).attr('schedule_id');
     $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/update-schedule-status',
            data:{status:status,schedule_id:schedule_id},
            success:function(resp){ // alert(resp);
                 if(resp['status'] == "0") { $("#schedule_id-"+schedule_id).html("<i class='pe-7s-attention pe-2x text-danger font-weight-bold' status='inactive'></i>");}
                 else if(resp['status'] == "1") { $("#schedule_id-"+schedule_id).html("<i class='pe-7s-check pe-2x text-success font-weight-bold' status='active'></i>");}
                    // showToastPosition('bottom-right','Successful',"<span class='font-16 bold text-uppercase'>NOW "+resp['status']+"</span>",'success');
            }, 
            error:function(jhx,textStatus,errorThrown){  
                checkStatus(jhx.status); 
                }
        });
});
//
  
$(document).on('click','.updatePayItemStatus',function(){   
    var status = $(this).children('i').attr('status');    
    var url="/admin/update-pay-item-status";
    var ref_name = "pay_item_id";
    var real_value = $(this).attr(ref_name);
    var real_ref = $("#"+ref_name+"-"+real_value);
    var loader = "."+ref_name+"-"+real_value;
    var message = ['Payment Item Successfully Deleted','Payment Item Successfully Restored'];
       //  alert("."+ref_name+"_"+real_value); exit ; 
     $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:url, beforeSend:function(){startLoader(loader,true);},
            data:{status:status,data_id:real_value},
            success:function(resp){ // alert(resp);
                 if(resp['status'] == "0") { 
                     real_ref.html("<i class='pe-7s-attention pe-2x font-weight-bold  text-danger' status='inactive'></i>  Deleted ");
                     real_ref.closest('tr').removeClass('active');
                     real_ref.closest('tr').addClass('inactive'); 
                }
                 else if(resp['status'] == "1") { 
                     real_ref.html("<i class='pe-7s-check pe-2x font-weight-bold  text-success' status='active'></i> Active");
                     real_ref.closest('tr').removeClass('inactive');
                     real_ref.closest('tr').addClass('active');  
                }
                stopLoader(loader,true);
               showpop(message[resp['status']],'success');  hideInactiveTables();
            }, 
		error:function(jhx,textStatus,errorThrown){  
                checkStatus(jhx.status); 
                }
        });
});
// 
$(document).on('click','.updatePayTypeStatus',function(){   
    var status = $(this).children('i').attr('status');    
    var url="/admin/update-pay-type-status";
    var ref_name = "pay_type_id";
    var real_value = $(this).attr(ref_name);
    var real_ref = $("#"+ref_name+"-"+real_value);
    var loader = "."+ref_name+"-"+real_value;
    var message = ['Payment Type Successfully Deleted','Payment Type Successfully Restored'];
       //  alert("."+ref_name+"_"+real_value); exit ; 
     $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:url, beforeSend:function(){startLoader(loader,true);},
            data:{status:status,data_id:real_value},
            success:function(resp){ // alert(resp);
                 if(resp['status'] == "0") { 
                     real_ref.html("<i class='pe-7s-attention pe-2x font-weight-bold  text-danger' status='inactive'></i>  Deleted ");
                     real_ref.closest('tr').removeClass('active');
                     real_ref.closest('tr').addClass('inactive'); 
                }
                 else if(resp['status'] == "1") { 
                     real_ref.html("<i class='pe-7s-check pe-2x font-weight-bold  text-success' status='active'></i> Active");
                     real_ref.closest('tr').removeClass('inactive');
                     real_ref.closest('tr').addClass('active');  
                }
                stopLoader(loader,true);
               showpop(message[resp['status']],'success');  hideInactiveTables();
            }, 
		error:function(jhx,textStatus,errorThrown){  
                checkStatus(jhx.status); 
                }
        });
});

/** SETTING UP PAYMENT PARAMETERS **/
//  
     $(document).on('submit','#payment-amount-setup',function(evt){
         evt.preventDefault();
          var  forms = $(this).serialize(); var btn = ".search-payment-amount-setup-btn";
           $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/search-payment-amount-setup',
            data:forms,
            beforeSend :function(){ startLoader(btn); } , 
            success:function(resp){ stopLoader(btn);  
                showpop(resp.message,resp.status);
                 if(resp.status==='success'){
                 $('.payment_setup_continuation').html(resp.view);
               }
            }, 
           error:function(jhx,textStatus,errorThrown){ stopLoader(btn);
                checkStatus(jhx.status); 
                }
            });          
     });
    

//  : create / update-schedule
$(document).on('change','#paper_type,#subject-title',function(){          
    var paper_type = $('#paper_type').val();
    var subject_id = $('#subject-title').val();
    
    if(paper_type!="" && subject_id!=""){
         setAvailQtn(paper_type,subject_id);
    }// end if
    
     
    });

// Perission Filter
$(document).on('click','.role-perm-btn',function(){   
    var btn = ".role-perm-btn";
    var role_id = $('#role').val();
    if(role_id==""){
        $('#permissions-view').html('');
        showpop('Please select Role','error');
    }
    else {
        $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/load-permissions',
            data:{role_id:role_id },
            beforeSend:function(){ startLoader(btn); },
            success:function(resp){  // alert(resp);
                stopLoader(btn); 
                $('#permissions-view').html(resp.view);
            },
           error:function(jhx,textStatus,errorThrown){ stopLoader(btn);
                checkStatus(jhx.status); 
                }
        });
    }
     
});
 
 
// checkboxes permissions
$(document).on('click','.role-perm-custom',function(){  
    var perm = $(this).val(); 
    var role_id = $(this).data('role'); 
    var status = 'inactive';  $(this).closest('div.col-md-3').removeClass('table-success');
    if($(this).prop('checked')) {  status = 'active';
       $(this).closest('div.col-md-3').addClass('table-success'); }
    var process = "<span class='fa fa-spin fa-spinner fa-3x text-dark'></span>";
    // update permission
    $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/change-role-permission',
            data:{role_id:role_id,perm:perm,status:status },
            beforeSend:function(){ showpop(process,'info'); },
            success:function(resp){  // alert(resp);
               showpop(resp.message) ;
            },
           error:function(jhx,textStatus,errorThrown){ stopLoader(btn);
                checkStatus(jhx.status); 
                }
        });
   // console.log('perm - '+perm+" id = "+roleid + " status = "+status) ;
});
 // role-perm-custom
 
 // Subject Per Level Filter
$(document).on('click','.level-subject-btn',function(){   
  var btn = '.level-subject-btn';    
  var levels =[]; var level_category = $('#level_category').val();
  $.each($("input[name='levels[]']:checked"),function(){
      levels.push($(this).val());
   });    
   if(levels.length === 0 || level_category===""){
        $('#subject-view').html('');
        showpop('Please select Any Academic Level And Level Category','error');
    }
    else {
        $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/load-level-subjects',
            data:{levels:levels,level_category:level_category  },
            beforeSend:function(){ startLoader(btn); },
            success:function(resp){  // alert(resp);
                stopLoader(btn); 
                $('#subjects-view').html(resp.view);
                count_selected_courses(); 
            },
            error:function(jhx,textStatus,errorThrown){ stopLoader(btn);
                checkStatus(jhx.status); 
                }
        });
    }     
});
 
 
$(document).on('click','.finalize-level-subject-btn',function(){   
  var btn = '.finalize-level-subject-btn'; 
  var prev_btn = $('button.level-subject-btn'); 
  var datas = $('form#subject-level-definition').serialize(); 
  if($("input[name='courses[]']:checked").length ===0){
        showpop('Please select One or more subjects','error');
  } else{ 
        $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/submit-level-subjects-definition',
            data: datas ,
            beforeSend:function(){ startLoader(btn); },
            success:function(resp){  showpop(resp.message);
                stopLoader(btn); 
                prev_btn.click();
            },
           error:function(jhx,textStatus,errorThrown){ stopLoader(btn);
                checkStatus(jhx.status); 
                }
        });
    }    
});
 
 
$(document).on('click','.remove-level-subject-btn',function(){   
  if(confirm('Do you want to remove all these selected courses?')) {        
  var btn = '.remove-level-subject-btn';    
  var prev_btn = $('button.level-subject-btn'); 
  var datas = $('form#subject-level-definition').serialize(); 
  if($("input[name='courses[]']:checked").length ===0){
        showpop('Please select One or more subjects','error');
  } else{ 
        $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/remove-level-subjects-definition',
            data: datas ,
            beforeSend:function(){ startLoader(btn); },
            success:function(resp){  showpop(resp.message);
                stopLoader(btn); 
                prev_btn.click();
            },
            error:function(jhx,textStatus,errorThrown){ stopLoader(btn);
                checkStatus(jhx.status); 
                } 
        });
    }   
    
    } // end if confirm 
    
});

    // creating new student / admission info 
    /*****************************************************/
    $(document).on('change','#level_admitted',function(){    
      var level = $(this).val();
      get_rooms_by_level(level);
    });
 
   /** student course selection ****/
   /*************************************************/
   // subject checkboxes 
$(document).on('click','.courses-custom',function(){  
    var subject_id = $(this).val(); 
   // var role_id = $(this).data('role'); 
    var status = 'inactive';  $(this).closest('tr').removeClass('table-success');
    if($(this).prop('checked')) {  status = 'active';
       $(this).closest('tr').addClass('table-success'); }
    });
 // courses-custom
   /*************************************************/

     
 
$(".confirmDelete").click(function(){
    var module = $(this).attr('module');
    var moduleid = $(this).attr('moduleid');
    var title = $(this).attr('title');
  Swal.fire({
            title: 'Are you sure you want to delete this '+title+' '+module+' ?',
            text: "You won't be able to revert this!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Request Successful !!!',
                'success',
              )
              // window.setTimeout(function(){
                  window.location = "/admin/delete-"+module+"/"+moduleid;
              // }, 1500);
              
            }
          })
});
 

        
        $('#section_id').change(function(){
            var section_id = $(this).val(); 
            $.ajax({
                 headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
                  },
		beforeSend:function(){ /**alert('section_id='+section_id); **/ },
                type:'get', url:'/admin/append-categories-level',
                data:{section_id:section_id},
                success:function(resp){
                    $("#appenCategoriesLevel").html(resp);
                },
                error:function(jhx,textStatus,errorThrown){ 
                    checkStatus(jhx.status); 
                    } 
            });
        });       
        
        // Product Attrbutes Add/Remove 
        var maxField = 5; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="form-row"><div class="col-md-3 mb-3">\n\
            <input type="text" value="" class="form-control" name="size[]" placeholder="Size" require="" /> <div class="invalid-feedback">enter the size </div> </div> <div class="col-md-3 mb-3">\n\
            <input type="text" value="" class="form-control" name="sku[]" placeholder="SKU" require=""/>  <div class="invalid-feedback">enter the sku </div> </div> <div class="col-md-3 mb-3"> \n\
            <input type="text" value="" class="form-control" name="price[]" placeholder="Price" require=""/>  <div class="invalid-feedback">enter the price </div> </div> <div class="col-md-2 mb-3">\n\
            <input type="text" value="" class="form-control" name="stock[]" placeholder="Stock" require=""/> <div class="invalid-feedback">enter the stock qty </div> </div> <div class="col-mb-1 mb-3"><a href="javascript:void(0);" class="remove_button text-danger  "><i class="pe-7s-close-circle pe-2x"/></i></a></div>\n\
            </div>'; 
            //New input field html 
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){ 
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).closest('div.form-row').remove();      
        x--; //Decrement field counter
    });
    
    
    // Product Category Selection filters
    $('#category_id').on('change',function(){
       var category_id = $(this).val();
        $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/category_filters',
            data:{category_id:category_id},
            success:function(resp){ 
                 $('.loadFilters').html(resp.view); 
            },
            error:function(jhx,textStatus,errorThrown){ 
            checkStatus(jhx.status); 
            } 
        });       
    });
    
   
    //---------------------------------------------     
    $('.dataTable').dataTable();      
    initDatePicker();    
});

 function initDatePicker(){
        
    flatpickr('.datepicker', {weekNumbers: true, altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d H:i",
    enableTime: true  // time_24hr: true    
     });
    }
    
  function showpop(messages,  types='success'){
        const notyf = new Notyf({
        position: {
            x: 'center',
            y: 'center'
        } ,
        duration:5000,  dismissible:false, icon: true
        }); 
	
        notyf.open({
          type: types,
          message: messages   
        });
    }
    
    function loadStaffRoles(){
       var admin_id = $('#admin-staff').val();
       // console.log(admin_id);
       if(admin_id!=="") load_admin_roles(admin_id);
       else {
            $('#role_list').html("");	
       }
    }
    
    function startLoader(elem='',addBtn=false){
        if(elem===""){
          elem = '.ajaxLoader'; 
        }
       if($(elem).length >0){
             var l = Ladda.create(document.querySelector(elem));  
              if(addBtn===true){ $(elem).addClass(' btn p-4 '); }
              l.start(); 
        } 
    }
    
    function stopLoader(elem='',addBtn=false){
        if(elem===""){
          elem = '.ajaxLoader'; 
        }
       if($(elem).length >0){
             var l = Ladda.create(document.querySelector(elem));  
              if(addBtn===true){ $(elem).removeClass(' btn p-4 '); }
              l.stop(); 
        } 
    }
    
    function load_admin_roles(admin_id=''){
        // startLoader(); 
        if(admin_id !==""){
        $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/get-admin-roles',
            beforeSend:function(){ startLoader(); },
            data:{admin_id:admin_id},
            success:function(resp){stopLoader();
               $('#role_list').html(resp.view);	 
            }, 
           error:function(jhx,textStatus,errorThrown){ stopLoader();
            checkStatus(jhx.status); 
            } 
        });
        }
    }
    
    function uploadme(){ // student passport
       var attached = $('#file').val();  // file attached 
       var elem =  $('.picture_loader'); var spinner = "<span class='fa fa-spin fa-spinner fa-2x'></span>";
       if(attached==""){
            // alert("please browse for the passport");
              $('.picture_loader').html("<div class='alert alert-danger'>please browse for the passport</div> ");
            }
            else if(!is_valid_img(attached)){
              elem.html("<div class='alert alert-danger'> Please Upload Image - Passport </div> ");
            }
            else {
                    mysize = $('#file')[0].files[0].size;
                    mysize = Math.round(mysize / 1024) ;
                    if(mysize > 100){
                        elem.html("<div class='alert alert-danger'> Passport must not be greater than 100KB, size uploading  is "+mysize +" KB");
                    }
                    else {                   
                         var fmD = new FormData(); var pix = $('#file')[0].files;
                         fmD.append('picture',pix[0]); // fmD.append('matricno',matricno); 
                         // send to server
                          $.ajax({
                               headers:{
                                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
                                  },
                                url:'/admin/upload-student-passport', type: 'post',
                                data: fmD,  contentType: false, processData: false,
                                beforeSend:function(){  
                                    elem.html("<div class='alert alert-info'> Uploading Passport &nbsp; &nbsp;"+spinner);
                                    },
                                success: function(response){ 
                                    $('img.student-passport').attr('src',response['path']);
                                    elem.html("<div class='alert alert-"+response['type']+"'>"+response['message']+"</div");
                                },
                               error:function(jhx,textStatus,errorThrown){ stopLoader();
                                    checkStatus(jhx.status); 
                                    } 
                            });
				
				// completed 
			 }  // end else  - succesful upload                         			 
		}
    }
    
    function uploadStaffPsp(){ // student passport
       var attached = $('#file').val();  // file attached 
       var elem =  $('.picture_loader'); var spinner = "<span class='fa fa-spin fa-spinner fa-2x'></span>";
       if(attached==""){
            // alert("please browse for the passport");
              showpop('please browse for the passport','error');
            }
            else if(!is_valid_img(attached)){
             showpop('Please Upload Image File','error');
            }
            else {
                    mysize = $('#file')[0].files[0].size;
                    mysize = Math.round(mysize / 1024) ;
                    if(mysize > 100){
                       showpop('Passport must not be greater than 100KB, size uploading  is '+mysize + ' KB' ,'error');
                    }
                    else {                   
                         var fmD = new FormData(); var pix = $('#file')[0].files;
                         fmD.append('picture',pix[0]); // fmD.append('matricno',matricno); 
                         // send to server
                          $.ajax({
                               headers:{
                                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
                                  },
                                url:'/admin/upload-staff-passport', type: 'post',
                                data: fmD,  contentType: false, processData: false,
                                beforeSend:function(){  
                                     showpop('Uploading Passport &nbsp;'+spinner,'success');
                                    },
                                success: function(response){ 
                                    $('img.staff-passport').attr('src',response['path']);
                                      showpop(response['message'],response['type']);
                                },
                               error:function(jhx,textStatus,errorThrown){ stopLoader();
                                    checkStatus(jhx.status); 
                                    } 
                            });
				
				// completed 
			 }  // end else  - succesful upload 
			 
		}
    }
    
    function is_valid_img(file) {
		var ext = file.split(".");
		ext = ext[ext.length-1].toLowerCase();      
		var arrayExtensions = ["jpg" , "jpeg", "png" ]; // , "png", "bmp", "gif"

		if(arrayExtensions.lastIndexOf(ext) == -1) {			
			return false; 
		}
		return true; 
	}
	
	function getFileSize(file){
		return Math.round(file.size/(1024*1024)); 
	}

    
    function  setAvailQtn(){
         var paper_type = $('#paper_type').val();
         var subject_id = $('#subject-title').val();
    
        var l = Ladda.create(document.querySelector('.ajaxLoader'));  
        $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/get-avail-qtn',
            beforeSend:function(){ l.start(); },
            data:{subject_id:subject_id,paper_type:paper_type},
            success:function(resp){ stopLoader(btn);
                $('#allqtn').val(resp.value);			 
            }, 
             error:function(jhx,textStatus,errorThrown){ stopLoader(btn);
             checkStatus(jhx.status); 
             } 
        });
    }
    
    function handleRoleAssignment(){
        var admin_id = $('#admin-staff').val();
        var roles = $('input:checkbox.role-list:checked').val();
        if(admin_id===undefined || roles===undefined ){
            showpop('Ensure you select the user and the equivalent role qualified for him/her', 'error');
        }
        else {
            $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/set-admin-roles',
            beforeSend:function(){ startLoader('.assign-staff-role-btn'); },
            data: $('#assignRoleForm').serialize(),
            success:function(resp){stopLoader('.assign-staff-role-btn');
               showpop(resp.message,resp.status);
            }, 
            error:function(jhx,textStatus,errorThrown){  stopLoader();
            checkStatus(jhx.status); 
             } 
            });
        }      
    }
    
     
    function handlePasswordReset(){
        var forms = $('#resetPswForm').serialize(); 
        var cp = $('#current_password').val(); var np = $('#new_password').val();
        var cfp = $('#confirm_password').val();
        
        if(cp==="" || np==="" || cfp===""){
            showpop('Ensure you fill all the required informations', 'error');
        }
            else {
              $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/reset-password',
            beforeSend:function(){ startLoader('.password-reset-btn'); },
            data: forms,
            success:function(resp){stopLoader('.password-reset-btn');
               showpop(resp.message,resp.status);
               if(resp.status==='success'){
                  setTimeout(()=> window.location.href=resp.dir , 2000); 
               }
            }, 
            error:function(jhx,textStatus,errorThrown){  stopLoader();
             checkStatus(jhx.status); 
             } 
            });            
        }      
    }
    
    
    function handleLecturerStudentSearch(){
        var forms = $('#studentSearchForm').serialize(); 
        
        $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/my-students',
            beforeSend:function(){ startLoader('.stud-search-btn'); },
            data: forms,
            success:function(resp){stopLoader('.stud-search-btn');
              //  showpop(resp.message,resp.status);
                $('#student-list').html(resp.view);
            }, 
            error:function(jhx,textStatus,errorThrown){  stopLoader('.stud-search-btn');
                checkStatus(jhx.status); 
             } 
            });
    }
 
    
    function handleLecturerStudentResultSearch(){
        var forms = $('#studentResultSearchForm').serialize(); 
        var spin = "<center class='font-size-lg'><span class='fa fa-spin fa-spinner fa-3x'></span>&nbsp; &nbsp;  Loading... </center>";
        $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/search-student-for-manual-result-upload',
            beforeSend:function(){ startLoader('.stud-search-btn');  $('#manual-student-list').html(spin); },
            data: forms,
            success:function(resp){stopLoader('.stud-search-btn');
                  $('#manual-student-list').html(resp.view);
            }, 
            error:function(jhx,textStatus,errorThrown){  stopLoader('.stud-search-btn');
            checkStatus(jhx.status); 
             } 
            });
    }
    
        
    function handleLecturerBulkStudentResultSearch(){
        var forms = $('#bulkStudentResultSearchForm').serialize(); 
        var spin = "<center class='font-size-lg'><span class='fa fa-spin fa-spinner fa-3x'></span>&nbsp; &nbsp;  Loading... </center>";
        $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/search-student-for-bulk-result-upload',
            beforeSend:function(){ startLoader('.stud-search-btn');  $('#bulk-student-file-upload').html(spin); },
            data: forms,
            success:function(resp){stopLoader('.stud-search-btn');
              //  showpop(resp.message,resp.status);
                $('#bulk-student-file-upload').html(resp.view);
            }, 
             error:function(jhx,textStatus,errorThrown){  stopLoader('.stud-search-btn');
            checkStatus(jhx.status); 
             } 
            });
    }
    
    function handleStudentClassAttendanceSearch(){
        var forms = $('#studentClassAttendanceForm').serialize(); 
        
        $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/admin/search-student-for-class-attendance',
            beforeSend:function(){ startLoader('.stud-search-btn'); },
            data: forms,
            success:function(resp){stopLoader('.stud-search-btn');
              //  showpop(resp.message,resp.status);
               // $('#manual-student-list').html(resp.view);
               if(resp.type==='error'){
                    showpop(resp.message,resp.type);
                    $('#manual-student-list').html('');
                }
                else{
                    $('#manual-student-list').html(resp.view);
                }                
            }, 
           error:function(jhx,textStatus,errorThrown){  stopLoader('.stud-search-btn');
            checkStatus(jhx.status); 
             }   
        });
    }
 
 function result_composer_setting(dataText){
      // alert(dataText);  // working        0      1     2     3       4       5
      var options = dataText.split("**"); // id, regno, name, session, term, subjectId
      regno = options[1];   name = options[2]; 
      session = options[3];   term = options[4]; subjectId = options[5];
      
      $('span.stud-name').html("<span class='text-uppercase font-weight-700'>"+regno+"&nbsp;/&nbsp;"+name +"</span> ");      
      $('span.session').html(session); 
      $('span.term').html(getTerm(term)); 
      getSubjectName(subjectId);  // set the subject name 
      setStudentScore(dataText);
 }
 
 
 function getTerm(term){
      values = ["",'1st','2nd','3rd'];      
      return values[term] + ' Term';
 }
 
 function setStudentScore(params){     
     $.ajax({
        headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
        },
        type:'post',
        url:'/admin/get-set-student-scores/',
        data: {params:params} ,
        beforeSend:function(){ 
            $('input#result-params').val(params);
            $('input.ca1_score,input.ca2_score,input.exam_score').prop('disabled',true);
            $('input.ca1_score,input.ca2_score,input.exam_score').val('--');
        },
        success:function(resp){  
           //  alert(resp);
             $('span.ca1_mark').html(resp.ca1_mark);                  
             $('span.ca2_mark').html(resp.ca2_mark);                  
             $('span.exam_mark').html(resp.exam_mark);                  
             // set scores 
             $('input.ca1_score').val(resp.ca1_score);                  
             $('input.ca2_score').val(resp.ca2_score);                  
             $('input.exam_score').val(resp.exam_score);                  
             //
             $('input.ca1_score,input.ca2_score,input.exam_score').prop('disabled',false);
        },
        error:function(jhx,textStatus,errorThrown){  
            checkStatus(jhx.status); 
       }
    }); 
   //  return value; 
 }
 
 function savePostedResult(){
    var data = $('form#studentResultPoster').serialize(); 
      $.ajax({
        headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
        },
        type:'post',
        url:'/admin/manually-save-student-score/',
        data: data ,
        beforeSend:function(){ 
           // $('input#result-params').val(params);
           $('input.ca1_score,input.ca2_score,input.exam_score').prop('disabled',true);
            // $('input.ca1_score,input.ca2_score,input.exam_score').val('--');
            startLoader('.result-poster-btn');
        },
        success:function(resp){  
          // alert(resp); 
           stopLoader('.result-poster-btn');
           $('input.ca1_score,input.ca2_score,input.exam_score').prop('disabled',false);
            if(resp.status === "success"){
               showpop(resp.message, resp.status);
               $('input.ca1_score,input.ca2_score,input.exam_score').val('');                
           }
             if(resp.status === "error"){ 
                 message = "<ul>"; 
                 $.each(resp.errors,function(prefix,val){
                        message += "<li>"+ val[0] +"</li> ";
                  });
                  message +="</ul>";
                showpop(message, resp.status);
              } // end if 
        },
        error:function(jhx,textStatus,errorThrown){ 
            stopLoader('.result-poster-btn');
           // showpop(errorThrown,'error');
            $('input.ca1_score,input.ca2_score,input.exam_score').prop('disabled',false);
            checkStatus(jhx.status); 
       }
    }); 
    
 }
 
 
 function hideInactiveTables(){
     $('table tr.inactive').hide();
     console.log('hidden');
 }

 function showInactiveTables(){
     $('table tr.inactive').show();
     console.log('shown');
 }

 
 function getSubjectName(id){     
     $.ajax({
        headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
        },
        type:'get',
        url:'/admin/get-subject-name/'+id,
        data: {id:id } ,
        beforeSend:function(){  },
        success:function(resp){  
            $('span.subject').html(resp.name);                      
        },
        error:function(jhx,textStatus,errorThrown){  
            checkStatus(jhx.status); 
       }
    }); 
   //  return value; 
 }
 
 function handleManualResultSearch(){
     var regno = $('#regno').val();
     $.ajax({
        headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
        },
        type:'post',
        url:'/admin/search-student-result-manually',
        beforeSend:function(){ startLoader('.stud-result-manual-search-btn'); },
        data: {regno:regno},
        success:function(resp){stopLoader('.stud-result-manual-search-btn');
          if(resp.status === "success"){
               showpop(resp.message, resp.status);
               $('.manual-search-result').html(resp.view);                
           }
             if(resp.status === "error"){ 
                 message = "<ul>"; 
                 $.each(resp.errors,function(prefix,val){
                        message += "<li>"+ val[0] +"</li> ";
                  });
                  message +="</ul>";
                showpop(message, resp.status);
                 $('.manual-search-result').html("");
              } // end if 
           
        }, 
        error:function(jhx,textStatus,errorThrown){ stopLoader('.stud-result-manual-search-btn');
            $('.manual-search-result').html("");
            console.log(""+textStatus+' - '+errorThrown);}
        });
 }
 
 function count_selected_courses(){      
   var tot = $('input.level-subject-custom:checked,.courses-custom:checked').length; 
    $('span.tot-subject').text(tot); 
    console.log(tot);
 }   


    function checkStatus(code){
        if(code===419){
            swal.fire('Your Active Session Has Expired ','You have to login again','error').then((result) => {        
               window.location = "/portal/login";             
             });
        }
    }
    
    function get_rooms_by_level(level,stud_id=''){
        $.ajax({
        headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
        },
        type:'post',
        url:'/admin/get-rooms-by-level',
        data: {level:level,stud_id:stud_id} ,
        beforeSend:function(){ startLoader(); },
        success:function(resp){  
            $('.class_room_loader').html(resp.view);
            stopLoader();           
        },
        error:function(jhx,textStatus,errorThrown){ stopLoader();
           checkStatus(jhx.status); 
       }
    }); 

    }

    function load_country_states(country_id,stud_id = ''){
       $.ajax({
        headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
        },
        type:'post',
        url:'/admin/load-country-states',
        data: {country_id:country_id, stud_id:stud_id} ,
        beforeSend:function(){ startLoader(); },
        success:function(resp){  
            $('.state_loader').html(resp.view);
            stopLoader();  setTimeout( function(){$('#state').trigger('change');},500); 
        },
        error:function(jhx,textStatus,errorThrown){ stopLoader();
           checkStatus(jhx.status); 
       }
    }); 
    }
    
    function load_state_cities(state_id, stud_id=''){
       $.ajax({
        headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
        },
        type:'post',
        url:'/admin/load-state-cities',
        data: {state_id:state_id, stud_id:stud_id} ,
        beforeSend:function(){ startLoader(); },
        success:function(resp){  
            $('.city_loader').html(resp.view);
            stopLoader();           
        },
        error:function(jhx,textStatus,errorThrown){ stopLoader();
           checkStatus(jhx.status); 
       }
    }); 
    }
     
     // UNDER STUDENT ATTENDANCE
     function toggleAttendanceRow(elem){
         state = (elem.prop('checked')); 
         if(state){
             elem.closest("tr").addClass('table-success');
         }
         else {
             elem.closest("tr").removeClass('table-success');
         }
     }
     
    function submitClassAttendance(){
        params = $("#params").val(); students = []; 
        // students = $("input[name='students[]']:checked"); 
        $.each($("input[name='students[]']:checked"),function(){
            students.push($(this).val());
         });   
        Swal.fire({
            title: 'Are you sure that the attendance records are taken properly',
            text: "You won't be able to revert this!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Submit Attendance!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Attendance Submitted!',
                'Request Successful !!!',
                'success',
              );
              // window.setTimeout(function(){
             window.location = "/admin/submit-class-attendance/"+params+"/"+students;
              // }, 1500);
              
            }
          });
     }

    function loadStudentAdmLevels(){
        var level = $('#level_admitted').val();
        var stud_id = $('#stud_id').val();        
          get_rooms_by_level(level,stud_id);           
    }
    
    function load_student_state_of_origin(){
        var country_id = $('#country').val(); var stud_id = $('#stud_id').val();
        load_country_states(country_id,stud_id); 
       // setTimeout( load_student_cities(),2000);
    }
    
    
    function load_student_cities(){
        var state_id = $('#state').val(); var stud_id = $('#stud_id').val();
        load_state_cities(state_id,stud_id); 
    }
    
    function course_registration_countdown(){
        // Set the date we're counting down to
    var set_time = document.getElementById('countdown_date').value;
    var countDownDate = new Date(set_time).getTime();
    // var countDownDate = new Date("Jan 1, 2024 00:00:00").getTime();

    // Update the countdown every 1 second
    var x = setInterval(function() {
        // Get the current date and time
        var now = new Date().getTime();

        // Calculate the remaining time
        var distance = countDownDate - now;

        // Calculate days, hours, minutes, and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        var output =  "<table class='time-table'>";
        output += "<tr><td class='btn btn-lg btn-dark ml-3 pl-3'>"+days+" <span>Days</span></td><td class='btn btn-lg w-30 btn-dark ml-3 pl-3'>"+hours+" <span>Hours</span></td>";
            output += "<td class='btn btn-lg w-30 btn-dark ml-3 pl-3'>"+minutes+" <span>Mins</span></td><td class='btn btn-lg w-30 btn-dark ml-3 pl-3'>"+seconds+" <span>Sec</span></td></tr>";        
        output += "</table>";
        
        // Display the countdown
        document.getElementById("countdown").innerHTML = output; 
       
        // If the countdown is over, display a message
        if (distance < 0) {
            clearInterval(x);
            var output =  "<table class='time-table'>";
             output += "<tr><td class='btn btn-lg btn-dark ml-3 pl-3'>"+0+" <span>Days</span></td><td class='btn btn-lg w-30 btn-dark ml-3 pl-3'>"+0+" <span>Hours</span></td>";
             output += "<td class='btn btn-lg w-30 btn-dark ml-3 pl-3'>"+0+" <span>Mins</span></td><td class='btn btn-lg w-30 btn-dark ml-3 pl-3'>"+0+" <span>Sec</span></td></tr>";        
             output += "</table>";
            document.getElementById("countdown").innerHTML = output;
            
            $('#studentCourseForm').html("<h3 class='font-weight-bold'>Course Registration Has Closed !!! </h3>");  
        }
    }, 1000);
    }
    
    // mayorjo4ever@gmail.com
    // mayorjo82@yahoo.com
    // Mayoskele7$
    // 12151215
    
// new undergraduate portal 
// 202210801695HA
    // Ashman13
    