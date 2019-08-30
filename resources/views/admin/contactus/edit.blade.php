@extends('admin.layouts.app')

@section('title')
    {{ $contactUs->name }} <small>Contact Us</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($contactUs, ['route' => ['admin.contactus.update', $contactUs->id], 'method' => 'patch']) !!}

                        @include('admin.contactus.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection