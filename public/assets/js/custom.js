//var baseURL = SITE_URL;

(function ($) {

    // Model to show appointment status
    $('#SHOWRDVModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var rdv_date = button.data('rdv_date') // Extract info from data-* attributes
        var rdv_id = button.data('rdv_id') // Extract info from data-* attributes
        var rdv_time_start = button.data('rdv_time_start') // Extract info from data-* attributes
        var rdv_time_end = button.data('rdv_time_end') // Extract info from data-* attributes
        var rdv_name = button.data("rdv_name") // Extract info from data-* attributes
        var rdv_details = button.data("rdv_details") // Extract info from data-* attributes
        var rdv_status = button.data("rdv_status") // Extract info from data-* attributes


        var modal = $(this)
        if(rdv_status === 1){
            modal.find('#rdv_status').html('<label class="badge badge-success-inverse"><i class="fa fa-check"></i> Approved</label>');
        }else if(rdv_status === 2){
            modal.find('#rdv_status').html('<label class="badge badge-danger-inverse"><i class="fa fa-user-times"></i> Cancelled</label>');
        }else{
            modal.find('#rdv_status').html('<label class="badge badge-warning-inverse"><i class="fa fa-hourglass-start"></i> Pending</label>');
        }
        modal.find('#appointment_name').text(rdv_name)
        modal.find('#appointment_reason').text(rdv_details)
        modal.find('#rdv_date').text(rdv_date)
        modal.find('#rdv_time').text(rdv_time_start + ' - ' + rdv_time_end)
        modal.find('#rdv_time_start_input').val(rdv_time_start)
        modal.find('#rdv_time_end_input').val(rdv_time_end)
        modal.find('#rdv_id').val(rdv_id)
        modal.find('#rdv_id2').val(rdv_id)

    })

    // Model to edit appointment status
    $('#EDITRDVModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var rdv_date = button.data('rdv_date') // Extract info from data-* attributes
        var rdv_id = button.data('rdv_id') // Extract info from data-* attributes
        var rdv_time_start = button.data('rdv_time_start') // Extract info from data-* attributes
        var rdv_time_end = button.data('rdv_time_end') // Extract info from data-* attributes
        var rdv_name = button.data("rdv_name") // Extract info from data-* attributes
        var rdv_details = button.data("rdv_details") // Extract info from data-* attributes
        var rdv_status = button.data("rdv_status") // Extract info from data-* attributes


        var modal = $(this)
        if(rdv_status === 1){
            modal.find('#rdv_status').html('<label class="badge badge-success-inverse"><i class="fa fa-check"></i> Approved</label>');
        }else if(rdv_status === 2){
            modal.find('#rdv_status').html('<label class="badge badge-danger-inverse"><i class="fa fa-user-times"></i> Cancelled</label>');
        }else{
            modal.find('#rdv_status').html('<label class="badge badge-warning-inverse"><i class="fa fa-hourglass-start"></i> Pending</label>');
        }
        modal.find('#appointment_name').text(rdv_name)
        modal.find('#appointment_reason').text(rdv_details)
        modal.find('#rdv_date').text(rdv_date)
        modal.find('#rdv_time').text(rdv_time_start + ' - ' + rdv_time_end)
        modal.find('#rdv_time_start_input').val(rdv_time_start)
        modal.find('#rdv_time_end_input').val(rdv_time_end)
        modal.find('#rdv_id').val(rdv_id)
        modal.find('#rdv_id2').val(rdv_id)

    })

    var app_date = 0
    $('.target').on('change', function () {
        app_date = document.getElementById("rdvdate").value;
        AddAppointment(app_date);

    });

    function AddAppointment(date) {

        $.ajax({
            url: '/appointment/check-slot/' + date,
            type: 'GET',
            cache: false,
            success: function (array) {
                var options = '';
                $.each(array, function (key, value) {

                    if (value.available == "available") {
                        options = options + '<div class="col-sm-6 col-md-4 mb-2"><button class="btn btn-primary btn-block" data-toggle="modal" data-target="#RDVModalSubmit" data-rdv_date="' + date + '" data-rdv_time_start="' + value.start + '" data-rdv_time_end="' + value.end + '" >' + value.start + ' - ' + value.end + '</button></div>';
                    } else {
                        options = options + '<div class="col-sm-6 col-md-4 mb-2"><button class="btn btn-gray btn-block">' + value.start + ' - ' + value.end + '</button></div>';
                    }
                });


                var checkHtml = options;

                $(".myorders").html(checkHtml);

                $("#help-block").css("display", "none");

                if (!options) {
                    $("#help-block").css("display", "block");
                    $("#help-block").html("<img src='../img/rest.png'/> <br> <b>Sorry, I dont work on this day</b>");
                }

                $('#RDVModalSubmit').on('show.bs.modal', function (event) {

                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var rdv_date = button.data('rdv_date') // Extract info from data-* attributes
                    var rdv_time_start = button.data('rdv_time_start') // Extract info from data-* attributes
                    var rdv_time_end = button.data('rdv_time_end') // Extract info from data-* attributes
                    var selectedName = $("#appointment_name").val() // Extract info from data-* attributes
                    var selectedDetails = $("#appointment_reason").val() // Extract info from data-* attributes

                    var modal = $(this)

                    if (selectedName === "") {
                        modal.find('#appointment_name').html('<span class="text-danger"><b>Please provide your name before submitting</b></span>');
                    } else {
                        modal.find('#appointment_name').text(selectedName);
                    }

                    if (selectedDetails === ""){
                        modal.find('#appointment_reason').html('<span class="text-danger"><b>Please provide your reason before submitting</b></span>');
                    } else {
                        modal.find('#appointment_reason').text(selectedDetails);
                    }

                    modal.find('#rdv_date').text(rdv_date)
                    modal.find('#rdv_time').text(rdv_time_start + ' - ' + rdv_time_end)
                    modal.find('#rdv_time_start_input').val(rdv_time_start)
                    modal.find('#rdv_time_end_input').val(rdv_time_end)
                    modal.find('#rdv_date_input').val(rdv_date)
                    modal.find('#name_input').val(selectedName)
                    modal.find('#detail_input').val(selectedDetails)
                })

            },


            error: function () {
                $("#help-block").text("Sorry, An error has occurred");
            }
        }, "json");
    }

    $('.display-years').datepicker({
        autoclose: true,
        orientation: "bottom",
        startDate: new Date(),
        templates: {
            leftArrow: '<i class="fa fa-angle-left"></i>',
            rightArrow: '<i class="fa fa-angle-right"></i>'
        }
    });

})(jQuery); // End of use strict
