<div>
    <form method="POST" action="{{route('create_apartment')}}" id="apartment_form">
        @csrf

        <div class="form-group">
            <label for="exampleFormControlSelect1"></label>
            <select class="form-control" id="building_select">
            </select>
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