@extends('layouts.admin')

@section('headerscripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Censos</li>
        </ol>
    </nav>
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" style="color: white;opacity: 1;" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        </div>
    @endif

    @isset($messages)
        <div class="alert alert-success">  
            <button type="button" class="close" style="color: white;opacity: 1;" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div>
                {{$messages}}
            </div>
        </div>
    @endisset

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h3 class="card-title"><strong>Censos Familiar - Jefe de Familia</strong> </h3>
                </div>
                <div class="col-2">
                    @if(isset($leader))
                        <button disabled id="new_leader" type="button" class="btn btn-primary" onclick="showModalCensoLeader('Nuevo Censo de Lider')">Agregar Jefe</button>
                    @else
                        <button id="new_leader" type="button" class="btn btn-primary" onclick="showModalCensoLeader('Nuevo Censo de Lider')">Agregar Jefe</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(isset($leader))
                <div class="card">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <ul>
                                    <li><strong>Nombre:</strong>{{$leader->name}}</li>
                                    <li><strong>Apellido:</strong>{{$leader->lastname}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-9">
                                <h3 class="card-title"><strong>Censo Familiar - Carga Familiar</strong> </h3>
                            </div>
                            <div class="col-3">
                                @if(isset($leader))

                                    <!--TODO: Evaluar esta logica para refactorizar-->
                                    <input type="hidden" id="leader_id" name="leader_id" value="{{$leader->id}}">

                                    <button id="new_family" type="button" class="btn btn-primary" onclick="showModalCensoFamily('Nuevo Censo de Integrante de Familia')">Agregar Jefe</button>
                                @else
                                    <button disabled id="new_family" type="button" class="btn btn-primary" onclick="showModalCensoFamily('Nuevo Censo de Integrante de Familia')">Agregar Carga Familiar</button>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="table_family" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="table_apartment_info">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc">ID</th>
                                    <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1">Nombre</th>
                                    <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1">Apellido</th>
                                    <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1">dni</th>
                                    <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1">Acciones</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Censo Lider-->
    <div class="modal" tabindex="-1" role="dialog" id="modalCensoLeader">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCensoLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(isset($leader))
                        <x-form_censo :buildings=$buildings :leader=$leader/>
                    @else
                        <x-form_censo :buildings=$buildings/>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">

    var leader_id = $('#leader_id').val()

    $(function (item) {
        $('#table_family').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true,
          "responsive": true,
          ajax: `/censos/getFamily/${leader_id}`,
          columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'lastname', name: 'lastname'},
                {data: 'dni', name: 'dni'},
                {
                    data: 'action', name: 'action', 
                    render: function(data, type, row, meta) {
                        let checkbox = `<button class="btn btn-primary" onclick="showModalBuilding('Actualizar', ${row.id})">Editar</button>`;
                        return checkbox;
                    },

                },
            ]
        });
    });
  
    $(document).ready(function(){
        $('#example2_length').parent().removeClass('col-md-6');
        $('#example2_filter').parent().removeClass('col-md-6');
        $('#example2_length').parent().addClass('col-md-10');
        $('#example2_filter').parent().addClass('col-md-2');
    });

    var onloadCallback = function() {
        alert("grecaptcha is ready!");
    };
</script>
@endsection