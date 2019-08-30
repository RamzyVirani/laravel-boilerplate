@push('css')
    <style>
        .table-display tbody tr td {
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

        .btn-drag {
            cursor: move;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('public/js/admin/module/step2.js') }}"></script>
    <script>
        var columns = {!! json_encode($columns) !!};

        function ucwords(str) {
            return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                return $1.toUpperCase();
            });
        }

        function showNameSuggest(t) {
            t = $(t);

            t.next("ul").remove();
            var list = '';
            $.each(columns, function (i, obj) {
                list += "<li>" + obj + "</li>";
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
                if (obj.includes(v.toLowerCase())) {
                    list += "<li>" + obj + "</li>";
                }
            });

            t.after("<ul class='sub'>" + list + "</ul>");
        }

        function showTableField(t) {
            t = $(t);
            var table = t.parent().parent().find('.join_table option:selected').text();
            var v = t.val();

            if ((!table) || (table == 'Input Field Name')) return false;

            t.after("<ul class='sub'><li><i class='fa fa-spin fa-spinner'></i> Loading...</li></ul>");
            $.get("{{ url('/admin/getJoinFields/')}}/" + table, function (response) {
                t.next("ul").remove();
                var list = '';
                $.each(response, function (i, obj) {
                    list += "<li>" + obj + "</li>";
                });
                t.after("<ul class='sub'>" + list + "</ul>");
            });
        }
    </script>
@endpush
<div class="tab-pane active" id="">
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                *{{ $error }} <br>
            @endforeach
        </div>
    @endif

    {{ Form::open(array('url' => 'admin/step2')) }}

    <input type="hidden" name="id" value="{{ $id }}">

    <table class="table-display table table-striped">
        <thead>
        <tr>
            {{--<th>Title</th>--}}
            <th>Name</th>
            <th width="90px">Type</th>
            {{--<th>Join (Optional)</th>--}}
            {{--<th></th>--}}
            <th width="90px">Width (px)</th>
            <th width="180px">Action</th>
        </tr>
        </thead>
        <tbody>
        @if($module_data != null)
            @foreach($module_data as $key=>$field)
                @if($field->inIndex)
                    <tr>
                        {{--@if(isset(old('name')[$key]))
                        @if(old('name')[$key] != null)
                        <td><input value="{{ old('name')[$key] }}" type="text" name="name[]"
                        onclick="showNameSuggest(this)" onkeyup="showNameSuggestLike(this)"
                        placeholder="Field Name" class="name form-control notfocus">
                        </td>
                        @else
                        @continue
                        @endif
                        @else

                        @endif--}}
                        <td>
                            {{ Form::text('name[]', $value = $field->name, $attributes = ['class'=>'name form-control notfocus', 'onclick'=>'showNameSuggest(this)', 'onkeyup'=>'showNameSuggestLike(this)', 'required']) }}
                        </td>
                        {{--<td><input value="{{ $field->Field }}" type="text" name="title[]" onclick="showColumnSuggest(this)"
                        onkeyup="showColumnSuggestLike(this)" placeholder="Column Name"
                        class="column form-control notfocus">
                        </td>--}}
                        <td>
                            {{ Form::select('type[]', [
                                'text' => 'Text',
                                'bool' => 'Bool',
                                'download' => 'Downloadable',
                                'email' => 'Email',
                                'tel' => 'Tel',
                                'secrate' => 'Secrate',
                                'img' => 'Image',
                                'link' => 'Link',
                                'small' => 'Small Text',
                                'medium' => 'Medium Text',
                                'large' => 'Large Text'
                                ], 'text', ['class'=>'form-control type select2', 'required']) }}
                        </td>
                        <td>
                            {{ Form::number('width[]', $value = '10', $attributes = ['class'=>'form-control', 'required']) }}
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-info btn-plus"><i class="fa fa-plus"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-delete"><i
                                        class="fa fa-trash"></i></a>
                            <a href="javascript:void(0)" class="btn btn-success btn-up"><i
                                        class="fa fa-arrow-up"></i></a>
                            <a href="javascript:void(0)" class="btn btn-success btn-down"><i
                                        class="fa fa-arrow-down"></i></a>
                        </td>
                    </tr>
                @endif
            @endforeach
        @else
            @foreach($tableFields as $key=>$field)
                <tr>
                    {{--@if(isset(old('name')[$key]))
                    @if(old('name')[$key] != null)
                    <td><input value="{{ old('name')[$key] }}" type="text" name="name[]"
                    onclick="showNameSuggest(this)" onkeyup="showNameSuggestLike(this)"
                    placeholder="Field Name" class="name form-control notfocus">
                    </td>
                    @else
                    @continue
                    @endif
                    @else

                    @endif--}}
                    <td>
                        {{ Form::text('name[]', $value = $field->getName(), $attributes = ['class'=>'name form-control notfocus', 'onclick'=>'showNameSuggest(this)', 'onkeyup'=>'showNameSuggestLike(this)', 'required']) }}
                    </td>
                    {{--<td><input value="{{ $field->getName() }}" type="text" name="title[]" onclick="showColumnSuggest(this)"
                    onkeyup="showColumnSuggestLike(this)" placeholder="Column Name"
                    class="column form-control notfocus">
                    </td>--}}
                    <td>
                        {{ Form::select('type[]', [
                            'text' => 'Text',
                            'bool' => 'Bool',
                            'download' => 'Downloadable',
                            'email' => 'Email',
                            'tel' => 'Tel',
                            'secrate' => 'Secrate',
                            'img' => 'Image',
                            'link' => 'Link',
                            'small' => 'Small Text',
                            'medium' => 'Medium Text',
                            'large' => 'Large Text'
                            ], 'text', ['class'=>'form-control type select2', 'required']) }}
                    </td>
                    {{--<td>--}}
                    {{--{{ Form::select('join_table[]', $tables, '', ['class'=>'form-control join_table select2', 'placeholder'=> 'Input Field Name']) }}--}}
                    {{--</td>--}}
                    {{--<td>--}}
                    {{--<input value='' type='text' name='join_field[]' onclick='showTableField(this)'--}}
                    {{--onKeyUp='showTableFieldLike(this)' placeholder='Field Name Shown'--}}
                    {{--class='join_field form-control notfocus' value=''/>--}}
                    {{--</td>--}}
                    {{--<td>
                        {{ Form::select('join_table[]', $tables, '', ['class'=>'form-control join_table select2', 'required', 'placeholder'=> 'Input Field Name']) }}
                    </td>
                    <td>
                        {{ Form::select('join_fields[]', $tables, '', ['class'=>'form-control join_fields select2', 'required', 'placeholder'=> 'Input Field Name']) }}
                    </td>--}}
                    <td>
                        {{ Form::number('width[]', $value = '10', $attributes = ['class'=>'form-control', 'required']) }}
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-info btn-plus"><i class="fa fa-plus"></i></a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></a>
                        <a href="javascript:void(0)" class="btn btn-success btn-up"><i class="fa fa-arrow-up"></i></a>
                        <a href="javascript:void(0)" class="btn btn-success btn-down"><i
                                    class="fa fa-arrow-down"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif
        <tr id="tr-sample" style="display:none">
            {{--<td><input type="text" name="title[]" onclick="showColumnSuggest(this)"
                       onkeyup="showColumnSuggestLike(this)" placeholder="Column Name"
                       class="column form-control notfocus" value=""></td>--}}
            <td>
                {{ Form::text('name[]',
                    $value = null,
                    $attributes = [
                        'class'=> 'name form-control notfocus',
                        'onclick'=> 'showNameSuggest(this)',
                        'onkeyup'=> 'showNameSuggestLike(this)',
                        'placeholder'=> 'Input Field Name',
                        'required']
                    )
                }}
            </td>
            <td>
                {{ Form::select('type[]', [
                    'text' => 'Text',
                    'bool' => 'Bool',
                    'download' => 'Downloadable',
                    'email' => 'Email',
                    'tel' => 'Tel',
                    'secrate' => 'Secrate',
                    'img' => 'Image',
                    'link' => 'Link',
                    'small' => 'Small Text',
                    'medium' => 'Medium Text',
                    'large' => 'Large Text'
                    ], 'text', ['class'=>'form-control type select2', 'required']) }}
            </td>
            <td>
                {{ Form::number('width[]', $value = '0', $attributes = ['class'=>'form-control', 'required']) }}
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
    <div class="box-footer">
        @php($back=url('admin/module/step1/'.$id))
        {{ Form::button('Back',['class'=>'btn', 'onclick'=>"window.location='".$back."'"]) }}
        {{ Form::submit('Next Step 3',['class'=>'btn btn-primary delete-sample']) }}
    </div>
    {{ Form::close() }}
</div>