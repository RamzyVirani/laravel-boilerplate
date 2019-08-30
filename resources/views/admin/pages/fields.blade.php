<div class="box">
    <div class="box-body">
<!-- Slug Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slug', 'Slug:*') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder'=>'Unique Slug', 'required']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::hidden('status', 0, false) !!} <br>
    {!! Form::checkbox('status', 1, true, ['class'=> 'form-control', 'data-toggle'=>'toggle']) !!}
</div>
    </div>
    <!-- /.box-body -->
</div>
@if(isset($page))
	<div class="box">
        <div class="box-header with-border">
            Translated Attributes
        </div>
        <!-- /.box-header -->
    <div class="box-body">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                @foreach($locales as $key=>$locale)
                    <li {{ $key==0? "class=active":"" }}>
                        <a href="#tab_{{$key+1}}"
                           data-toggle="tab">{{ ($locale->native_name===null)?$locale->title:$locale->native_name }}</a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach($locales as $key=>$locale)
                    <div class="tab-pane {{$key==0?'active':''}} clearfix" id="tab_{{$key+1}}">
                        @php(App::setLocale($locale->code))
						<!-- Title Field -->
                        <div class="form-group">
                            {!! Form::label('title', __('Title').':') !!}
                            {!! Form::text('title['.$locale->code.']', $page->translate($locale->code)['title'], ['class' => 'form-control', 'autofocus', 'style'=>'direction:'.$locale->direction]) !!}
                        </div>

                        <!-- Content Field -->
                        <div class="form-group">
                            {!! Form::label('content', __('Content').':') !!}
                            {!! Form::textarea('content['.$locale->code.']', $page->translate($locale->code)['content'], ['class' => 'form-control', 'style'=>'direction:'.$locale->direction]) !!}
                        </div>

                        <!-- Status Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('status', __('Status').':') !!}
							{!! Form::hidden('translation_status['.$locale->code.']', 0) !!}
                            {!! Form::checkbox('translation_status['.$locale->code.']', 1, $page->translate($locale->code)['status'], ['class'=> 'form-control', 'data-toggle'=>'toggle']) !!}
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /.tab-content -->
        </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- box-footer -->
    </div>
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::submit(__('Save And Add Translations'), ['class' => 'btn btn-primary', 'name'=>'translation']) !!}
    {!! Form::submit(__('Save And Add More'), ['class' => 'btn btn-primary', 'name'=>'continue']) !!}
    <a href="{!! route('admin.pages.index') !!}" class="btn btn-default">{{ __('Cancel') }}</a>
</div>
