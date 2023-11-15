@extends('layout')
@include('header')
@section('content')

<head>
    <style>
    .pending-ticket {
        background-color: #ffeeba; /* Adjust the color as per your preference */
    }
    </style>
</head>

<body>
    <div class="row m-2 mt-5">
        <div class="col-md-12 col-sm-12">
            <table class="table table-striped" id="tblAgentTickets" >
                <thead>
                    <tr>
                        <th>Ref No#</th>
                        <th>Customer Name</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</body>






<script src="{{ asset('assets/js/agent/agentTicket.js') }}"></script>