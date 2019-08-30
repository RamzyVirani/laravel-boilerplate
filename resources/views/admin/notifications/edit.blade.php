@extends('admin.layouts.app')

@section('title')
    {{ $notification->name }} <small>Notification</small>
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($notification, ['route' => ['admin.notifications.update', $notification->id], 'method' => 'patch']) !!}

                        @include('admin.notifications.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection