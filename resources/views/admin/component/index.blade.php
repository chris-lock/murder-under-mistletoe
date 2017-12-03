@extends('admin.admin')

@section('panel')
    <div class="panel-heading clearfix">
        <h1 class="panel-title pull-left">{{ $controller }}s</h1>

        <a
            class="btn btn-default btn-xs pull-right"
            href="{{ route(strtolower($controller) . 's.create') }}"
        >
            Create {{ $controller }}
        </a>
    </div>

    @if (count($resources) > 0)
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>

                    @foreach($columns as $column)
                        <th>{{ title_case(str_replace('_', ' ', $column)) }}</th>
                    @endforeach

                    @if ($controller == 'Character')
                        <th>&nbsp;</th>

                        <th>&nbsp;</th>
                    @endif

                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach($resources as $resource)
                    <tr>
                        <th>{{ $resource->id }}</th>

                        @foreach($columns as $column)
                            <td>{{ $resource->$column }}</td>
                        @endforeach

                        @if ($controller == 'Character')
                            <td>
                                <a
                                    class="btn btn-primary btn-xs pull-right"
                                    href="{{ mailto_character($resource) }}"
                                >
                                    Character
                                </a>
                            </td>

                            <td>
                                <a
                                    class="btn btn-primary btn-xs pull-right"
                                    href="{{ mailto_relationships($resource) }}"
                                >
                                    Relationships
                                </a>
                            </td>
                        @endif

                        <td>
                            <a
                                class="btn btn-primary btn-xs pull-right"
                                href="{{ model_route($resource, 'edit') }}"
                            >
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="panel-body">
            No {{ $controller }}s
        </div>
    @endif
@endsection
