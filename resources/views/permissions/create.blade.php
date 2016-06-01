@extends('layouts.acl')
@section('content')
<div class="well">
    <h1>Add New Permission</h1>
    {!! Form::open(['url' => '/permissions', 'class' => 'form-horizontal']) !!}
        @include('permissions.form', ['submitButtonText' => 'Create'])
    {!! Form::close() !!}
</div>
@endsection
