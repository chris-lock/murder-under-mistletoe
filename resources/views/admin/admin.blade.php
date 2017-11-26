@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 sidebar">
            <nav class="list-group">
                <a class="list-group-item{{ activePathClass('admin/stories') }}" href="/admin/stories">
                    Story
                </a>

                <a class="list-group-item{{ activePathClass('admin/acts') }}" href="/admin/acts">
                    Acts
                </a>

                <a class="list-group-item{{ activePathClass('admin/characters') }}" href="/admin/characters">
                    Characters
                </a>
            </nav>
        </div>
        <div class="col-md-9 main">
            <div class="panel panel-default">
                @yield('panel')
            </div>
        </div>
    </div>
</div>
@endsection
