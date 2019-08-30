<div class="nav-tabs-custom col-sm-12">
    <ul class="nav nav-tabs">
        @foreach($setting->translations as $key => $translation)
            <li {{ $key == 0?'class=active':'' }}>
                <a href="#tab_{{$key+1}}" data-toggle="tab">
                    {{ $translation->language->native_name }}
                </a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content">
        @foreach($setting->translations as $key => $translation)
            <div class="tab-pane {{$key==0?'active':''}}" id="tab_{{$key+1}}">
                @php(App::setLocale($translation->locale))
                <div class="box">
                    <div class="box-header with-border">

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-6">
                            <!-- Title Field -->
                            <dt>{!! Form::label('title', 'Title:') !!}</dt>
                            <dd>{!! $setting->title !!}</dd>
                        </div>
                        <div class="col-md-6">
                            <!-- Street Field -->
                            <dt>{!! Form::label('street', 'Street Address:') !!}</dt>
                            <dd>{!! $setting->address !!}</dd>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <!-- About Field -->
                        <dt>{!! Form::label('about', 'About:') !!}</dt>
                        <dd>{!! $setting->about !!}</dd>
                    </div>
                    <!-- box-footer -->
                </div>
                <!-- /.box -->
            </div>
        @endforeach
    </div>
    <!-- /.tab-content -->
</div>
<div class="clearfix"></div>
<div class="box">
    <div class="box-header with-border">

    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <!-- /.box -->
        <div class="col-sm-6">

            <!-- Email Field -->
            <dt>{!! Form::label('email', 'Email:') !!}</dt>
            <dd>{!! $setting->email !!}</dd>

            <!-- Logo Field -->
            <dt>{!! Form::label('logo', 'Logo:') !!}</dt>
            <dd><img src="{!! $setting->image_url !!}"></dd>

            <!-- Playstore Field -->
            <dt>{!! Form::label('playstore', 'Play Store:') !!}</dt>
            <dd>{!! !empty($setting->playstore)? "<a href='".$setting->playstore."' target='_blank'>Play Store</a>" : "#" !!}</dd>

            <!-- Force Update Field -->
            <dt>{!! Form::label('force_update', 'Force Update:') !!}</dt>
            <dd>{!! $setting->force_update==1?'<span class="label label-primary">True</span>':'<span class="label label-warning">False</span>' !!}</dd>

            <!-- Created At Field -->
            <dt>{!! Form::label('created_at', 'Created At:') !!}</dt>
            <dd>{!! $setting->created_at !!}</dd>
        </div>
        <div class="col-sm-6">
            <!-- Locale Field -->
            <dt>{!! Form::label('locale', 'App Default Language:') !!}</dt>
            <dd>{!! $setting->default_language !!}</dd>

            <!-- Phone Field -->
            <dt>{!! Form::label('phone', 'Phone:') !!}</dt>
            <dd>{!! $setting->phone !!}</dd>

            <!-- App Version Field -->
            <dt>{!! Form::label('app_version', 'App Version:') !!}</dt>
            <dd>{!! $setting->app_version !!}</dd>

            <!-- Appstore Field -->
            <dt>{!! Form::label('appstore', 'App Store:') !!}</dt>
            <dd>{!! !empty($setting->appstore)? "<a href='".$setting->appstore."' target='_blank'>App Store</a>" : "#" !!}</dd>
        @if($setting->social_links)
            @php($socaials = json_decode($setting->social_links))
            <!-- Social Links Field -->
                <dt>{!! Form::label('social_links', 'Social Links:') !!}</dt>
                <dd>@foreach($socaials as $socaial)
                        <li>
                            <a href="{{ array_values(get_object_vars($socaial))[0] }}"
                               target="_blank">{{ array_keys(get_object_vars($socaial))[0] }}</a>
                        </li>
                    @endforeach
                </dd>
            @endif
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- box-footer -->
</div>
<div class="clearfix"></div>
<div class="box">
    <div class="box-header with-border">

    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="form-group col-sm-12" id="us3" style="width: 100%; height: 400px;"></div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- box-footer -->
</div>

{!! Form::hidden('latitude', $setting->latitude,['id'=>'old-lat']) !!}
{!! Form::hidden('longitude', $setting->longitude,['id'=>'old-lon']) !!}

@push('scripts')
	<script type="text/javascript"
		src='https://maps.google.com/maps/api/js?key={{config('constants.google.maps.api_key')}}&sensor=false&libraries=places'></script>
    <script src="{{ url('public/js/admin/locationpicker.jquery.min.js') }}"></script>
    <script>
        $(function () {
            var old_lat = $('#old-lat').val() != 0 ? $('#old-lat').val() : 25.110026;
            var old_lon = $('#old-lon').val() != 0 ? $('#old-lon').val() : 55.145516;

            $('#us3').locationpicker({
                location: {
                    latitude: old_lat,
                    longitude: old_lon
                },
                radius: 0,
                inputBinding: {
                    latitudeInput: $('#us3-lat'),
                    longitudeInput: $('#us3-lon'),
                    radiusInput: $('#us3-radius'),
                    locationNameInput: $('#us3-address')
                },
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                    // Uncomment line below to show alert on each Location Changed event
                    //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                }
            });

            $('form input#us3-address').on('keyup keypress', function (e) {
                var keyCode = e.keyCode || e.which;
                return keyCode !== 13;
            });
        });
    </script>
@endpush

<div class="clearfix"></div>