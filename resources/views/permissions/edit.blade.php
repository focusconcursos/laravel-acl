@extends('layouts.acl')
@section('content')
<div class="well">
    <h1>Edit Permission</h1>
    {!! Form::model($permission, ['method' => 'PATCH', 'url' => ['/permissions', $permission->id], 'class' => 'form-horizontal']) !!}
        @include('permissions.form', ['submitButtonText' => 'Update'])
    {!! Form::close() !!}
@endsection
