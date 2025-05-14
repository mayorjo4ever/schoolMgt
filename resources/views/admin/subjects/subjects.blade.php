@extends('admin.arch_layouts.layout')
@section('content')
<div class="row mt-0 pt-0">
        <div class="col-md-12"> 
              @if(Session::has('success_message'))
                <div class="alert alert-success fade show " role="alert"> 
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <span class="pe-7s-check pe-2x"></span> &nbsp;&nbsp; <strong> {{Session::get('success_message')}} </strong> 
                </div>
              @endif
             
        <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
            <div class="card-header">Available Subjects
                <!--<div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus">Last Week</button>
                            <button class="btn btn-focus">All Month</button>
                    </div>
                </div> -->
            </div>
        <div class="table-responsive  mt-2 pt-2 ">
        <table class="align-middle mb-0 table table-borderless table-striped table-hover dataTable">
            <thead>
            <tr>
                <th class="pl-4"># Subject ID </th> 
                <th >Title</th>
                <th >Code</th>
                <th >Status</th>
                <th>Edit / Delete </th>
                <th>Last Updated </th>
            </tr>
            </thead>
            <tbody> @foreach($subjects as $subject )
            <tr>
                <td class="text-muted pl-4"># {{ $subject['id']}} </td>
                <td> {{ $subject['title']}} </td> 
                <td> {{ $subject['code']}} </td> 
                <td>
                         @if($subject['status']==1)                                     
                            <a class="updateBrandStatus" id="brand_id-{{ $subject['id']}}" brand_id="{{ $subject['id']}}" href="javascript:void(0)">
                                <i class="pe-7s-check pe-2x font-weight-bold text-success " status="active"></i> </a>
                           @else <a class="updateBrandStatus" id="brand_id-{{ $subject['id']}}" brand_id="{{ $subject['id']}}" href="javascript:void(0)">
                              <i class="pe-7s-attention pe-2x  text-danger font-weight-bold"  status="inactive"></i></a>
                          @endif
                </td>
                <td >
                        <a class="" brand_id="{{ $subject['id']}}" href="{{url('admin/add-edit-subject/'.$subject['id']) }}">
                            <i class="pe-7s-pen pe-2x text-danger" status="active"></i> </a>
                         
                        &nbsp; &nbsp; 
                           <a class="confirmDelete" title="{{ $subject['title']}}" module="subject" moduleid="{{ $subject['id']}}" href="javascrpt:void(0)">
                          <i class="pe-7s-trash pe-2x text-danger" ></i></a>

                </td>
                <td> {{ \Carbon\Carbon::parse($subject['updated_at'])->diffForHumans()}}</td>
                </tr>
                    @endforeach
                </tbody>
        </table>
        </div>

        </div>
    </div>
</div>

@endsection 