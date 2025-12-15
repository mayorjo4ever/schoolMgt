@extends('front.arch_layouts.examlayout')
@section('content')
    @include('admin.arch_widgets.alert_message')
    
    <x-admin.card>
        <p class="font-weight-600 font-size-lg">
           
        </p>
        <pre>
        <?php print_r(Session::get('questions')->toarray()) ?>
</pre>
    </x-admin.card>
@endsection 