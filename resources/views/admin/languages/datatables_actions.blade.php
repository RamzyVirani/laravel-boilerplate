{!! Form::open(['route' => ['admin.languages.destroy', $code], 'method' => 'delete']) !!}
<div class='btn-group'>
    @ability('super-admin' ,'languages.show')
    <a href="{{ route('admin.languages.show', $code) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    @endability
    @ability('super-admin' ,'languages.edit')
    <a href="{{ route('admin.languages.edit', $code) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    @endability
    @ability('super-admin' ,'languages.destroy')
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "confirmDelete($(this).parents('form')[0]); return false;"
    ]) !!}
    @endability
</div>
{!! Form::close() !!}
