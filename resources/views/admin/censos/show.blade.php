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
                    <h3 class="card-title"><strong>Censos Familiar</strong> </h3>
                </div>
                <div class="col-2">
                    <button id="new_building" type="button" class="btn btn-primary" onclick="showModalCensoLeader('Nuevo')">Agregar Jefe</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            
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
                    <x-form_censo :buildings=$buildings/>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">
  var onloadCallback = function() {
    alert("grecaptcha is ready!");
  };
</script>
@endsection