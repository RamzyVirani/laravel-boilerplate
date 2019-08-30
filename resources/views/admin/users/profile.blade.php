@extends('admin.layouts.app')

@section('title')
    {{ $user->name }}
    <small>Edit</small>
@endsection

@section('content')
    <div class="content">
        @include('adminlte-templates::common.errors')
        @if($user->hasRole('company-manager'))
            <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Profile</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Company Details</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active clearfix" id="tab_1">
                                {!! Form::model($user->userDetails, ['route' => ['admin.users.profile-update', $user->id], 'method' => 'patch', 'files' => true]) !!}
                                @include('admin.users.show_profile_fields')

                                {!! Form::close() !!}
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane clearfix" id="tab_2">
                                {!! Form::model($company, ['route' => ['admin.companies.update', $company->id], 'method' => 'patch', 'files' => true]) !!}

                                @include('admin.companies.fields')

                                {!! Form::close() !!}
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
            </div>
        @else
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        @php($model = ($user->hasRole('agent'))?$user->userDetails:$user)
                        {!! Form::model($model, ['route' => ['admin.users.profile-update', $user->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('admin.users.show_profile_fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection