<div class="col-md-4">
    <!-- Profile Image -->
    <div class="box box-primary">
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{$user->details->image_url}}"
                 alt="User profile picture">

            <h3 class="profile-username text-center">{{$user->details->full_name}}</h3>

            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <i class="fa fa-envelope"></i>
                    <a href="mailto:{{$user->email}}" class="text-black">
                        {{$user->email}}
                    </a>

                </li>
                <li class="list-group-item">
                    <i class="fa fa-phone"></i>
                    <a href="tel:{{$user->details->phone}}" class="text-black">
                        {{$user->details->phone}}
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- About Me Box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">About Me</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>

            <p class="text-muted">{{$user->details->address}}</p>

            <hr>

        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
<div class="col-md-8">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#about" data-toggle="tab">About</a></li>
            {{--Settings can be used to change password directly, without going in edit mode--}}
            {{--<li><a href="#settings" data-toggle="tab">Settings</a></li>--}}
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="about">
                <dl class="dl-horizontal">
                    <!-- Id Field -->
                    <dt>{!! Form::label('id', 'Id:') !!}</dt>
                    <dd>{!! $user->id !!}</dd>

                    <!-- Email Field -->
                    <dt>{!! Form::label('roles', 'Roles:') !!}</dt>
                    <dd>{!! $user->rolesCsv !!}</dd>

                    <!-- Created At Field -->
                    <dt>{!! Form::label('created_at', 'Created At:') !!}</dt>
                    <dd>{!! $user->created_at !!}</dd>

                    <!-- Updated At Field -->
                    <dt>{!! Form::label('updated_at', 'Updated At:') !!}</dt>
                    <dd>{!! $user->updated_at !!}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>