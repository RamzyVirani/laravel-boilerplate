@extends('admin.layouts.app')
@section('title')
    User: {{ $user->details->full_name }}
    <div class="btn-group">
        {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'delete']) !!}

        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            Actions
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>

        <ul class="dropdown-menu" role="menu">
            @ability('super-admin' ,'users.edit')
            <li>
                <a href="{{ route('admin.users.edit', $user->id) }}">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>
            </li>
            @endability
            @ability('super-admin' ,'users.destroy')
            <li class="divider"></li>
            <li>
                <a class="bg-red" href="#_" onclick="confirmDelete($(this).parents('form')[0]); return false;">
                    <i class="glyphicon glyphicon-trash"></i> Delete
                </a>
            </li>
            @endability
        </ul>
        {!! Form::close() !!}
    </div>
@endsection
@section('content')
    <div class="content">
        <div class="row">
            @include('admin.users.show_fields')
        </div>
    </div>
@endsection