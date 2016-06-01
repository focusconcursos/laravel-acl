@extends('layouts.acl')
@section('content')
<div class="well">
    <h1>User</h1>
    <dl class="dl-horizontal">
    <dt>ID</dt>
    <dd>{{ $user->id}}</dd>
    <dt>Name</dt>
    <dd>{{ $user->name}}</dd>
    <dt>Email</dt>
    <dd>{{ $user->email}}</dd>
    <dt>Roles</dt>
    <dd>
        @foreach ($user->roles as $role)
            <span class="label label-success">{{ $role->description }}</span>
        @endforeach
        <a class="btn btn-success btn-sm" href="/users/{{ $user->id }}/roles/edit" role="button">Update Role</a>
    </dd>
</dl>

</div>
@endsection
