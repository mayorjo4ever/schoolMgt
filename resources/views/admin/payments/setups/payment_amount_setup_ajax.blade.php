
<div class="card-header">
    Select list of Items to include for {{$data['session']}} session     
</div>

<div class="card-body">
    <table class="table table-responsive table-hover">
        <thead class="table-dark">
            <tr>
                <td>S/N</td>
                <td>Item Name</td>
                <td>Amount</td>
                <td>Compulsory/Optional</td>
                <td>Last Update</td>
            </tr>
        </thead>
        <tbody> @php $n=0; @endphp
            @foreach($paymentItems as $item)
            <tr>
                <td>{{ ($n+1)}} </td>
                <td>{{$item['name']}}</td>
                <td><input type="text" class="form-control" value="{{$item['name']}}" /></td>
                <td>{{$item['name']}}</td>
                <td>{{$item['updated_at']}}</td>
            </tr> @php $n++ @endphp
            @endforeach
            
        </tbody>
    </table>
</div>


@foreach($data as $d)
<span class="h3"> {{ $d}} </span>
@endforeach

<pre>


