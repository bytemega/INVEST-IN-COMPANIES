@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div>
                            <h4 class="card-title"><span class="lstick"></span><i class="mdi mdi-account-multiple-plus"></i> {{ __('Crear nueva usuario') }}</h4>
                        </div>
                    </div>
                    <form  class="form-control-line form-material" action="{{ action('dashboard\UsuariosController@store')}}">
                            @csrf
                            <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="col-md-12 form-control-label" for="name">{{ __('Nombre') }}</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ old('name') }}"  class="form-control form-control-line {{ $errors->has('name') ? ' form-control-danger' : '' }}" id="name" name="name" required>
                                </div>
                                @if ($errors->has('name'))
                                <div class="col-md-12 form-control-feedback">{{ $errors->first('name') }}</div>
                                @endif

                            </div>

                            <div class="form-group {{ $errors->has('surname') ? ' has-danger' : '' }}">
                                <label class="col-md-12 form-control-label" for="surname">{{ __('Apellidos') }}</label>
                                <div class="col-md-12">
                                    <input type="text"  value="{{ old('surname') }}"   class="form-control form-control-line {{ $errors->has('surname') ? ' form-control-danger' : '' }}" id="surname" name="surname" required>
                                </div>
                                @if ($errors->has('surname'))
                                <div class="col-md-12 form-control-feedback">{{ $errors->first('surname') }}</div>
                                @endif

                            </div>


                            <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="col-md-12 form-control-label" for="email">{{ __('Email') }}</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ old('email') }}"  class="form-control form-control-line {{ $errors->has('email') ? ' form-control-danger' : '' }}" id="email" name="email" required>
                                </div>
                                @if ($errors->has('email'))
                                <div class="col-md-12 form-control-feedback">{{ $errors->first('email') }}</div>
                                @endif

                            </div>

                            <div class="form-group  {{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label class="col-md-12 col-form-label " for="password" >{{ __('Password') }}</label>
    
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                </div>
                                @if ($errors->has('password'))
                                <div class="col-md-12 form-control-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
        
        
                            <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label class="col-md-12 col-form-label"  for="password_confirmation">{{ __('Confirma Password') }}</label>
                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                                @if ($errors->has('password'))
                                <div class="col-md-12 form-control-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('phone') ? ' has-danger' : '' }}">
                                <label class="col-md-12 form-control-label" for="phone">{{ __('Teléfono') }}</label>
                                <div class="col-md-12">
                                    <input type="text"value="{{ old('phone') }}"  class="form-control form-control-line {{ $errors->has('phone') ? ' form-control-danger' : '' }}" id="phone" name="phone" required>
                                </div>
                                @if ($errors->has('phone'))
                                <div class="col-md-12 form-control-feedback">{{ $errors->first('phone') }}</div>
                                @endif

                            </div>

                            <div class="form-group {{ $errors->has('role') ? ' has-danger' : '' }}">
                                <label for="role" class="col-md-12 col-form-label ">{{ __('Role') }}</label>
    
                                <div class="col-md-12">
                                    <select name="role" id="role" class="form-control form-control-line {{ $errors->has('role') ? ' form-control-danger' : '' }}" required>
                                        <option value="0">{{ __('Selecciona Perfil') }}</option>
                                        @foreach ($roles as $role)
                                        <?php $usuarioRole= $role->name; ?>
                                        <option value="{{ $role->id }}" @if ( old('role')==$role->id)
                                            selected
                                            @endif  class="round role{{ substr($usuarioRole,0,2) }}">{{ $usuarioRole }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                @if ($errors->has('role'))
                                <div class="col-md-12 form-control-feedback">{{ $errors->first('role') }}</div>
                                @endif
                            </div>


                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success">{{ __('Crear Usuario') }}</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection


@section('scripts')


@endsection