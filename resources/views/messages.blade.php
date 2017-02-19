@extends('layouts.default', ['nav_messages' => 'active'])

@section('pagination')
    <div class="pagination-container">
        @if($page > 1) 
            <a href='/messages?page={{$page-1}}' class='button'>Prev</a>
        @else
            <button disabled>Prev</button>
        @endif
        @if($offset + $page_size < $count) 
            <a href='/messages?page={{$page+1}}' class='button'>Next</a>
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
                    <th class='button-column'></th>
                </tr>
            </thead>
            <tbody id='email-table-body'>
                @foreach($emails as $email)
                    <tr id='row-{{$email->_id}}'>
                        <td>{{ $email->_id }}</td>
                        <td>{{ (@$email->received_at ? gmdate("Y-m-d\TH:i:s\Z", @$email->received_at->__toString() / 1000) : '') }}</td>
                        <td>{{ @$email->from[0]->address }}</td>
                        <td>{{ @$email->mapil_email }}</td>
                        <td class='text-right'>
                            <a href='/messages/{{$email->_id}}/text' target="_blank" title="View TEXT part" class='button gray'>txt</a>
                            <a href='/messages/{{$email->_id}}/html' target="_blank" title="View rendered HTML" class='button gray'>&#60;&#62;</a>
                            <a href='/messages/{{$email->_id}}/json' target="_blank" title="View raw JSON" class='button gray'>&#123;&#125;</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>        
        </table>

        @yield('pagination')
    </div>
<script>
    mixpanel.track('messages_page_viewed');
</script>

@endsection
