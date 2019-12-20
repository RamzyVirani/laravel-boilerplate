<!-- Key Field -->
<div class="form-group col-sm-6">
    {!! Form::label('key', 'Key:') !!}
    {!! Form::text('key', null, ['class' => 'form-control', 'placeholder'=>'Enter key']) !!}
</div>

<!-- Html Body Field -->
<div class="form-group col-sm-6">
    {!! Form::label('html_body', 'Html Body:') !!}
    {!! Form::text('html_body', null, ['class' => 'form-control', 'placeholder'=>'Enter html_body']) !!}
</div>

<!-- Text Body Field -->
<div class="form-group col-sm-6">
    {!! Form::label('text_body', 'Text Body:') !!}
    {!! Form::text('text_body', null, ['class' => 'form-control', 'placeholder'=>'Enter text_body']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    @if(!isset($emailTemplate))
        {!! Form::submit(__('Save And Add Translations'), ['class' => 'btn btn-primary', 'name'=>'translation']) !!}
    @endif
    {!! Form::submit(__('Save And Add More'), ['class' => 'btn btn-primary', 'name'=>'continue']) !!}
    <a href="{!! route('admin.email-templates.index') !!}" class="btn btn-default">Cancel</a>
</div>