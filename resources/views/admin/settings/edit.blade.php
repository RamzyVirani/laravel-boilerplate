@extends('admin.layouts.app')

@section('title')
    {{ $setting->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       {{--<div class="box box-primary">--}}
           {{--<div class="box-body">--}}
               <div class="row">
                   {!! Form::model($setting, ['route' => ['admin.settings.update', $setting->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.settings.fields')

                   {!! Form::close() !!}
               </div>
           {{--</div>--}}
       {{--</div>--}}
   </div>
@endsection