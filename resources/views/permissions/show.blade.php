@extends('layouts.acl')
@section('content')
<div class="well">
    <h1>Permission Details</h1>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Permission</th><th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $permission->id }}</td> <td> {{ $permission->name }} </td><td> {{ $permission->description }} </td>
                </tr>
            </tbody>    
        </table>
    </div>
</div>
@endsection
