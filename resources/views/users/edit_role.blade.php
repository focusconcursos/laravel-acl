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
    </dl>
    {!! Form::model($user, ['method' => 'PATCH', 'url' => ['users/'.$user->id.'/roles/update'], 'class' => 'form-horizontal']) !!}
    <fieldset>
        <div class="form-group {{ $errors->has('roles') ? 'has-error' : ''}}">
                {!! Form::label('role_list', 'Roles:', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('role_list[]', $roles, null, ['id'=>'role_list', 'class'=>'form-control', 'multiple']) !!}
                {!! $errors->first('roles', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-4 col-md-4">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
    </fieldset>
    {!! Form::close() !!}

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
@endsection

@section('script')
    <script type="text/javascript">
      $('#role_list').select2({
            placeholder : 'Select roles',
            roles : true
        });
    </script>
@stop