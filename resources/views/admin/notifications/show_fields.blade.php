<!-- Id Field -->
<dt>{!! Form::label('id', 'Id:') !!}</dt>
<dd>{!! $notification->id !!}</dd>

<!-- Sender Id Field -->
<dt>{!! Form::label('sender_id', 'Sender To:') !!}</dt>
<dd>{!! $notification->users_csv !!}</dd>

<!-- Url Field -->
<dt>{!! Form::label('url', 'Url:') !!}</dt>
<dd>{!! $notification->url !!}</dd>

<!-- Action Type Field -->
<dt>{!! Form::label('action_type', 'Action Type:') !!}</dt>
<dd>{!! $notification->action_type !!}</dd>

<!-- Ref Id Field -->
<dt>{!! Form::label('ref_id', 'Ref Id:') !!}</dt>
<dd>{!! $notification->ref_id !!}</dd>

<!-- Message Field -->
<dt>{!! Form::label('message', 'Message:') !!}</dt>
<dd>{!! $notification->message !!}</dd>

<!-- Status Field -->
<dt>{!! Form::label('status', 'Sent:') !!}</dt>
<dd>{!! $notification->status==0?'<span class="label label-danger">No</span>':'<span class="label label-success">Yes</span>' !!}</dd>

<!-- Created At Field -->
<dt>{!! Form::label('created_at', 'Created At:') !!}</dt>
<dd>{!! $notification->created_at !!}</dd>

<!-- Updated At Field -->
<dt>{!! Form::label('updated_at', 'Updated At:') !!}</dt>
<dd>{!! $notification->updated_at !!}</dd>


