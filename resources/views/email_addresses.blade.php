@extends('layouts.secure')

@section('content')
    <div class='email-addresses'>
        <form id='add-email-address-form' onsubmit="return saveAddress()">
            <h1>Add Email Address</h1>
            <input type='text' id='new-email-address' onkeyup="updatePreview()">
            <div id='address-error' class='flash-error' style='display: none'>You may only use numbers, letters, and underscores.  Do not include the domain.</div>
            <span id='address-preview'>Enter the mailbox name you'd like to create (@email.mapil.co will be added automatically)</span>
            <br><br>
            <button type='submit'>Create</button>
            <button type='button' class='gray' onclick="toggleForm()">Cancel</button>
        </form>        
        <table>
            <thead>
                <tr>
                    <th>Email Address</th>
                    <th class='text-right'><button class='green' onclick="toggleForm()">Add Address</button></th>
                </tr>
            </thead>
            <tbody>
                @foreach($email_addresses as $email)
                    <tr>
                        <td>{{ $email->email }}</td>
                        <td class='text-right'><button class='red'>Delete</button></td>
                    </tr>
                @endforeach
            </tbody>        
        </table>
    </div>

<script>
    function toggleForm() {
        $('#add-email-address-form').toggle();
        $('.email-addresses table').toggle();
    }
    function validate(val) {
        var pattern = new RegExp(/^[a-zA-Z0-9_]*$/);
        return pattern.test(val);
    }    
    function saveAddress() {
        http('/test','GET',{},function(err, response){
            if(err) {
                return;
            }
        });
        return false;
    }
    function updatePreview() {
        var val = $('#new-email-address').val();
        if(!validate(val)) {
            $('#address-error').show();
            $('#address-preview').hide();
            return;
        }
        $('#address-error').hide();
        $('#address-preview').show();
        if(val.length < 1) {
            $('#address-preview').text("Enter the mailbox name you'd like to create (\@email.mapil.co will be added automatically)");
        } else {
            $('#address-preview').text("The address " + val + "\@email.mapil.co will be created");
        }
    }

</script> 

@endsection
