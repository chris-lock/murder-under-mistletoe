@if(isset($resource->id))
    {{ Form::open(array('url' => model_route($resource, 'destroy'), 'method' => 'DELETE')) }}
        {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs pull-right')) }}
    {{ Form::close() }}
@endif
