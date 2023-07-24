<div>
<form action="/censo" method="POST" id="user_form">
        @csrf

        <input type="hidden" id="user_id" name="user_id">


        <div class="row">
            <div class="col">
                <label for="exampleInputEmail1">Nombres</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa los nombres" value="{{old('name')}}">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa el email" value="{{old('email')}}">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputEmail1">Rol</label>
                    <select class="form-control" id="role_id" name="role_id">
                        <option value="">Selecciona rol...</option>/
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="exampleInputEmail1">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa el password" value="{{old('password')}}">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputEmail1">Pregunta de Seguridad</label>
                    <select class="form-control" id="question" name="question">
                        <option value="">Selecciona una pregunta...</option>/
                        <option value="Nombre de La Mama">Nombre de la Mama</option>
                        <option value="Nombre de tu Mascota">Nombre de tu Mascota</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="exampleInputEmail1">Respuesta de Pregunta de Seguridad</label>
                <input type="answer" class="form-control" id="answer" name="answer" placeholder="Ingresa la respuesta de seguridad" value="{{old('answer')}}">
            </div>
        </div>

        </br>

        <div class="row">
            <div class="col offset-10">
                <button type="btn" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    
    </form>
</div>