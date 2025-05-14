 <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
     <div class="card-body"><form method="post" action="{{url('admin/students')}}">@csrf
       <div class="form-row">
           <div class="col-md-3">
               <label class="">Academic Sessions  </label>
               <select class="form-control" name="q">
                   <optgroup label="Academic Session">                                               
                        @foreach($sessions as $sess)
                        <?php $sess = $sess."/".($sess+1);?>
                        <option value="{{$sess}}">Session -->{{$sess}} </option> @php ##  @selected($calendar['current_session']==$sess) @endphp
                        @endforeach
                   </optgroup>  
                 </select>
           </div><!-- ./  col-md-3-->
           <div class="col-md-3 mb-3">
               <label class="">Classrooms / Levels </label>
               <select class="form-control" name="q2">
                    <optgroup label="Current Level">
                       @foreach($levels as $k=>$v)
                       <option value="CL**{{$k}}">Current Level --> {{$v}}</option>
                       @endforeach
                   </optgroup>
                   
                      <optgroup label="Admitted Level">
                       @foreach($levels as $k=>$v)
                       <option value="LA**{{$k}}">Admitted To --> {{$v}}</option>
                       @endforeach
                   </optgroup>
                 </select>
           </div><!-- ./  col-md-3-->
           <div class="col-md-3 mb-3">
               <label class="">Biological Data  </label>
               <select class="form-control" name="q3">
                     <optgroup label="Gender">                      
                       <option value="Gender**Male">Gender --> Male</option>
                       <option value="Gender**Female">Gender --> Female</option>
                     
                   </optgroup>
                 </select>
           </div><!-- ./  col-md-3-->
            <div class="col-md-3 mb-3">  &nbsp;  
                <button type="submit" class="btn btn-lg btn-primary mt-2 w-100">Search &nbsp; <span class="pe-7s-search font-weight-bold"></span> </button>
           </div><!-- ./  col-md-3-->
         </div><!-- ./  form-row-->
         </form>
      </div><!-- ./ card-body-->
  </div><!-- ./ main-card -->
