@extends('admin.layouts.app')

@section('title')
    Permission
@endsection

@section('content')
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($permission, ['route' => ['admin.permissions.update', $permission->id], 'method' => 'patch']) !!}

                        @include('admin.permissions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection