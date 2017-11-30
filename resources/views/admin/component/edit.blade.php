@extends('admin.admin')

@section('panel')
    <div class="panel-heading clearfix">
        <h1 class="panel-title pull-left">
            {{ (isset($resource->id) ? 'Update' : 'Create') . ' ' . model_name($resource) }}
        </h1>

        @if(!isset($prevent_destory))
            @include('admin.component.form.delete', [
                'resource' => $resource,
            ])
        @endif
    </div>

    @yield('tabs')

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane{{ isset($panel) ? "" : " active" }}" id="main">
            <div class="panel-body">
                @component('admin.component.form.edit', [
                    'resource' => $resource,
                ])
                    @yield('form')
                @endcomponent
            </div>
        </div>

        @stack('tab-panes')
    </div>
@endsection
