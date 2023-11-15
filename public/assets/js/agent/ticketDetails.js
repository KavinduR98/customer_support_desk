console.log("ticketDetails.js is loading");


$(document).ready(function () {

    viewReply();

    $('#pending').on('click', function () {

        var id =$('#hiddenTicketId').val();
        pending(id);
    });

    $('#inProgress').on('click', function () {

        var id =$('#hiddenTicketId').val();
        inProgress(id);
    });

    $('#resolved').on('click', function () {

        var id =$('#hiddenTicketId').val();
        resolved(id);
    });

});



function pending(id) {

    $.ajax({
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/pending/save/' + id,

        success: function (response) {
            console.log(response)
            if (response.status == "success") {
                toastr.success('Pending mode!', 'Success');
                location.reload();
            }
        }, error: function (data) {
            toastr.error('something went wrong!', 'Error');
        }
    });
}


function inProgress(id) {

    $.ajax({
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/inProgress/save/' + id,

        success: function (response) {
            console.log(response)
            if (response.status == "success") {
                toastr.success('In progress mode!', 'Success');
                location.reload();
            }
        }, error: function (data) {
            toastr.error('something went wrong!', 'Error');
        }
    });
}



function resolved(id) {

    $.ajax({
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/resolved/save/' + id,

        success: function (response) {
            console.log(response)
            if (response.status == "success") {
                toastr.success('Resolved mode!', 'Success');
                location.reload();
            }
        }, error: function (data) {
            toastr.error('something went wrong!', 'Error');
        }
    });
}



function viewReply(){

    var currentURL = window.location.href;
    var urlParts = currentURL.split('/');
    var ticketId = urlParts[urlParts.length - 1];
    console.log(ticketId);

    $('#hiddenTicketId').val(ticketId);

    $.ajax({
        url: '/get_reply/' + ticketId,
        type: 'GET',

        success: function (response) {
            console.log(response);

            if (response.status == "success") {
                $('#txtReply').val(response.data.reply); 

                var status = response.data.status;

                if (status == 0) {
                    $('#dropdownMenuButton').text("Pending");
                } else if (status == 1) {
                    $('#dropdownMenuButton').text("In Progress");
                } else if (status == 2) {
                    $('#dropdownMenuButton').text("Resolved");
                } else {
                    toastr.error('Invalid status!', 'Error');
                }

            } else {
                toastr.error('Something went wrong!', 'Error');
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}


function save_reply(event,id){

    var reply = event.target.value;

    $.ajax({
        url: '/save_reply/' + id,
        type: 'POST',
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'reply': reply
        },
        success: function (response) {
            console.log(response);

            if (response.status == "saved") {
                toastr.success('Reply has been saved!', 'Success');

            } else {
                toastr.error('Reply has not been saved!', 'Error');
            }
        },
        error: function (data) {
            console.log(data);
        }
    });

}