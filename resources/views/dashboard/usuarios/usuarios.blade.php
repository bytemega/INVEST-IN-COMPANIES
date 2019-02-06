@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            @if (session()->has('success'))
                <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        {{ __('El usuario se ha credo correctamente. Se ha enviado un email de confirmación a ') }} <strong>{{ session('email') }}</strong>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        {{ e(session('mensaje')) }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div>
                            <h4 class="card-title"><span class="lstick"></span><i class="mdi mdi-account-multiple"></i> {{ __('Listado de usuarios') }}</h4>
                        </div>
                    </div>
                    <div class="table-responsive m-t-20 no-wrap">
                        <table class="table vm no-th-brd pro-of-month hover-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ __('Nombre') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Asociaciones') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($usuarios->isNotEmpty())
                                    @foreach ($usuarios as $usuario)
                                    <?php 
                                        $usuarioRole= $usuario->roles->first()->name; 
                                        $num_asociaciones = $usuario['asociacion']->count();
                                        // dd($usuario->asociacion$relationMethod());
                                    ?>
                                    <tr>
                                        <td>
                                            
                                            @if($usuario->email_verified_at)
                                                <i class="fas fa-check text-success"></i>
                                            @else
                                                <i class="mdi mdi-close text-warning"></i>
                                            @endif
                                        </td>
                                        <td >
                                            <h6><span class="round role{{ substr($usuarioRole,0,2) }}">{{ substr($usuarioRole,0,1) }}</span> {{ e($usuario->name) }}</h6>
                                        </td>
                                        <td>{!! e($usuario->email) !!}</td>
                                        <td class="text-center">
                                            @if($num_asociaciones>0)
                                            <span class="badge badge-primary  pull-right">{{ e($num_asociaciones) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="<?php echo urldecode(route('dashboardUsuario',['usuario'=>$usuario])); ?>" class="label label-success label-rounded" title="{{ __('Ver') }}"><i class="mdi mdi-eye"></i></a>
                                            @if($num_asociaciones==0 && $usuarioRole!="Admin")
                                            <a href="#" class="label label-danger label-rounded borrarUsuario" data-toggle="modal" data-url="<?php echo urldecode(route('dashboardUsuarioDelete',['usuario'=>$usuario])); ?>" data-id="{{$usuario->id}}"  data-name="{{$usuario->name}}" data-target="#custom-width-modal"  title="{{ __('Eliminar') }}"><i class="mdi mdi-delete-forever"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="5">
                                       <p>{{ __('No hay resultados disponibles') }}</p>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
               
                    {{ $usuarios->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Delete Model -->
<form method="POST" class="form-control-line form-material" action="" id="formBorrar">
        @csrf
        @method('POST')
        <input type="hidden" value="" name="usuario_id_borrar" id="usuario_id_borrar">
    <div id="borrar-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 id="texto-modal-borrar"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">{{ __('Cerrar') }}</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light" id="BotonEliminar">{{ __('Eliminar') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection


@section('scripts')
<script>
$(document).on('click', '.borrarUsuario', function (e) {
    e.preventDefault();
    $('#texto-modal-borrar').html('{{ __('Seguro que deseas borrar la asociación') }}'+' <strong>'+ $(this).data('name')+' </strong>');
    $('#usuario_id_borrar').val($(this).data('id'));
    $('#BotonEliminar').on('click', function(e) {
        e.preventDefault();
        $('#formBorrar').attr('action',"/usuarios/delete/"+$('#usuario_id_borrar').val());
        $('#formBorrar').submit();
        $form = '';
    });
    $('#borrar-modal').modal('show');
});

</script>

@endsection
