@extends('admin.admin')

@section('panel')
    <div class="panel-heading clearfix">
        <h1 class="panel-title pull-left">{{ "$submit $resource_name" }}</h1>

        @if(isset($resource->id) && !isset($prevent_destory))
            {{ Form::open(array(
                'url' => route(strtolower($resource_name) . 's.destroy', $resource->id),
                'method' => 'DELETE',
            )) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs pull-right')) }}
            {{ Form::close() }}
        @endif
    </div>

    <div class="panel-body">
        {{ Html::ul($errors->all()) }}

        {{ Form::open(array('url' => $url, 'method' => $method)) }}
            @yield('form')

            {{ Form::submit($submit, array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
    </div>
@endsection
