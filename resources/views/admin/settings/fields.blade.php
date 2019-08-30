<div class="nav-tabs-custom col-sm-12">
    <ul class="nav nav-tabs">
        @foreach($locales as $key => $locale)
            <li {{ $key==0?'class=active':'' }}>
                <a href="#tab_{{$key+1}}" data-toggle="tab">
                    {{ ($locale->native_name===null)?$locale->title:$locale->native_name }}
                </a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content">
        @foreach($locales as $key => $locale)
            <div class="tab-pane {{$key==0?'active':''}} clearfix" id="tab_{{$key+1}}">
                @php(App::setLocale($locale->code))
                <div class="box col-sm-12">
                    <div class="box-header with-border">

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <!-- Title Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('title', 'Title:*') !!}
                                {!! Form::text('title['.$locale->code.']', $setting->translate($locale->code)['title'], ['class' => 'form-control', 'autofocus', 'style'=>'direction:'.$locale->direction]) !!}
                            </div>

                            <!-- Street Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('address', 'Street Address:') !!}
                                {!! Form::text('address['.$locale->code.']', $setting->translate($locale->code)['address'], ['class' => 'form-control', 'style'=>'direction:'.$locale->direction]) !!}
                            </div>

                            <!-- About Field -->
                            <div class="form-group col-sm-12">
                                {!! Form::label('about', 'About:') !!}
                                {!! Form::textarea('about['.$locale->code.']', $setting->translate($locale->code)['about'], ['class' => 'form-control', 'style'=>'direction:'.$locale->direction]) !!}
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- box-footer -->
                </div>
            </div>
        @endforeach
    </div>
    <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->
<div class="clearfix"></div>
<div class="box col-sm-12">
    <div class="box-header with-border">

    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <!-- Email Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Phone Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('phone', 'Phone:') !!}
            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Locale Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('locale', 'Default Language:*') !!}
            {!! Form::select('default_language', $locales->pluck('title','code'), null, ['class' => 'form-control']) !!}
        </div>

        <!-- Playstore Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('playstore', 'Play Store Link:') !!}
            {!! Form::text('playstore', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Appstore Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('appstore', 'App Store Link:') !!}
            {!! Form::text('appstore', null, ['class' => 'form-control']) !!}
        </div>

        <!-- App Version Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('app_version', 'App Version:') !!}
            {!! Form::number('app_version', null, ['class' => 'form-control', 'step' => 0.1]) !!}
        </div>

        <div id="product-div">
            @if($setting->social_links)
                @php($socaials = json_decode($setting->social_links))
                @foreach($socaials as $socaial)
                    <div class="">
                        <!-- Products Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('socialName', 'Account Name:') !!}
                            {!! Form::text('socialName[]', array_keys(get_object_vars($socaial))[0], ['class'=>'form-control']) !!}
                        </div>

                        <!-- Quantity Field -->
                        <div class="form-group col-sm-4">
                            {!! Form::label('socialLink', 'Link:') !!}
                            {!! Form::text('socialLink[]', array_values(get_object_vars($socaial))[0], ['class'=>'form-control']) !!}
                        </div>

                        <div class="col-sm-2" style="margin-top: 23px;">
                            <a href="javascript:void(0)" class="btn btn-info add_product_row"><i class="fa fa-plus"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger delete_product_row"><i
                                        class="fa fa-trash"></i></a>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="" id="product-row-sample" style="display: none;">
                <!-- Products Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('socialName', 'Account Name:') !!}
                    {!! Form::text('socialName[]', null, ['class'=>'form-control']) !!}
                </div>

                <!-- Quantity Field -->
                <div class="form-group col-sm-5">
                    {!! Form::label('socialLink', 'Link:') !!}
                    {!! Form::text('socialLink[]', null, ['class'=>'form-control']) !!}
                </div>

                <div class="col-sm-1" style="margin-top: 23px;">
                    <a href="javascript:void(0)" class="btn btn-danger delete_product_row"><i
                                class="fa fa-trash"></i></a>
                </div>
            </div>
        </div>

    {!! Form::hidden('logo', $setting->logo) !!}
    <!-- Logo Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('logo', 'Logo:*') !!}
            {!! Form::file('logo') !!}
        </div>

        <div class="form-group col-sm-3">
            <img src="{!! $setting->image_url !!}" width="90" class="pull-right">
        </div>

        <!-- Force Update Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('force_update', 'Force Update:') !!}
            {!! Form::hidden('force_update', 0) !!}
            {!! Form::checkbox('force_update', 1, true, ['class'=> 'form-control', 'data-toggle'=>'toggle']) !!}
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- box-footer -->
</div>
<div class="clearfix"></div>
<div class="box col-sm-12">
    <div class="box-header with-border">

    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <!-- Coordinates Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('coordinates', __('Coordinates').'*:') !!}
            {!! Form::text('coordinates', null, ['class' => 'form-control','id'=>'us3-address']) !!}
        </div>

        <div class="form-group col-sm-12">
            <div class="form-group col-sm-12" id="us3" style="width: 100%; height: 400px;"></div>
        </div>

        <input type="hidden" name="old_lat" value="{{ empty(old('latitude'))?$setting->latitude:old('latitude') }}"
               id="old-lat">
        <input type="hidden" name="old_long" value="{{ empty(old('longitude'))?$setting->longitude:old('longitude') }}"
               id="old-lon">

        {!! Form::hidden('latitude', $setting->latitude, ['id'=>'us3-lat']) !!}
        {!! Form::hidden('longitude', $setting->longitude, ['id'=>'us3-lon']) !!}

    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- box-footer -->
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.settings.index') !!}" class="btn btn-default">Cancel</a>
</div>
@push('scripts')
	<script type="text/javascript"
		src='https://maps.google.com/maps/api/js?key={{config('constants.google.maps.api_key')}}&sensor=false&libraries=places'></script>
    <script src="{{ url('public/js/admin/locationpicker.jquery.min.js') }}"></script>
    <script>
        $(function () {
            $('body').on('click', 'a.add_product_row', function () {
                var clone = $("#product-row-sample").clone().appendTo("#product-div");
                clone.removeAttr('id');
                clone.removeAttr('style');
                clone.prev().find('a.add_product_row').remove();
            });

            $('body').on('click', 'a.delete_product_row', function () {
                $(this).parent().parent().remove();
            });

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