<table style="border:5px">
    <thead>
        <tr>
            <td colspan="5">{{$title}}</td>
        </tr>
        <tr style="text-transform: uppercase;">
        <th># ID </th> 
        <th>NAME  </th>
        <th>PAPER STATUS</th>
        <th>SCORE</th>
        <th>OBTAINABLE SCORE</th>
    </tr>
    </thead>
    <tbody>
    @foreach($results as $user)
        <tr> 
        <td>{{$user['user_id']}}</td>
        <td>{{users_name($user['user_id'])}}</td>
        <td>{{$user['paper_status']}}</td>
        <td>{{$user['score']}}</td>      
        <td>{{$user['max_score']}}</td>      
    </tr>
    @endforeach
    </tbody>
</table>