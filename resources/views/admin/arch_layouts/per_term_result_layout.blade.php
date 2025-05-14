<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta http-equiv="Content-Language" content="en">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title> {{ $page_info['title']??'Online Stores' }}</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
      <meta name="description" content="This is an example dashboard created using build-in elements and components.">
      <meta name="msapplication-tap-highlight" content="no">      
      <link href="{{asset('template/arch/main.css')}}" rel="stylesheet">
       
   </head>
   <body>
       
      <div class="app-container app-theme-white body-tabs-shadow fixed-header"> <!--fixed-sidebar-->
         
         <div class="app-main  mt-0 pt-0"> 
             <div class="app-main__outer">
               <div class="app-main__inner ">        
                  @yield('content') 
               
            </div>
         </div>
      </div>
      <script src="{{url('front/js/jquery-3.3.1.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('template/arch/assets/scripts/main.js')}}"></script>
      <script type="text/javascript" src="{{asset('template/arch/assets/scripts/jquery.dataTables.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('template/arch/assets/scripts/dataTables.bootstrap4.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('template/arch/assets/scripts/sweetalert2.all.min.js')}}"></script>
      <script src="{{ url('front/js/notyf.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('template/dist/js/custom.js')}}"></script>
       
     <!-- --> 
      
   </body>
</html>
