@extends('layouts.acl')
@section('content')
<div class="well">
    <h1>Role Details</h1>
    <dl class="dl-horizontal">
        <dt>ID.</dt>
        <dd>{{ $role->id }}</dd>
        <dt>Role</dt>
        <dd>{{ $role->name }}</dd>
        <dt>Description</dt>
        <dd>{{ $role->description }}</dd>
        <dt>Permissions</dt>
        <dd>
            @foreach ($role->permissions as $permission)
                <span class="label label-info">{{ $permission->name }}</span>
            @endforeach
        </dd>
    </dl>
</div>
@endsection
