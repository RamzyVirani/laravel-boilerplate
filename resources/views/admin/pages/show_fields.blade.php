<div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            @foreach($page->translations as $key=>$translation)
                <li {{ $key == 0?'class=active':'' }}>
                    <a href="#tab_{{$key+1}}" data-toggle="tab">
                        {{ $translation->language->native_name }}
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach($page->translations as $key => $translation)
                <div class="tab-pane {{$key==0?'active':''}}" id="tab_{{$key+1}}">
                    <div class="box">
                        <div class="box-header with-border">

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                    <dt>{!! Form::label('title', __('Title').':') !!}</dt>
                    <dd>{!! $translation->title !!}</dd>

                    <!-- Status Field -->
                            <dt>{!! Form::label('status', __('Visible').':') !!}</dt>
                    <dd>{!! ($translation->status==1)?'<span class="label label-success">Yes</span>':'<span class="label label-danger">No</span>' !!}</dd>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <dt>{!! Form::label('content', __('Content').':') !!}</dt>
                            <dd>{!! $translation->content !!}</dd>
                        </div>
                        <!-- box-footer -->
                    </div>
                </div>
            @endforeach
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
</div>
<div class="clearfix"></div>
<div class="col-sm-12">

    <div class="box">
        <div class="box-header with-border">

        </div>
        <!-- /.box-header -->
        <div class="box-body">
                    <!-- Slug Field -->
                    <dt>{!! Form::label('slug', __('Slug').':') !!}</dt>
                    <dd>{!! $page->slug !!}</dd>

                    <!-- Created At Field -->
                    <dt>{!! Form::label('created_at', __('Created At').':') !!}</dt>
                    <dd>{!! $page->created_at !!}</dd>

                    <!-- Updated At Field -->
                    <dt>{!! Form::label('updated_at', __('Updated At').':') !!}</dt>
                    <dd>{!! $page->updated_at !!}</dd>
                </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- box-footer -->
    </div>
</div>
<!-- /.col -->