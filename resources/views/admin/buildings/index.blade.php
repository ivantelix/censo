@extends('layouts.admin')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edificios</li>
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
                <div class="col-11">
                    <h3 class="card-title"><strong>Lista de Edificios</strong> </h3>
                </div>
                <div class="col-1">
                    <button id="new_building" type="button" class="btn btn-primary" onclick="showModalBuilding('Nuevo')">Nuevo</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                <thead>
                    <tr>
                        <th class="sorting sorting_asc">ID</th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Edificio</th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalBuilding" tabindex="-1" role="dialog" aria-labelledby="modalBuildingLabel" aria-hidden="true">
        <div class="modal-dialog" `role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBuildingLabel">Nuevo Edificio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <x-form_buildings/>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      ajax: '{{route('buildings')}}',
      columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
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
  
</script>
@endsection