@extends('admin.layouts.app')

@section('title')
    Page
@endsection

@section('content')
    <div class="content">
                {{--<div class="box box-default">--}}
            <div class="row" style="padding-left: 20px">
                <dl class="dl-horizontal">
                    @include('admin.pages.show_fields')
                </dl>
                <div class='btn-group'>
                    @ability('super-admin' ,'pages.show')
                    <a href="{!! route('admin.pages.index') !!}" class="btn btn-default">
                        <i class="glyphicon glyphicon-arrow-left"></i> Back
                    </a>
                    @endability
</div>
            <div class='btn-group'>
                    @ability('super-admin' ,'pages.edit')
                    <a href="{{ route('admin.pages.edit', $page->id) }}" class='btn btn-default'>
                        <i class="glyphicon glyphicon-edit"></i> Edit
                    </a>
                    @endability
</div>
            <div class='btn-group'>
					{!! Form::open(['route' => ['admin.pages.destroy', $page->id], 'method' => 'delete']) !!}
                    @ability('super-admin' ,'pages.destroy')
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', [
                        'type' => 'submit',
                        'class' => 'btn btn-danger',
                        'onclick' => "confirmDelete($(this).parents('form')[0]); return false;"
                    ]) !!}
                    @endability
					{!! Form::close() !!}
                </div>                
            </div>
        </div>
    {{--</div>--}}
    </div>
@endsection