@extends('admin.layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="content">
        @include('adminlte-templates::common.errors')
        {!! Form::model($role, ['route' => ['admin.roles.update', $role->id], 'method' => 'patch']) !!}
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">

                    @include('admin.roles.fields')

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
                        <th></th>
                        <th>List</th>
                        <th>Create</th>
                        <th>Read</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                    @php ($col = 1)
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <td>{!! Form::checkbox('', false, null, ['class'=> 'checkall','data-check'=>'checkbox_col_'.$col++]) !!}</td>
                        <td>{!! Form::checkbox('', false, null, ['class'=> 'checkall','data-check'=>'checkbox_col_'.$col++]) !!}</td>
                        <td>{!! Form::checkbox('', false, null, ['class'=> 'checkall','data-check'=>'checkbox_col_'.$col++]) !!}</td>
                        <td>{!! Form::checkbox('', false, null, ['class'=> 'checkall','data-check'=>'checkbox_col_'.$col++]) !!}</td>
                        <td>{!! Form::checkbox('', false, null, ['class'=> 'checkall','data-check'=>'checkbox_col_'.$col++]) !!}</td>
                    </tr>
                    </thead>
                    <tbody>
                    @php ($row = 0)
                    {{-- Loop Modules Model to Populate Permission Lists --}}
                    @foreach($modules as $key => $module)
                        @if(array_search(true, $modulePermissions[$key]) !== false)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $module->name }}</td>
                                @php ($col = 1)
                                @if($module->is_module !== 0)
                                    <td>
                                        {!! Form::checkbox("", false, null, ['class'=>'checkall','data-check'=>'checkbox_row_'.++$row]) !!}
                                    </td>
                                @endif
                                @foreach($permissions[$key] as $id => $permission)
                                    @php ($checked = $role->hasPermission($permission['name']) ? true : false)
                                    <td {{ ($module->is_module == 0)?' colspan=6':'' }} class="bg-default text-center">
                                        @if(\Auth::user()->can($permission['name']))
                                            {!! Form::checkbox('permissions['.$permission["id"].']', 1, $checked, ($module->is_module == 0)?[]:['class'=>'checkbox_row_'.$row. ' checkbox_col_'.$col++]) !!}
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endif
                    @endforeach
                    @foreach($otherPermissions as $otherPermission)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $otherPermission->display_name }}</td>
                            @php ($checked = $role->hasPermission($otherPermission->name) ? true : false)
                            <td colspan="6" class="bg-default text-center">
                                {!! Form::checkbox('permissions['.$otherPermission->id.']', 1, $checked, ($module->is_module == 0)?[]:['class'=>'checkbox_row_'.$row. ' checkbox_col_'.$col++]) !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">

            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{!! route('admin.roles.index') !!}" class="btn btn-default">Cancel</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection