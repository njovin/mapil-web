@extends('layouts.secure')

@section('pagination')
    <div class="pagination-container">
        @if($page > 1) 
            <a href='/logs?page={{$page-1}}' class='button'>Prev</a>
        @else
            <button disabled>Prev</button>
        @endif
        @if($offset + $page_size < $count) 
            <a href='/logs?page={{$page+1}}' class='button'>Next</a>
        @else 
            <button disabled>Next</button>
        @endif
    </div>
@endsection

@section('content')
    <div class='email-logs'>
        @yield('pagination')

        <table>
            <thead>
                <tr>
                    <th>Message ID</th>
                    <th>Received (UTC)</th>
                    <th>From</th>
                    <th>To</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id='email-table-body'>
                @foreach($emails as $email)
                    <tr id='row-{{$email->_id}}'>
                        <td>{{ $email->_id }}</td>
                        <td>{{ @$email->received_at }}</td>
                        <td>{{ @$email->from[0]->address }}</td>
                        <td>{{ @$email->mapil_email }}</td>
                        <td class='text-right'>
                            <a href='/logs/{{$email->_id}}/text' class='button gray'>txt</a>
                            <a href='/logs/{{$email->_id}}/html' class='button gray'>&#60; &#62;</a>
                            <a href='/logs/{{$email->_id}}/json' class='button gray'>&#123; &#124;</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>        
        </table>

        @yield('pagination')
    </div>
<script>
 

</script> 

@endsection
