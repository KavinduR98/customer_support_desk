@extends('layout')
@include('header')
@section('content')

<head>
    <style>
        .card{
            height: 75vh;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-10 col-md-10 col-sm-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form method="POST" id="ticketRefNoForm">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label >Enter Reference No: </label>  
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                        <input type="text" class="form-control" name="ref_no" id="ref_no">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-10 col-md-10 col-sm-10"></div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <button class="btn btn-primary" type="button" id="checkBtn" style="float: right;" onclick="get_ticket_info();">Check</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row mt-5" id="divCustomerTicket">
                            <div class="table-responsive">
                                <table class="table table-striped" id="tblCustomerTicket" >
                                    <thead>
                                        <tr>
                                            <th>Ref No#</th>
                                            <th>Customer Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <button class="btn btn-primary" type="button" onclick="create_ticket();" style="float: right;">Submit a ticket</button>
            </div>
        </div>
    </div>
</body>

{{-- Ticket modal --}}
<div class="modal fade" id="modalCreateTicket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="reason_header"></h5>
                <button type="button" onclick="hideModal();" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="customerTicketForm" method="POST">
                    @csrf
                    <div class="col-md-12 mb-3">
                        <label class="col-form-label mb-0">Customer Name</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="col-form-label mb-0">Problem Description</label>
                        <textarea type="text" name="customer_problem" id="customer_problem" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="col-form-label mb-0">Email</label>
                        <input type="email" name="customer_email" id="customer_email" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="col-form-label mb-0">Phone</label>
                        <input type="number" name="customer_phone" id="customer_phone" class="form-control" required>
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close" onclick="hideModal()">Close</button>
                        &nbsp;&nbsp;
                        <button type="button" id="btnAction" class="btn btn-primary" onclick="actionBtn(event)">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- /Ticket modal --}}


<script src="{{ asset('assets/js/customer/customerTicket.js') }}"></script>