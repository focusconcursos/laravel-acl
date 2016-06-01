@extends('layouts.acl')
@section('content')
<div class="well">
    <h1>Edit Role</h1>
    {!! Form::model($role, ['method' => 'PATCH', 'url' => ['roles', $role->id],'class' => 'form-horizontal']) !!}
        @include('roles.form', ['submitButtonText' => 'Update'])
    {!! Form::close() !!}
</div>
@endsection
