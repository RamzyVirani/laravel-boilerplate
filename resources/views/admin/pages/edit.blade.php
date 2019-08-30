@extends('admin.layouts.app')

@section('title')
    {{ $page->name }}
    <small>Page</small>
@endsection

@section('content')
    <div class="content">
        @include('adminlte-templates::common.errors')
        {{--<div class="box box-primary">--}}
            {{--<div class="box-body">--}}
                <div class="row">
                    {!! Form::model($page, ['route' => ['admin.pages.update', $page->id], 'method' => 'patch']) !!}
                    @include('admin.pages.fields')
                    {!! Form::close() !!}
                </div>
            {{--</div>--}}
        {{--</div>--}}
    </div>
@endsection