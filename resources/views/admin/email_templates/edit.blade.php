@extends('admin.layouts.app')

@section('title')
    {{ $emailTemplate->name }} <small>{{ $title }}</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($emailTemplate, ['route' => ['admin.email-templates.update', $emailTemplate->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.email_templates.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection