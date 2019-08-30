@push('css')
    <style>
        .table-form tbody tr td {
            position: relative;
        }

        .sub {
            position: absolute;
            top: inherit;
            left: inherit;
            padding: 0 0 0 0;
            list-style-type: none;
            height: 180px;
            overflow: auto;
            z-index: 1;
        }

        .sub li {
            padding: 5px;
            background: #eae9e8;
            cursor: pointer;
            display: block;
            width: 180px;
        }

        .sub li:hover {
            background: #ECF0F5;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('public/js/admin/module/step3.js') }}"></script>
    <script type="text/javascript">
        var columns = {!! json_encode($tableFields) !!};
        var validation_rules = {
            'Accepted': 'accepted',
            'Active URL': 'active_url',
            'After (Date)': 'after_or_equal:date',
            'Alpha': 'alpha',
            'Alpha Dash': 'alpha_dash',
            'Alpha Numeric': 'alpha_num',
            'Array': 'array',
            'Bail': 'bail',
            'Before Or Equal (Date)': 'before_or_equal:date',
            'Between': 'between:min,max',
            'Boolean': '0_or_1',
            'Confirmed': 'confirmed',
            'Date': 'date',
            'Date Equals': 'date_equals:date',
            'Date Format': 'date_format:format',
            'Different': 'different:field',
            'Digits': 'digits:value',
            'Digits Between': 'digits_between:min,max',
            'Dimensions (Image Files)': 'dimensions:min_width=100,min_height=200_or_dimensions:ratio=3/2',
            'Distinct': 'distinct',
            'E-Mail': 'email',
            'Exists': 'exists:table,column',
            'File': 'file',
            'Filled': 'filled',
            'Image (File)': 'image',
            'In': 'in:foo,bar,....',
            'In Array': 'in_array:anotherfield',
            'Integer': 'integer',
            'IP Address': 'ip_or_ipv4_or_ipv6',
            'JSON': 'json',
            'Max': 'max:value',
            'MIME Types': 'mimetypes:text/plain,...',
            'Size': 'size:value',
            'Same': 'same:field',
            'String': 'string',
            'MIME Type By File Extension': 'mimes:jpeg,bmp,png,...',
            'Min': 'min:value',
            'Nullable': 'nullable',
            'Numeric': 'numeric',
            'Not In': 'not_in:foo,bar,...',
            'Not Regex': 'not_regex:pattern',
            'Present': 'present',
            'Regular Expression': 'regex:pattern',
            'Required': 'required',
            'Required If': 'required_if:anotherfield,value,...',
            'Required Unless': 'required_unless:anotherfield,value,...',
            'Required With': 'required_with:foo,bar,...',
            'Required With All': 'required_with_all:foo,bar,...',
            'Required Without': 'required_without:foo,bar,...',
            'Required Without All': 'required_without_all:foo,bar,...',
            'Timezone': 'timezone',
            'Unique (Database)': 'unique:table,column,except,idColumn',
            'URL': 'url'
        };

        /*var validation_rules = [
            'accepted',
            'active_url',
            'after_or_equal:date',
            'alpha',
            'Alpha Dash',
            'Alpha Numeric',
            'Array',
            'Before (Date)',
            'Before Or Equal (Date)',
            'Between',
            'Boolean',
            'Confirmed',
            'Date',
            'Date Equals',
            'Date Format',
            'Different',
            'Digits',
            'Digits Between',
            'Dimensions (Image Files)',
            'E-Mail',
            'exists:table,column',
            'File',
            'Same',
            'Filled',
            'Image (File)',
            'In',
            'In Array',
            'Integer',
            'IP Address',
            'JSON',
            'Max',
            'MIME Types',
            'Size',
            'String',
            'MIME Type By File Extension',
            'Min',
            'Nullable',
            'Numeric',
            'Not In',
            'Present',
            'Regular Expression',
            'Required',
            'Required If',
            'Required Unless',
            'Required With',
            'Required With All',
            'Required Without',
            'Required Without All',
            'Timezone',
            'Unique (Database)',
            'URL'
        ];*/

        var types = ['text', 'hidden', 'number', 'password', 'email', 'textarea', 'file', 'date', 'time', 'button', 'checkbox', 'color', 'datetime-local', 'month', 'radio', 'range', 'reset', 'search', 'submit', 'tel', 'toggle-switch', 'select', 'url', 'week'];

        function ucwords(str) {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                return $1.toUpperCase();
            });
        }

        function showTypeSuggest(t) {
            t = $(t);

            t.next("ul").remove();
            var list = '';
            $.each(types, function (i, obj) {
                list += "<li>" + ucwords(obj) + "</li>";
            });

            t.after("<ul class='sub'>" + list + "</ul>");
        }

        function showTypeSuggestLike(t) {
            t = $(t);

            var v = t.val();
            t.next("ul").remove();
            if (!v) return false;

            var list = '';
            $.each(types, function (i, obj) {
                if (obj.includes(v.toLowerCase())) {
                    list += "<li>" + ucwords(obj) + "</li>";
                }
            });

            t.after("<ul class='sub'>" + list + "</ul>");
        }

        function showNameSuggest(t) {
            t = $(t);

            t.next("ul").remove();
            var list = '';
            $.each(columns, function (i, obj) {
                list += "<li>" + i + "</li>";
            });

            t.after("<ul class='sub'>" + list + "</ul>");
        }

        function showNameSuggestLike(t) {
            t = $(t);

            var v = t.val();
            t.next("ul").remove();
            if (!v) return false;

            var list = '';
            $.each(columns, function (i, obj) {
                if (i.includes(v.toLowerCase())) {
                    list += "<li>" + i + "</li>";
                }
            });

            t.after("<ul class='sub'>" + list + "</ul>");
        }

        function showColumnSuggest(t) {
            console.log(t);
            t = $(t);
            t.next("ul").remove();

            var list = '';
            $.each(columns, function (i, obj) {
                obj = i.replace('id_', '');
                obj = ucwords(obj.replace('_', ' '));
                list += "<li>" + obj + "</li>";
            });

            t.after("<ul class='sub'>" + list + "</ul>");
        }

        function showColumnSuggestLike(t) {
            t = $(t);
            var v = t.val();

            t.next("ul").remove();
            if (!v) return false;

            var list = '';
            $.each(columns, function (i, obj) {
                if (i.includes(v.toLowerCase())) {
                    obj = i.replace('id_', '');
                    obj = ucwords(obj.replace('_', ' '));

                    list += "<li>" + obj + "</li>";
                }
            });

            t.after("<ul class='sub'>" + list + "</ul>");
        }

        function showValidationSuggest(t) {
            t = $(t);
            t.next("ul").remove();

            var list = '';
            $.each(validation_rules, function (i, obj) {
                console.log(obj);
                list += "<li value='" + obj + "'>" + i + "</li>";
            });

            t.after("<ul class='sub'>" + list + "</ul>");
        }

        function showValidationSuggestLike(t) {
            t = $(t);
            var v = t.val();

            t.next("ul").remove();
            if (!v) return false;

            var list = '';
            $.each(validation_rules, function (i, obj) {
                if (obj.includes(v.toLowerCase())) {
                    list += "<li>" + obj + "</li>";
                }
            });

            t.after("<ul class='sub'>" + list + "</ul>");
        }
    </script>
@endpush
@php($types = ['text'=>'text', 'hidden'=>'hidden', 'number'=>'number', 'password'=>'password', 'email'=>'email', 'textarea'=>'textarea',
'file'=>'file', 'date'=>'date', 'time'=>'time', 'button'=>'button', 'checkbox'=>'checkbox', 'color'=>'color', 'datetime-local'=>'datetime-local', 'month'=>'month', 'radio'=>'radio', 'range'=>'range', 'reset'=>'reset', 'search'=>'search', 'submit'=>'submit', 'tel'=>'tel', 'url'=>'url', 'select'=>'select'])
@php($validation_rules = [
            'Accepted', 'Active URL', 'After (Date)', 'After Or Equal (Date)', 'Alpha', 'Alpha Dash', 'Alpha Numeric', 'Array', 'Before (Date)', 'Before Or Equal (Date)',
            'Between', 'Boolean', 'Confirmed', 'Date', 'Date Equals', 'Date Format', 'Different', 'Digits', 'Digits Between', 'Dimensions (Image Files)', 'E-Mail',
            'Exists (Database)', 'File', 'Filled', 'Image (File)', 'In', 'In Array', 'Integer', 'IP Address', 'JSON', 'Max', 'MIME Types', 'MIME Type By File Extension',
            'Min', 'Nullable', 'Numeric', 'Not In', 'Present', 'Regular Expression', 'Required', 'Required If', 'Required Unless', 'Required With', 'Required With All',
            'Required Without', 'Required Without All', 'Same', 'Size', 'String', 'Timezone', 'Unique (Database)', 'URL'])
