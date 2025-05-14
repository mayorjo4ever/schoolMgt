@if(Session::has('error_message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error: </strong> {{ Session::get('error_message') }}
        <button type="button" class="close" data-dismiss="alert" ><span>&times </span> </button>
    </div>
  @endif

  @if(Session::has('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Successful: </strong> {{ Session::get('success_message') }}
        <button type="button" class="close" data-dismiss="alert" > <span>&times </span></button>
    </div>
  @endif

   @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          <button type="button" class="close" data-dismiss="alert" > <span>&times </span> </button>
   </div>
   @endif