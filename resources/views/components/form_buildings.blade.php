<div>
    <form method="POST" action="{{route('create_building')}}" id="building_form">
        @csrf

        <div class="form-group">
            <label>Nombre de Edificio</label>
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