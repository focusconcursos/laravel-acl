@extends('layouts.acl')
@section('content')
<div class="well">
    <h1>Add New Role</h1>
    {!! Form::open(['url' => 'roles', 'class' => 'form-horizontal']) !!}
        @include('roles.form', ['submitButtonText' => 'Create'])
    {!! Form::close() !!}
</div>
@endsection
