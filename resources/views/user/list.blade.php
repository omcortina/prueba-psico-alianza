<title>Usuarios</title>
@extends('layouts.index')

@section('breadcumb')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Usuarios</h3>
    </div>
</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if (session('message_success_user_create'))
                        <div id="msg" class="alert alert-success" >
                            <li>{{session('message_success_user_create')}}</li>
                        </div>
                        <script>
                            setTimeout(function(){ $('#msg').fadeOut() }, 4000);
                        </script>
                    @endif

                    @if (session('message_success_user_edit'))
                        <div id="msg" class="alert alert-success" >
                            <li>{{session('message_success_user_edit')}}</li>
                        </div>
                        <script>
                            setTimeout(function(){ $('#msg').fadeOut() }, 4000);
                        </script>
                    @endif

                    <h4 class="card-title">Listado de usuarios</h4>
                    <button class="btn btn-primary mt-3 mb-3" onclick="location.href='{{ route('user/create') }}'">Nuevo</button>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Identificación</th>
                                    <th>Teléfono</th>
                                    <th>Ciudad</th>
                                    <th>Colaborador</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->first_name }}</td>
                                        <td>{{ $item->last_name }}</td>
                                        <td>{{ $item->identification }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->city }}</td>
                                        <td>{{ $item->collaborator == null ? "Sin asignar" : $item->collaborator->first_name." ".$item->collaborator->last_name }}</td>
                                        <td>
                                            <a href="{{ route('user/edit', $item->id) }}" title="Editar">
                                                <i class="mdi mdi-24px mdi-account-edit"></i>
                                            </a>
                                            <a href="#" onclick="getListCollaborators('{{ route('user/getListCollaborators', $item->id) }}')" title="Asignar colaborador">
                                                <i class="mdi mdi-24px mdi-account-settings-variant"></i>
                                            </a>
                                            <a href="#" onclick="deleteUser('{{ route('user/delete', $item->id) }}')" title="Eliminar">
                                                <i class="mdi mdi-24px mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function deleteUser(route){
            Swal.fire({
                title: '¿Desea eliminar este usuario?',
                text: "No se podrá recuperar la información!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.get(route, (response) => {
                        if(!response.error){
                            Swal.fire(
                                'Eliminado!',
                                response.message,
                                'success'
                            ).then((result) => {
                                if(result.isConfirmed) location.reload()
                            })
                        }
                    })
                    
                }
            })
        }

        function getListCollaborators(route){
            $.get(route, (response) => {
                $("#route").val(route)
                let option = "<option value=''>Seleccione...</option>"
                response.forEach((item) => {
                    console.log(item)
                    option += `<option value="${item.id}">${item.first_name + ' ' + item.last_name}</option>`
                })
                $("#select_collaborator").html(option)
                $("#modalAssign").modal("show")
            })
        }

        function assign(){
            let idUserCollaborator = $("#select_collaborator").val()

            if(idUserCollaborator == ""){
                tata.error('PsicoAlianza', 'Seleccione un empleado', {
                    duration: 2000
                })
                return false
            }

            let url = $("#route").val().replace('getListCollaborators', 'assign') + "/" + idUserCollaborator

            
            $.get(url, (response) => {
                if(!response.error){
                    Swal.fire(
                        'PsicoAlizanza',
                        response.message,
                        'success'
                    ).then((result) => {
                        if(result.isConfirmed) location.reload()
                    })
                }else{
                    Swal.fire(
                        'PsicoAlizanza',
                        response.message,
                        'danger'
                    ).then((result) => {
                        if(result.isConfirmed) location.reload()
                    })
                }
            })
        }
    </script>
@endsection

<div class="modal fade" id="modalAssign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Asignar colaborador</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modalAssign').modal('hide')">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="form-group">
                <input type="hidden" id="route">
                <label>Colaborador(a)</label>
                <select class="form-control" id="select_collaborator"></select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="assign()">Asignar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modalAssign').modal('hide')">Cerrar</button>
        </div>
      </div>
    </div>
</div>
