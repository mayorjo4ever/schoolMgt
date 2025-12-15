@props(['header' => null, 'footer' => null])

<div class="row">
        <div class="col-12">
          <div class="main-card ml-4 pl-4 mt-0 pt-0 mb-4 pb-4 mr-4 pr-4 card">
           @isset($header)
            <div class="card-header bg-secondary text-white ">  {{ $header }} </div>
           @endisset

            <div class="card-body px-3 pb-2">

                {{ $slot }}

            </div><!--./ card-body -->

            @isset($footer)
                <div class="card-footer text-muted bg-light">
                    {{ $footer }}
                </div>
            @endisset
            
             
        </div><!--./ card -->
        </div><!--./ col-12 -->
    </div><!--./ row -->