<div class="" id="">
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                *{{ $error }} <br>
            @endforeach
        </div>
    @endif
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <!-- /.box-header -->
    {{ Form::open(array('url' => 'admin/step3')) }}
    <input type="hidden" name="id" value="{{ $id }}">
    <table class="table-form table table-striped">
        <thead>
        <tr>
            <th>Label</th>
            <th>Name</th>
            <th>Type</th>
            <th>Validation</th>
            <th width="90px">Width</th>
            <th width="180px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($module_data as $field)
            <tr>
                <td>
                    {{ Form::text('label[]', $value = ucwords($field->name),
                        $attributes = [
                            'class'=>'labels form-control',
                            'onclick'=>'showColumnSuggest(this)',
                            'onkeyup'=>'showColumnSuggestLike(this)',
                            'placeholder' => 'Input Field Label',
                            'required'
                        ]) }}
                </td>
                <td>
                    {{ Form::text('name[]', $value = $field->name,
                        $attributes = [
                            'class'=>'name form-control',
                            'onclick'=>'showNameSuggest(this)',
                            'onkeyup'=>'showNameSuggestLike(this)',
                            'placeholder' => 'Input Field Name',
                            'required'
                        ]) }}
                </td>
                <td>
                    {{--{{ Form::text('type[]', $value = 'text',
                        $attributes = [
                            'class'=>'type form-control',
                            'onclick'=>'showTypeSuggest(this)',
                            'onkeyup'=>'showTypeSuggestLike(this)',
                            'placeholder' => 'Input Field Type',
                            'required'
                        ]) }}--}}
                    {{ Form::select('type[]', $types, '0', ['class'=>'form-control select2', 'required']) }}
                </td>

                <td>
                    {{ Form::text('validation[]', $value = 'required',
                        $attributes = [
                            'class'=>'validation form-control',
                            'onclick'=>'showValidationSuggest(this)',
                            'onkeyup'=>'showValidationSuggestLike(this)',
                            'placeholder' => 'Input Field Validation'
                            ]) }}
                    {{--{{ Form::select('validation[]', $validation_rules, '1', ['class'=>'form-control select2', 'required']) }}--}}
                </td>
                <td>
                    {{ Form::select('width[]', [
                        'col-sm-12' => '12', 'col-sm-11' => '11', 'col-sm-10' => '10',
                        'col-sm-9' => '9', 'col-sm-8' => '8', 'col-sm-7' => '7',
                        'col-sm-6' => '6', 'col-sm-5' => '5', 'col-sm-4' => '4',
                        'col-sm-3' => '3', 'col-sm-2' => '2', 'col-sm-1' => '1',
                        ], 'col-sm-6', ['class'=>'form-control width', 'required']) }}
                </td>
                <td>
                    <a href="javascript:void(0)" class="btn btn-info btn-plus"><i class="fa fa-plus"></i></a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></a>
                    <a href="javascript:void(0)" class="btn btn-success btn-up"><i class="fa fa-arrow-up"></i></a>
                    <a href="javascript:void(0)" class="btn btn-success btn-down"><i class="fa fa-arrow-down"></i></a>
                </td>
            </tr>
        @endforeach
        <tr id="tr-sample" style="display: none">
            <td>
                {{ Form::text('label[]', $value = null,
                    $attributes = [
                        'class'=>'labels form-control',
                        'onclick'=>'showColumnSuggest(this)',
                        'onkeyup'=>'showColumnSuggestLike(this)',
                        'placeholder' => 'Input Field Label',
                        'required'
                    ]) }}
            </td>
            <td>
                {{ Form::text('name[]', $value = null,
                    $attributes = [
                        'class'=>'name form-control',
                        'onclick'=>'showNameSuggest(this)',
                        'onkeyup'=>'showNameSuggestLike(this)',
                        'placeholder' => 'Input Field Name',
                        'required'
                    ]) }}
            </td>
            <td>
                {{ Form::select('type[]', $types, '0', ['class'=>'form-control select2', 'required']) }}
            </td>
            <td>
                {{ Form::text('validation[]', $value = 'required',
                    $attributes = [
                        'class'=>'validation form-control',
                        'onclick'=>'showValidationSuggest(this)',
                        'onkeyup'=>'showValidationSuggestLike(this)',
                        'placeholder' => 'Input Field Validation'
                    ]) }}
            </td>
            <td>
                {{ Form::select('width[]', [
                    'col-sm-12' => '12', 'col-sm-11' => '11', 'col-sm-10' => '10',
                    'col-sm-9' => '9', 'col-sm-8' => '8', 'col-sm-7' => '7',
                    'col-sm-6' => '6', 'col-sm-5' => '5', 'col-sm-4' => '4',
                    'col-sm-3' => '3', 'col-sm-2' => '2', 'col-sm-1' => '1',
                    ], 'col-sm-6', ['class'=>'form-control width', 'required']) }}
            </td>
            <td>
                <a href="javascript:void(0)" class="btn btn-info btn-plus"><i class="fa fa-plus"></i></a>
                <a href="javascript:void(0)" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></a>
                <a href="javascript:void(0)" class="btn btn-success btn-up"><i class="fa fa-arrow-up"></i></a>
                <a href="javascript:void(0)" class="btn btn-success btn-down"><i class="fa fa-arrow-down"></i></a>
            </td>
        </tr>
        </tbody>
    </table>

    <!-- Status Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('status', 'Make Migration:') !!}
        {!! Form::hidden('make_migration', 0) !!} <br>
        {!! Form::checkbox('make_migration', 1, true, ['class'=> 'form-control', 'data-toggle'=>'toggle']) !!}
    </div>

    <div class="box-footer">
        @php($back=url('admin/module/step2/'.$id))
        {{ Form::button('Back',['class'=>'btn', 'onclick'=>"window.location='".$back."'"]) }}
        {{ Form::submit('Complete',['class'=>'btn btn-primary delete-sample']) }}
    </div>
    {{ Form::close() }}
</div>