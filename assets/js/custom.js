$('#category_id').change(function() {

	var category_id = $('#category_id').val();
    if (category_id !== '') {
        $.ajax({
            url: "<?php echo base_url(); ?>product/fetch_services",
            method: "POST",
            data: {
                "category_id" : category_id
            },
            success: function(data) {
                $('#service_id').html(data);
            }
        });
    } else {
        $('#service_id').html('<option value="">Seleccionar servicio</option>');
    }
});

$('#region_id').change(function() {

    var region_id = $('#region_id').val();
    if (region_id !== '') {
        $.ajax({
            url: "<?php echo base_url(); ?>product/fetch_comunas",
            method: "POST",
            data: {
                "region_id" : region_id
            },
            success: function(data) {
                $('#comuna_id').html(data);
            }
        });
    } else {
        $('#comuna_id').html('<option value="">Seleccionar comuna</option>');
    }
});
