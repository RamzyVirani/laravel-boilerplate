<!-- Sender Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sender_id', 'Send To:') !!}
    {!! Form::select('send_to[]', $users, isset($notification->users)?$notification->users:null, ['class' => 'form-control select2', 'multiple'=>'multiple']) !!}
</div>

<!-- Action Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('action_type', 'Action Type:') !!}
    {!! Form::select('action_type', ['android'=>'Android', 'IOS'=>'ios', 'both'=>'Both'], null, ['class' => 'form-control']) !!}
</div>

<!-- Ref Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ref_id', 'Ref Id:') !!}
    {!! Form::number('ref_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Message Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('message', 'Message:') !!}
    {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    {!! Form::submit('Save & Sent', ['class' => 'btn btn-primary', 'name'=>'push']) !!}
    <a href="{!! route('admin.notifications.index') !!}" class="btn btn-default">Cancel</a>
</div>
