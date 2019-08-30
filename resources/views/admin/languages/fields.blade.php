<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Native Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('native_name', 'Native Name:') !!}
    {!! Form::text('native_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Direction Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direction', 'Direction:') !!}
    {!! Form::text('direction', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::hidden('status', false) !!}
    {!! Form::checkbox('status', '1', null) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.languages.index') !!}" class="btn btn-default">Cancel</a>
</div>
