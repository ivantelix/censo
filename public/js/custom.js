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

function confirmDelete(id) {
    $('#modalDelete').modal('show');
    $('#btnDelete').attr('onclick', `deleted(${id})`);
}

function deleted(id) {
    $.ajax({
        method: "GET",
        url: `/apartment/delete/${id}`,
    })
    .done(function( data ) {
        $('#modalDelete').modal('hide');
        $('#table_apartment').DataTable().ajax.reload();
        alert("registro eliminado con exito!");
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
        $('#censo_form').attr('action', `/censo`);
        //TODO: Resetear valores de formulario
    }

    $('#modalCensoLeader').modal('show')
}

$('#btn_add_family').on('click', function() {
    
    $('#table_family').DataTable().ajax.reload();
    return false;
    $.ajax({
        method: "POST",
        url: `/censo`,
        data: $('#censo_form').serialize()
    })
    .done(function( data ) {
        console.log(data);
    });
});