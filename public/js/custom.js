function showModal(string, id=null) {
    $('#modalBuildingLabel').text(`${string} Edificio`)

    if (string == 'Actualizar') {
        $.ajax({
            method: "GET",
            url: `/search/${id}`,
        })
        .done(function( data ) {
            $('#name').val(data.data.name)
            $('#building_form').attr('action', `/building/${data.data.id}`)
        });
    }

    $('#modalBuilding').modal('show')
}