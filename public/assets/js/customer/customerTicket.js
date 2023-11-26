console.log("customerTicket.js is loading");

$(document).ready(function () {

    $('#tblCustomerTicket').DataTable({
        "scrollX": false,
        "order": [],
        "columns": [
            { "data": "ref_no" },
            { "data": "name" },
            { "data": "aprovestate" },
       
        ],
        columnDefs: [
            {
                width: 250,
                targets: 1
            },
            {
                width: 100,
                targets: 2
            }
        ],
    });

});



function create_ticket(){
    showModal();
    $('.modal-title').text('Add Ticket');
}


function showModal() {
    resetTicketModal();
    $('#modalCreateTicket').modal('toggle');
}


function resetTicketModal() {
    $('#customerTicketForm').trigger("reset");
    $('#btnAction').show();
    $('#btnAction').text('Submit');
}


function hideModal() {
    $('#modalCreateTicket').modal('hide');
}


function actionBtn() {

    var text = $('#btnAction').text();
    if (text == "Submit") {
        save();
    }
}


function save() {

    var form = $('#customerTicketForm').get(0);
    var data = new FormData(form);

    $.ajax({
        type: "POST",
        url: "/submit_ticket",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.status == "saved") {
                toastr.success('Ticket submitted successfully!','Submitted', {
                    timeOut: 1000,
                    preventDuplicates: true,
                    positionClass: 'toast-top-right',
                    // Redirect 
                    onHidden: function() {
                        // window.location.reload();
                    }
                });
                hideModal();
            } else {
                toastr.error('Ticket submitted incompleted!', 'Error');
            }

        },
        error: function (error) {
            toastr.error('something went wrong!', 'Error');
        },
        complete: function () {

        }

    });
}


function get_ticket_info() {

    var ref_no = $('#ref_no').val();

    $.ajax({
        type: "GET",
        url: "/check_ticket_info",
        data: { 
            ref_no:ref_no,
        },
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            
            if (response.ticket_data) {
            
                var dt = response.ticket_data;
                var data = [];
                // console.log(dt);
                var name = dt.customer_name;
                var refNo = dt.reference_number;
                var Approval = dt.status;
                

                if (Approval == 0) {
                    data.push({
                        "ref_no": refNo,
                        "name": name,
                        "aprovestate": '<span class="badge badge-pill badge-info"><i class="fa fa-clock mr-2" ></i> Pending </span>',  
                        
                    });
                }
                else if (Approval == 1) {
                    data.push({
                        "ref_no": refNo,
                        "name": name,
                        "aprovestate": '<span class="badge badge-pill badge-primary"><i class="fa fa-hourglass-half mr-2" ></i> In Progress</span>',
                        
                    });
                }
                else if (Approval == 2) {
                    data.push({
                        "ref_no": refNo,
                        "name": name,
                        "aprovestate": '<span class="badge badge-pill badge-success"><i class="fa fa-calendar-check mr-2" ></i> Resolved</span>',
                    });
                }

                var table = $('#tblCustomerTicket').DataTable();
                table.clear();
                table.rows.add(data).draw();

                $('#divCustomerTicket').show();

            } else if(response.ticket_data == null) {
                console.log('no data');
                $('#divCustomerTicket').hide();
                toastr.warning('No ticket data found for the provided reference number!', 'No Records Found');
            }else{
                console.log('something went wrong');
                $('#divCustomerTicket').hide();
                toastr.error('something went wrong!', 'Error');
            }

        },
        error: function (error) {
            console.log(error);
        },
        complete: function () {

        }

    });
}