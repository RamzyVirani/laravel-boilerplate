@extends('admin.layouts.app')

@section('title')
    {{ $title }} : {{$role->display_name}}
@endsection

@section('content')
    <section class="content">
        <div class="content">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row" style="padding-left: 20px">
                        <dl class="dl-horizontal">
                            @include('admin.roles.show_fields')
                        </dl>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Permissions </h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered text-center">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">Module</th>
                            <th>List</th>
                            <th>Create</th>
                            <th>Read</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--Loop Modules Model to Populate Permission Lists--}}
                        @foreach($modules as $key => $module)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $module->name }}</td>
                                @foreach($permissions[$key] as $permission)
                                    @php ($class = $role->hasPermission($permission['name']) ? "green" : "red")
                                    <td {{ ($module->is_module == 0)?' colspan=5 class=bg-'.$class:'class="bg-default text-center"'}}>
                                        <span class="label bg-{{$class}}">{{ $role->hasPermission($permission['name']) ? "Yes" : "No" }}</span>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        @foreach($otherPermissions as $otherPermission)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $otherPermission->display_name }}</td>
                                @php ($class = $role->hasPermission($otherPermission->name) ? "green" : "red")
                                <td {{ 'colspan=5 class=bg-'.$class }}>
                                    <span class="label bg-{{$class}}">{{ $role->hasPermission($otherPermission->name) ? "Yes" : "No" }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {!! Form::open(['route' => ['admin.roles.destroy', $role->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('admin.roles.index') !!}" class="btn btn-default">
                            <i class="glyphicon glyphicon-arrow-left"></i> Back
                        </a>

                        <a href="{{ route('admin.roles.edit', $role->id) }}" class='btn btn-default'>
                            <i class="glyphicon glyphicon-edit"></i> Edit
                        </a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Delete', [
                            'type' => 'submit',
                            'class' => 'btn btn-danger',
                            'onclick' => "confirmDelete($(this).parents('form')[0]); return false;"
                        ]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
