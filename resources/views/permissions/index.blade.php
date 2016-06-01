@extends('layouts.acl')
@section('content')
    <div class="col-md-12">
        <div class="page-header">
            <h1>Permissions <a href="{{ url('/permissions/create') }}" class="btn btn-primary pull-right btn-sm">New</a></h1>
        </div>
        <div class="table">
            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <th class="text-center">ID</th><th>Permission</th><th>Description</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($permissions as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="{{ url('/permissions', $item->id) }}">{{ $item->name }}</a></td><td>{{ $item->description }}</td>
                        <td>
                            <a href="{{ url('permissions/' . $item->id . '/edit') }}" class="btn btn-primary btn-sm">Edit</a> /
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['/permissions', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <ul class="pagination"> {!! $permissions->render() !!} </ul>
            </div>
        </div>
    </div>
@endsection
