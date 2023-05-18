<div>
    <form method="POST" action="{{route('create_apartment')}}" id="apartment_form">
        @csrf
        
        <input type="hidden" id="id_apartment" name="id">

        <div class="form-group mb-2">
            <label for="exampleFormControlSelect1">Edificio</label>
            <select class="form-control" name="building_id" id="building_select">
                <option value="0" selected>Seleccionar edificio...</option>
                @if(isset($buildings))
                    @foreach($buildings as $building)
                        <option value="{{$building->id}}">{{$building->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="form-group">
            <label>Nombre de Apartamento</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col offset-10">
                    <button type="btn" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </form>
</div>