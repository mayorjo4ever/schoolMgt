 <div class="app-footer">
	<div class="app-footer__inner">
		<div class="app-footer-left">
			<ul class="nav">
				@can('import-student')<li class="nav-item">
					<a href="{{url('admin/students/import')}}" class="nav-link">
                                        Import New Students
					</a>
				</li> @endcan
				@can('view-student')<li class="nav-item">
					<a href="{{url('admin/students')}}" class="nav-link">
						View All Students
					</a>
				</li>@endcan
			</ul>
		</div>
		<div class="app-footer-right">
			<ul class="nav">@can('import-question')
				<li class="nav-item">
					<a href="{{url('admin/questions/import')}}" class="nav-link">
						Import Questions
					</a>
				</li>@endcan 
				@can('create-exam-schedule')<li class="nav-item">
					<a href="{{url('admin/add-edit-schedule')}}" class="nav-link">
						<div class="badge badge-success mr-1 ml-0">
							Create New Schedule
						</div>
						
					</a>
				</li>@endcan
			</ul>
		</div>
	</div>
</div>