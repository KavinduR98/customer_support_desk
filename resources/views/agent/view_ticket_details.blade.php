@extends('layout')
@include('header')
@section('content')

<head>
    <style>
        #txtDescription{
            background: rgb(239, 239, 239);
            /* height: 150px; */
            max-height: 200px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-6"><h6>Ticket No : {{ $data->reference_number }}</h6></div>
                        <div class="col-md-6 col-sm-6"><h6>Created Date : {{ $data->created_at }}</h6></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6"><h6>Email : {{ $data->email }}</h6></div>
                        <div class="col-md-6 col-sm-6"><h6>Phone Number : {{ $data->phone_number }}</h6></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" id="hiddenTicketId">
                        <p id="txtDescription">{{ $data->problem }}</p>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-10 p-0">
                            <label for="reply">Reply Message :</label>
                            <textarea class="form-control mt-3"  name="txtReply" id="txtReply" cols="30" rows="10" onchange="save_reply(event, {{ $data->id }});"></textarea>
                        </div>
                        <div class="col-md-2">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-mdb-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="changeStatusBtn">
                                    <li><a class="dropdown-item" id="pending" href="#">Pending</a></li>
                                    <li><a class="dropdown-item" id="inProgress" href="#">In Progress</a></li>
                                    <li><a class="dropdown-item" id="resolved" href="#">Resolved</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>



<script src="{{ asset('assets/js/agent/ticketDetails.js') }}"></script>