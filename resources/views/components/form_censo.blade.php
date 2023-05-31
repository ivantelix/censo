<div>
    <form action="/censo" method="POST" id="censo_form">
        @csrf

        <input type="hidden" id="id">
        
        @if(isset($leader))
            <input type="hidden" id="leader_family_id" name="leader_family_id" value="{{$leader->id}}">
        @endif


        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputEmail1">Edificio</label>
                    <select class="form-control" id="building" name="building_id">
                        <option value="">Selecciona edificio...</option>/
                        @foreach($buildings as $building)
                            <option value="{{ $building->id }}" @selected(old('building_id') == $building->id)>
                                {{$building->name}}
                            </option>
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
            <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa los nombres" value="{{old('name')}}">
            </div>

            <div class="col">
                <label for="exampleInputEmail1">Apellidos</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Ingresa los apellidos" value="{{old('lastname')}}">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="exampleInputEmail1">Cedula</label>
                <input type="text" class="form-control" id="dni" name="dni" placeholder="Ingresa la cedula" value="{{old('dni')}}">
            </div>

            <div class="col">
                <label for="exampleInputEmail1">Telefono</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Ingresa Nro Telefono" value="{{old('phone')}}">
            </div>

            <div class="col">
                <label for="exampleInputEmail1">Fecha de Nacimiento</label>
                <input type="text" class="form-control" id="birthday" name="birthdate" placeholder="Ingresa Fecha de Nacimiento" value="{{old('birthdate')}}">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="exampleInputEmail1">Correo Electronico</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Ingresa Correo Electronico" value="{{old('email')}}">
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
                        <input class="form-check-input" type="radio" name="reside_community" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="reside_community" id="inlineRadio2" value="0">
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
                    <!--@if(isset($leader))
                        <button type="button" id="btn_add_family" class="btn btn-primary">Enviar</button>
                    @else
                        <button type="btn" class="btn btn-primary">Enviar</button>
                    @endif-->
                </div>
            </div>
        </div>
    
    </form>
</div>