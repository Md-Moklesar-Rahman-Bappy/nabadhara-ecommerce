@extends('frontend.layouts.user_panel')

@section('panel_content')

    <!-- Address -->
    <div class="row">
        <div class="col-lg-7">
            <div class="card mb-3 mb-lg-0">
                <div class="card-header">
                    <h3>{{ translate('Billing and Shipping Address') }}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th>Name: </th>
                                <td>{{Auth::user()->name}} </td>
                            </tr>
                            <tr>
                                <th>Email: </th>
                                <td>{{Auth::user()->name}}</td>
                            </tr>
                            <tr>
                                <th>Full Address: </th>
                                <td>{{Auth::user()->address}}</td>
                            </tr>
                            <tr>
                                <th>Country: </th>
                                <td>{{Auth::user()->country}} </td>
                            </tr>
                            <tr>
                                <th>City: </th>
                                <td>{{Auth::user()->city}}</td>
                            </tr>
                            <tr>
                                <th>Post Code: </th>
                                <td>{{Auth::user()->postal_code}}</td>
                            </tr>
                            <tr>
                                <th>Phone: </th>
                                <td>{{Auth::user()->phone}}</td>
                            </tr>
                            
                        </tbody>
                    </table>

                    <a href="#" data-toggle="modal" data-target="#edit-address-modal" class="btn btn-fill-out btn-block">Edit</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-address-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content" style="margin-top: 50px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ translate('Edit Address') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.save_address') }}" class="form-default" role="form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{Auth()->user()->name}}" placeholder="{{ translate('Your full name')}}" disabled>
                                </div>
            
                                <div class="form-group">
                                    <label for="">Email *</label>
                                    <input type="text" class="form-control" name="email" value="{{Auth()->user()->email}}" placeholder="{{ translate('Your email')}}" disabled>
                                </div>
            
                                <div class="form-group">
                                    <label for="">Full Address *</label>
                                    <input type="text" class="form-control" name="address" value="{{Auth()->user()->address}}" placeholder="{{ translate('Enter your full address')}}" required>
                                </div>
            
                                <div class="form-group">
                                    <label for="">Country *</label>
                                    <div class="custom_select">
                                        <select class="form-control" name="country" required>
                                            <option value="">Select Country</option>
                                            @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                                <option value="{{ $country->name }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    @if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'area_wise_shipping')
                                        <label for="">City *</label>
                                        <select class="form-control" name="city" required>
                                            <option value="">Select City</option>
                                            @foreach (\App\City::get() as $key => $city)
                                                <option value="{{ $city->name }}">{{ $city->getTranslation('name') }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <label for="">City *</label>
                                        <input type="text" class="form-control" placeholder="{{ translate('Enter your city')}}" value="{{Auth()->user()->city}}" name="city" required>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">Post Code *</label>
                                    <input type="text" class="form-control" value="{{Auth()->user()->postal_code}}" placeholder="{{ translate('Enter Postal code')}}" name="postal_code" required>
                                </div>
            
                                <div class="form-group">
                                    <label for="number">Phone *</label>
                                    <input type="number" lang="en" min="0" class="form-control" value="{{Auth()->user()->phone}}" placeholder="{{ translate('Enter phone')}}" name="phone" required>
                                </div>

                                <button type="submit" class="btn btn-fill-out btn-block">{{ translate('Submit')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script type="text/javascript">
    function add_new_address(){
        $('#new-address-modal').modal('show');
    }

    $('.new-email-verification').on('click', function() {
        $(this).find('.loading').removeClass('d-none');
        $(this).find('.default').addClass('d-none');
        var email = $("input[name=email]").val();

        $.post('{{ route('user.new.verify') }}', {_token:'{{ csrf_token() }}', email: email}, function(data){
            data = JSON.parse(data);
            $('.default').removeClass('d-none');
            $('.loading').addClass('d-none');
            if(data.status == 2)
                AIZ.plugins.notify('warning', data.message);
            else if(data.status == 1)
                AIZ.plugins.notify('success', data.message);
            else
                AIZ.plugins.notify('danger', data.message);
        });
    });
    
    function edit_address(address) {
        var url = '{{ route("addresses.edit", ":id") }}';
        url = url.replace(':id', address);
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'GET',
            success: function (response) {
                $('#edit_modal_body').html(response);
                $('#edit-address-modal').modal('show');
                AIZ.plugins.bootstrapSelect('refresh');
                var country = $("#edit_country").val();
                get_city(country);
            }
        });
    }
    
    $(document).on('change', '[name=country]', function() {
        var country = $(this).val();
        get_city(country);
    });

    function get_city(country) {
        $('[name="city"]').html("");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('get-city')}}",
            type: 'POST',
            data: {
                country_name: country
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != '') {
                    $('[name="city"]').html(obj);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }
</script>
@endsection
