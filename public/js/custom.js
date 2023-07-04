function showModalBuilding(string, id) {
    $('#modalBuildingLabel').text(`${string} Edificio`)

    if (string == 'Actualizar') {
        $.ajax({
            method: "GET",
            url: `/building/search/${id}`,
        })
        .done(function( data ) {
            $('#name').val(data.data.name);
            $('#building_form').attr('action', `/building/${data.data.id}`);
        });
    }
    else {
        $('#building_form').attr('action', `/building`);
        $('#name').val("");
    }

    $('#modalBuilding').modal('show');
}


function showModalApartment(string, id) {
    $('#modalApartmentLabel').text(`${string} Apartamento`)

    $("#building_select option").each(function(){
        $(this).attr("selected",false);
    })

    if (string == 'Actualizar') {
        $.ajax({
            method: "GET",
            url: `/apartment/search/${id}`,
        })
        .done(function( data ) {
            $('#id_apartment').val(data.data.id);
            $('#name').val(data.data.name);
            $("#building_select option[value="+ data.data.building.id +"]").attr("selected",true);
            $('#apartment_form').attr('action', `/apartment/${data.data.id}`);
        });
    }
    else {
        $('#apartment_form').attr('action', `/apartment`);
        $('#name').val("");
        $('#id_apartment').val("");
    }

    $('#modalApartment').modal('show');
}

function confirmDelete(id, module) {
    $('#modalDelete').modal('show');
    $('#btnDelete').attr('onclick', `deleted(${id}, '${module}')`);
}

function deleted(id, module) {
    $.ajax({
        method: "GET",
        url: `/${module}/delete/${id}`,
    })
    .done(function( data ) {
        $('#modalDelete').modal('hide');
        $(`#table_${module}`).DataTable().ajax.reload();
        alertify.set('notifier','position', 'top-center');
        alertify.warning('registro eliminado con exito!');
    });
}

function showModalCensoLeader(string, id) {
    $('#modalCensoLabel').text(string);

    if (string == 'Actualizar') {
        $.ajax({
            method: "GET",
            url: `/censos/leader/search/${id}`,//TODO: Hacermetodo y url para buscar al lider de familia
        })
        .done(function( data ) {
            console.log(data.data);
        });
    }
    else {
        $('#is_leader').val(1);
        $('#censo_form').attr('action', `/censo`);
        //TODO: Resetear valores de formulario
    }

    $('#modalCensoLeader').modal('show')
}

$('#building').on('change', (event) => {
    let id_building = $('#building').val();

    $.ajax({
        method: "GET",
        url: `/apartment/search?building_id=${id_building}`,
    })
    .done(function( data ) {

        $('#apartment').empty();

        $('#apartment').append(`<option value='' >Selecciona apartamento...</option>`);
        data.data.forEach(element => {
            $('#apartment').append(`<option value='${element.id}' >${element.name}</option>`);
        });
    });
})

function showModalCensoFamily(string) {
    $('#modalCensoLabel').text(string);

    if (string == 'Actualizar') {
        $.ajax({
            method: "GET",
            url: `/censos/search/${id}`,//TODO: Hacermetodo y url para buscar al lider de familia
        })
        .done(function( data ) {
            console.log(data.data);
        });
    }
    else {
        $('#is_leader').val(0);
        $('#censo_form').attr('action', `/censo`);
        //TODO: Resetear valores de formulario
    }

    $('#modalCensoLeader').modal('show')
}

$('#btnSearch').on('click', () => {

    let dni = $('#dni').val();

    if (dni == "") {
        alertify.set('notifier','position', 'top-center');
        alertify.warning('No ha escrito ninguna cedula');
        return false;
    }

    $.ajax({
        method: "GET",
        url: `/search?dni=${dni}&check=true`
    })
    .done(function( data ) {
        
        if(data.person) {
            $('#showDetail').attr('href', `/search?type=detail&dni=${dni}`);
            
            if(data.person.is_leader == 1) {
                $('#completeCenso').attr('href', `/search?type=censo&dni=${dni}`);
            }

            $('#modalTypeSearch').modal('show');
        }
        else {
            alertify.set('notifier','position', 'top-center');
            alertify.warning('No se encontro registro, intenta con otra cedula.!');
            return false;
        }
        
        
    });
})

function showModalUser(string, id) {
    $('#modalUserLabel').text(`${string} Usuario`)

    $("#role_id option").each(function(){
        $(this).attr("selected",false);
    })

    if (string == 'Actualizar') {
        $.ajax({
            method: "GET",
            url: `/user/search/${id}`,
        })
        .done(function( data ) {
            $('#user_id').val(data.user.id);
            $('#name').val(data.user.name);
            $('#email').val(data.user.email);
            $('#user_form').attr('action', `/user/${data.user.id}`);
            $("#role_id option[value="+ data.user.role_id +"]").attr("selected",true);
        });
    }
    else {
        $('#user_form').attr('action', `/user`);
    }

    $('#modalUser').modal('show');
}