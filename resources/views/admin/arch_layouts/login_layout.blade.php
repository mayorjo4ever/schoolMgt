<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta http-equiv="Content-Language" content="en">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title> {{ $page_info['title']?? str_replace('_',' ',env('APP_NAME')) }}</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
      <meta name="description" content="This is an example dashboard created using build-in elements and components.">
      <meta name="msapplication-tap-highlight" content="no">      
      <link href="{{asset('template/arch/main.css')}}" rel="stylesheet">      
      <link rel="stylesheet" href="{{ url('front/css/notyf.min.css')}}">
      <link rel="stylesheet" href="{{url('front/css/ladda-themeless.css')}}">      
   </head>
   <body >
      <div class="app-container app-theme-white body-tabs-shadow "  style="background:url({{asset('template/arch/assets/images/kindergarten-teacher.jpg')}}); background-repeat: no-repeat; background-size:100% 120%; "> <!--fixed-sidebar-->
         
         <div class="app-main mt-0 pt-0">
            
            <div class="app-main__outer  mt-0 pt-0">
               <div class="app-main__inner  mt-0 pt-0">                 
                  @yield('content')
               </div>
                
            </div>
         </div>
      </div>
      <script src="{{url('front/js/jquery-3.3.1.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('template/arch/assets/scripts/main.js')}}"></script>      
      <script src="{{ url('front/js/notyf.min.js')}}"></script>       
    <script src="{{url('front/js/spin.js')}}"></script>    
    <script src="{{url('front/js/ladda.js')}}"></script>    
  
      
      <script>
                // Example starter JavaScript for disabling form submissions if there are invalid fields
                (function() {
                    'use strict';
                    window.addEventListener('load', function() {
                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                        var forms = document.getElementsByClassName('needs-validation');
                        // Loop over them and prevent submission
                        var validation = Array.prototype.filter.call(forms, function(form) {
                            form.addEventListener('submit', function(event) {
                                if (form.checkValidity() === false) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }
                                form.classList.add('was-validated');
                            }, false);
                        });
                    }, false);
                })();
                
                
    $(function(){
      var log_messager = $("#login-message"); log_messager.hide('fast');
    $('#loginForm').submit(function(ev){ ev.preventDefault();
        var l = Ladda.create(document.querySelector('.login-btn'));  
        var formdata = $(this).serialize(); 
          $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/portal/login',
            data:formdata,
            beforeSend :function(){ $(document).find('span.error-text').text(''); log_messager.hide('fast'); l.start(); $("span.message").text(''); ; } , 
            success:function(resp){ l.stop(); 
              if(resp.type==="success"){
                  // log_messager.show('fast'); 
                  // log_messager.removeClass('alert-danger').addClass('alert-success');
                   // $("span.message").text(resp.message);
                  showpop(resp.message);
                   window.location.href = resp.url; 
              }
              else if(resp.type==="incorrect" || resp.type==="inactive"){
                  //log_messager.show('fast'); 
                  //log_messager.removeClass('alert-success').addClass('alert-danger');
                  // $("span.message").text(resp.message);
                  showpop(resp.message,'error');
              }
              else if(resp.type==="error"){
                  $.each(resp.errors,function(prefix,val){
                       $('span.admin_'+prefix+'_error').text(val[0]);
                  });
              }              
            }, 
            error:function(jhx,textStatus,errorThrown){ l.stop(); 
                alert(""+textStatus+' - '+errorThrown);}
            });
        });
    
    /***********************************/
    $('#forgotPswForm').submit(function(ev){ ev.preventDefault();
        var l = Ladda.create(document.querySelector('.forgot-btn'));  
        var formdata = $(this).serialize(); 
          $.ajax({
            headers:{
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')  
            },
            type:'post',
            url:'/portal/forgot-password',
            data:formdata,
            beforeSend :function(){ $(document).find('span.error-text').text('');
               l.start(); $("span.message").text(''); ; } , 
            success:function(resp){ l.stop(); 
              if(resp.type==="success"){
                  showpop(resp.message);
                  // window.location.href = resp.url; 
              }
              else if(resp.type==="incorrect" || resp.type==="inactive"){
                 showpop(resp.message,'error');
              }
              else if(resp.type==="error"){
                  $('.invalid-feedback').show(); 
                  $.each(resp.errors,function(prefix,val){
                       $('span.admin_'+prefix+'_error').text(val[0]);
                  });
              }              
            }, 
            error:function(jhx,textStatus,errorThrown){ l.stop(); 
                alert(""+textStatus+' - '+errorThrown);}
            });
        });
      
    });     

    
    
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
            </script>
        
   </body>
</html>
