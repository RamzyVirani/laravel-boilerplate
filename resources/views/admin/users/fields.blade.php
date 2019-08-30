<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'First Name:') !!}
    {!! Form::text('name', isset($user) ? $user->details->first_name :  null, ['class' => 'form-control']) !!}
</div>

{{--<!-- Name Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('name', 'Last Name:') !!}--}}
{{--{!! Form::text('last_name', $user->details->last_name?? null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', isset($user)?'readonly':'']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', isset($user) ? $user->details->phone : null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', isset($user) ? $user->details->address : null, ['class' => 'form-control']) !!}
</div>

@if (!$profile)
    <!-- Roles Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('roles', 'Roles:') !!}
        {!! Form::select('roles[]', $roles, null, ['class' => 'form-control select2', 'multiple'=>'multiple']) !!}
    </div>

@endif
<div class="clearfix"></div>

<!-- Image Field -->
<div class="form-group col-sm-3">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image', ['class' => 'form-control']) !!}
</div>

@if(isset($user) && $user->details && $user->details->image_url)
    <!-- Image Field -->
    <div class="form-group col-sm-3">
        <img src="{{ $user->details->ImageUrl }}" style="max-width: 100%">
    </div>
@endif

<!-- Email Field -->
<div class="form-group col-sm-3">
    {!! Form::label('email_updates', 'Receive Updates On Emails:') !!}
    <div class="clearfix"></div>
    {!! Form::hidden('email_updates', 0) !!}
    {!! Form::checkbox('email_updates', 1,  true, ['data-toggle'=>'toggle']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-3">
    {!! Form::label('push_notification', 'Receive Push Notification:') !!}
    <div class="clearfix"></div>
    {!! Form::hidden('push_notification', 0) !!}
    {!! Form::checkbox('push_notification', 1,  true, ['data-toggle'=>'toggle']) !!}
</div>
<div class="clearfix"></div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', 'Confirm Password:') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! isset($user)? route('admin.users.show', $user->id) : route('admin.users.index') !!}"
       class="btn btn-default">Cancel</a>
</div>