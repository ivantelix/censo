function showModalBuilding(string, id) {
    $('#modalBuildingLabel').text(`${string} Edificio`)

    if (string == 'Actualizar') {
        $.ajax({
            method: "GET",
            url: `/building/search/${id}`,
        })
        .done(function( data ) {
            $('#name').val(data.data.name)
            $('#building_form').attr('action', `/building/${data.data.id}`)
        });
    }
    else {
        $('#building_form').attr('action', `/building`)
        $('#name').val("")
    }

    $('#modalBuilding').modal('show')
}


function showModalApartment(string, id) {
    $('#modalApartmentLabel').text(`${string} Apartamento`)

    $("#building_select option").each(function(){
        $(this).attr("selected",false);
        console.log();
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
        $('#apartment_form').attr('action', `/apartment`)
        $('#name').val("")
        $('#id_apartment').val("");
    }

    $('#modalApartment').modal('show')
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