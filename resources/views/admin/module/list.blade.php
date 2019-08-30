@extends('admin.layouts.app')

@section('title')
    Module Generator
    @ability('super-admin', 'users.create')
    <a class="btn btn-sm" style="margin-bottom: 5px" href="{{ url('admin/module/step1') }}"> <i class="fa fa-plus"></i>
        Add New</a>
    @endability
@endsection

@section('content')
    <!-- Main content -->
    <section id="content_section" class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <!-- Your Page Content Here -->
        <div class="box">
            <div class="box-header">
                <div class="box-tools pull-right" style="position: relative;margin-top: -5px;margin-right: -10px">
                    <form method="get" style="display:inline-block;width: 260px;" action="admin/module_generator">
                        <div class="input-group">
                            <input type="text" name="q" value="" class="form-control input-sm pull-right"
                                   placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <form method="get" id="form-limit-paging" style="display:inline-block"
                          action="admin/module_generator">
                        <div class="input-group">
                            <select class="form-control input-sm" onchange="$('#form-limit-paging').submit()"
                                    name="limit">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option selected="" value="100">100</option>
                                <option value="200">200</option>
                            </select>
                        </div>
                    </form>
                </div>
                <br style="clear:both">
            </div>
            <div class="box-body table-responsive no-padding">
                <form id="form-table" method="post" action="#">
                    <input type="hidden" name="button_name" value="">
                    <input type="hidden" name="_token" id="csrf_token" value="{{ csrf_token() }}">
                    <table id="table_dashboard" class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr class="active">
                            <th width="auto">Name</th>
                            <th width="auto">Table</th>
                            <th width="auto">Slug</th>
                            {{--<th width="auto">Controller</th>--}}
                            {{--<th width="auto" style="text-align:center">Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($modules as $module)
                            <tr>
                                <td>{{ $module->name }}</td>
                                <td>{{ $module->table_name }}</td>
                                <td>{{ $module->slug }}</td>
                                {{--<td>
                                    <div class="button_action" style="text-align:right">
                                        --}}{{--<a class="btn btn-xs btn-primary" title="Module Wizard" onclick=""--}}{{--
                                        --}}{{--href="{{ url('admin/module/step1/'.$module->id) }}">--}}{{--
                                        --}}{{--<i class="fa fa-wrench"></i> Module Wizard</a>&nbsp;--}}{{--
                                        <a class="btn btn-xs btn-success btn-edit" title="Edit Data"
                                           href="{{url('admin/module/step1/'.$module->id) }}"><i
                                                    class="fa fa-pencil"></i>
                                        </a>
                                        --}}{{--<a class="btn btn-xs btn-warning btn-delete" title="Delete" href="javascript:;"
                                           onclick="confirmDeleteModule({{$module->id}}); return false;">
                                            <i class="fa fa-trash"></i>
                                        </a>--}}{{--
                                    </div>
                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </form><!--END FORM TABLE-->
                <div class="col-md-8"></div>
                <div class="col-md-4" style="margin:30px 0;"><span class="pull-right"></span></div>
            </div>
        </div>
    </section><!-- /.content -->
@endsection