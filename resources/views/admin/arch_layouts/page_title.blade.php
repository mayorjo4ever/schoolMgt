<div class="app-page-title">
		<div class="page-title-wrapper">
			<div class="page-title-heading">
				<div class="page-title-icon">
					<strong><i class="{{$page_info['icon']??'pe-7s-plane'}} icon-gradient bg-mean-fruit">
					</i></strong>
				</div>
                            <div> <strong> {{$page_info['title']?? str_replace('_',' ',env('APP_NAME'))}} </strong>
					<div class="page-title-subheading">{{$page_info['sub-title'] ??'Developed by OJO Isaac Mayowa'}}
					</div>
				</div>
			</div>
			<div class="page-title-actions">				
				@isset($btns)                                
                                  <div class="btn-list">
                                     @foreach($btns as $btn)
                                    <a href="{{url($btn['action'])}}" class="{{$btn['class']}} d-none d-sm-inline-block" >                                                            
                                        <strong> {{$btn['name']}}</strong>
                                    </a>
                                    @endforeach
                                  </div>
                                  @endif
			</div>    
			</div>
	</div> 