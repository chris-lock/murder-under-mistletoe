{{ Html::ul($errors->all()) }}

{{ Form::open(array(
    'url' => model_route($resource, isset($resource->id) ? 'update' : 'store'),
    'method' => isset($resource->id) ? 'PUT' : 'POST',
)) }}
    {{ $slot }}

    {{ Form::submit(
        isset($resource->id) ? 'Update' : 'Create',
        array('class' => 'btn btn-primary')
    ) }}
{{ Form::close() }}
