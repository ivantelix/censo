@extends('layouts.admin')

@section('headerscripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Censos</li>
            <li class="breadcrumb-item active" aria-current="page">Detalles</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h3 class="card-title"><strong>Informacion Personal</strong> </h3>
                </div>
                <div class="col-2">
                    <a name="generate" id="" class="btn btn-primary" href="/generate/{{$person->dni}}" role="button">Generar Constancia</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="container">
                </br>

                    <div class="row">
                        <div class="col-6">
                            </br>
                            <div class="container">
                                <p><strong>Informacion de Ubicacion del Jefe</strong></p>
                            </div>
                            <ul>
                                <li><strong>Bloque/Edificio: </strong>{{$person->apartment->building->name}}</li>
                                <li><strong>Apartamento: </strong>{{$person->apartment->name}}</li>
                            </ul>
                        </div>
                        <div class="col-6">
                        </br>
                            <div class="container">
                                <p><strong>Informacion de Personal del Jefe</strong></p>
                            </div>
                            <ul>
                                <li><strong>Nombre: </strong>{{$person->name}}</li>
                                <li><strong>Apellido: </strong>{{$person->lastname}}</li>
                                <li><strong>Cedula: </strong>{{$person->dni}}</li>
                                <li><strong>Telefono: </strong>{{$person->phone}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection