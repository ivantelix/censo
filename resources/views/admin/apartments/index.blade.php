@extends('layouts.admin')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Apartamentos</li>
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


    @if (session('messages'))
        <div class="alert alert-success">  
            <button type="button" class="close" style="color: white;opacity: 1;" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div>
                {{session('messages')}}
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-11 col-sm-12">
                    <h3 class="card-title"><strong>Lista de Apartamentos</strong> </h3>
                </div>
                <div class="col-md-1 col-sm-12">
                    <button id="new_building" type="button" class="btn btn-primary" onclick="showModalApartment('Nuevo')">Nuevo</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table_apartment" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="table_apartment_info">
                    <thead>
                        <tr>
                            <th class="sorting sorting_asc">ID</th>
                            <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1">Edificio</th>
                            <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1">Apartamento</th>
                            <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1">Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalApartment" tabindex="-1" role="dialog" aria-labelledby="modalApartmentLabel" aria-hidden="true">
        <div class="modal-dialog" `role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalApartmentLabel">Nuevo Apartamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-form_apartments :buildings=$buildings/>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Delete-->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" `role="document">
            <div class="modal-content">
                <div class="modal-header" style="color:white; background-color: red;">
                    <h5 class="modal-title" id="modalDeleteLabel">Confirmar Eliminar Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col offset-4">
                            <button class="btn btn-sm btn-danger" id="btnDelete">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
  $(function () {
    $('#table_apartment').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      ajax: '{{route('apartments')}}',
      columns: [
            {data: 'id', name: 'id'},
            {
                data: 'building', 
                name: 'building',
                render: function(data, type, row, meta) {
                    return row.building.name;
                },

            },
            {data: 'name', name: 'name'},
            {
                data: 'action', name: 'action', 
                render: function(data, type, row, meta) {
                    let btn = `<div class="btn-group"><a href="/appartments/list-family/${row.id}" class="btn btn-info">Ver Familia</a>`;
                    btn = btn+`<button class="btn btn-primary" onclick="showModalApartment('Actualizar', ${row.id})">Editar</button>`;
                    btn = btn+`<button class="btn btn-danger" onclick="confirmDelete(${row.id}, 'apartment')">Eliminar</button></div>`;

                    return btn;
                },

            },
        ]
    });
  });
  
  $(document).ready(function(){
    $('#table_apartment_length').parent().removeClass('col-md-6');
    $('#table_apartment_filter').parent().removeClass('col-md-6');
    $('#table_apartment_length').parent().addClass('col-md-10');
    $('#table_apartment_filter').parent().addClass('col-md-2');
  });
  
</script>
@endsection