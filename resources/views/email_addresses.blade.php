@extends('layouts.default', ['nav_email_addresses' => 'active'])

@section('content')
    <div class='email-addresses'>

        <form id='add-email-address-form' onsubmit="return saveAddress()">
            <h1>Add Email Address</h1>
            <input autocomplete="off" type='text' id='new-email-address' onkeyup="updatePreview()">
            <div id='address-error' class='flash-error' style='display: none'>You may only use numbers, letters, and underscores.  Do not include the domain.</div>
            <span id='address-preview'>Enter the mailbox name you'd like to create (@mail.mapil.co will be added automatically)</span>
            <br><br>
            <button type='submit'>Create</button>
            <button type='button' class='gray' onclick="toggleForm()">Cancel</button>
        </form>   

        <div class="flex-boxes" id='intro'>
            <div class="flex-box">
                
                <h1 class="flex-title">Welcome to Mapil. These are your email addresses.</h1>

                <p class='text-left'>
                    Any mail sent to these addresses will show up on the Email Logs page.  You can also access them via the API.  
                    @if(Auth::user()->api_credentials()->first())
                        Here are your API credentials (these are normally found on the Account page):
                        </p>                
                        <p>
                        <strong>Token:</strong> {{Auth::user()->api_credentials()->first()->token}}<br />
                        <strong>Secret:</strong> 
                        <span id='api-secret-group' class='api-secret-group'>
                            <span class='api-secret'>
                                {{Auth::user()->api_credentials()->first()->secret}}
                            </span>
                            <span class='toggle-show' onclick="toggleSecret()">
                                Show
                            </span>
                            <span class='toggle-hide' onclick="toggleSecret()">
                                Hide
                            </span>                            
                        </span>
                    @endif
                </p>                
            </div>
        </div>  


        <table>
            <thead>
                <tr>
                    <th>Email Address</th>
                    <th class='text-right'>
                        @if(count($email_addresses) < Auth::user()->getEmailAddressLimit()) 
                            <button class='green' onclick="toggleForm()">Add Address</button>
                        @else 
                            <button class='gray' disabled>Add Address (limti reached)</button>
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody id='email-table-body'>
                @foreach($email_addresses as $email)
                    <tr id='row-{{$email->uuid}}'>
                        <td>{{ $email->email }}</td>
                        <td class='text-right'><button class='red' onclick="deleteAddress('{{ $email->uuid }}')">Delete</button></td>
                    </tr>
                @endforeach
            </tbody>        
        </table>
    </div>
<script>
    var csrf_token = "{{ csrf_token() }}";
    function toggleForm() {
        $('#add-email-address-form').toggle();
        $('.email-addresses table').toggle();
        $('#intro').toggle();
    }
    function validate(val) {
        var pattern = new RegExp(/^[a-zA-Z0-9_]*$/);
        return pattern.test(val);
    }    
    function deleteAddress(id) 
    {   
        if(!confirm('Are you sure you want to delete this address?')) {
            return;
        }
        http('/email-addresses','DELETE',{_token: csrf_token, id: id},function(err, response){
            if(err) {
                $.growl.error({ message: err, fixed: true });
                return;
            }
            csrf_token = response.new_token;
            $('#row-' + id).remove();
            $.growl.notice({ message: "Address deleted"});
        });
    }
    function saveAddress() {
        http('/email-addresses','POST',{_token: csrf_token, email: $('#new-email-address').val()},function(err, response){
            if(err) {
                $.growl.error({ message: err, fixed: true });
                return;
            }
            csrf_token = response.new_token;
            $('#email-table-body').prepend('<tr id="row-' + response.id + '"><td>' + response.email + "</td><td class='text-right'><button class='red' onclick=\"deleteAddress('" + response.id + "')\">Delete</button></td></tr>");
            $('#new-email-address').val('');
            $.growl.notice({ message: "Address saved"});
            toggleForm();
        });
        return false;
    }
    function toggleSecret() {
        $('#api-secret-group').toggleClass('shown');
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
            $('#address-preview').text("Enter the mailbox name you'd like to create (\@mail.mapil.co will be added automatically)");
        } else {
            $('#address-preview').text("The address " + val + "\@mail.mapil.co will be created");
        }
    }

</script> 

@endsection
