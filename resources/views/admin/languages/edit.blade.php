@extends('admin.layouts.app')

@section('title')
    {{ $language->name }} <small>Language</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($language, ['route' => ['admin.languages.update', $language->code], 'method' => 'patch']) !!}

                        @include('admin.languages.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection