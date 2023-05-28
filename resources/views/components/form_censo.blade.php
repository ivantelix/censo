<div>
    <form action="/censo" method="POST" id="censo_form">
        @csrf

        <input type="hidden" id="id">
        <input type="hidden" id="leader_id">

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputEmail1">Edificio</label>
                    <select class="form-control" id="building" name="building_id">
                        <option value="">Selecciona edificio...</option>/
                        @foreach($buildings as $building)
                            <option value="{{$building->id}}">{{$building->name}}</option>
                        @endforeach
                    </select>
                </div>
            
            </div>

            <div class="col">
            <div class="form-group">
                    <label for="exampleInputEmail1">Apartamento</label>
                    <select class="form-control" id="apartment" name="apartment_id">
                        <option value="">Selecciona apartamento...</option>/
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
            <label for="exampleInputEmail1">Nombres</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Ingresa los nombres">
            </div>

            <div class="col">
                <label for="exampleInputEmail1">Apellidos</label>
                <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="emailHelp" placeholder="Ingresa los apellidos">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="exampleInputEmail1">Cedula</label>
                <input type="text" class="form-control" id="dni" name="dni" placeholder="Ingresa la cedula">
            </div>

            <div class="col">
                <label for="exampleInputEmail1">Telefono</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Ingresa Nro Telefono">
            </div>

            <div class="col">
                <label for="exampleInputEmail1">Fecha de Nacimiento</label>
                <input type="text" class="form-control" id="birthday" name="birthdate" placeholder="Ingresa Fecha de Nacimiento">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="exampleInputEmail1">Correo Electronico</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Ingresa Correo Electronico">
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="exampleInputEmail1">Parentesco</label>
                    <select class="form-control" id="relationship" name="relationship">
                        <option value="">Selecciona parentesco...</option>/
                        <option value="parents">Padres</option>
                        <option value="children">Hijos</option>
                        <option value="brother">Hermanos</option>
                        <option value="grandparents">Abuelos</option>
                        <option value="grandchildren">Nietos</option>
                        <option value="uncles">Tios</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="exampleInputEmail1">Reside en el consejo comunal</label>
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="reside_community" id="inlineRadio1" value="yes">
                        <label class="form-check-label" for="inlineRadio1">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="reside_community" id="inlineRadio2" value="no">
                        <label class="form-check-label" for="inlineRadio2">No</label>
                    </div>
                </div>
            </div>

        </div>

        <!--TODO: Configurar validacion recaptcha recaptcha-->
        <!--
            Url ejemplo
            https://developers.google.com/recaptcha/docs/display?hl=es-419
        <div class="row">
            <div class="col">
                <div class="g-recaptcha" data-sitekey="6Ld-qKoUAAAAAF3qEUN7O_xPqRk5IZqY1KKWfAX0"></div>
            </div>
        </div>-->

        <div class="form-group">
            <div class="row">
                <div class="col offset-10">
                    <button type="btn" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    
    </form>
</div>