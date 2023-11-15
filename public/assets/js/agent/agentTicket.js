console.log("agentTicket.js is loading");

$(document).ready(function () {

    allTickets();

    $('#tblAgentTickets').DataTable({
        "scrollX": false,
        "order": [],
        "columns": [
            { "data": "ref_no" },
            { "data": "name" },
            { "data": "aprovestate" },
            { "data": "date_created" },
            { "data": "actions" }
       
        ],
        columnDefs: [
            {
                width: 350,
                targets: 0
            },
        ],
    });

});



function allTickets(){

    $.ajax({
        type: "GET",
        url: '/get_all_tickets',
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {
        },
        success: function (response) {
            console.log(response);

            if (response.datas) {

                var dt = response.datas;
                var data = [];
                    for (i = 0; i < dt.length; i++) {

                        var id = dt[i]['id'];
                        var ref_no = dt[i]['reference_number'];
                        var name = dt[i]['customer_name'];
                        var Approval = dt[i]['status'];
                        var date = dt[i]['created_at'];
                       

                        if (Approval == 0) {
                            data.push({
                                "ref_no": ref_no,
                                "name": name,
                                "aprovestate": '<span class="badge badge-pill badge-info"><i class="fa fa-clock mr-2" ></i> Pending </span>',  
                                "date_created": date,
                                "actions": '<a href="/view_ticket_details/' + id + '"><button type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button></a>',
                            });
                        }
                        else if (Approval == 1) {
                            data.push({
                                "ref_no": ref_no,
                                "name": name,
                                "aprovestate": '<span class="badge badge-pill badge-primary"><i class="fa fa-edit mr-2" ></i> In Progress</span>',
                                "date_created": date,
                                "actions": '<a href="/view_ticket_details/' + id + '"><button type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button></a>',
                            });
                        }
                        else if (Approval == 2) {
                            data.push({
                                "ref_no": ref_no,
                                "name": name,
                                "aprovestate": '<span class="badge badge-pill badge-success"><i class="fa fa-calendar-check mr-2" ></i> Resolved</span>',
                                "date_created": date,
                                "actions": '<a href="/view_ticket_details/' + id + '"><button type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button></a>',
                            });
                        }

                    }
                var table = $('#tblAgentTickets').DataTable();
                table.clear();
                table.rows.add(data).draw(); 

            } else {
                toastr.error('something went wrong!', 'Error');
            }

        },
        error: function (error) {
            console.log(error);
            toastr.error('something went wrong!', 'Error');
        },
        complete: function () {

        }

    });
}

