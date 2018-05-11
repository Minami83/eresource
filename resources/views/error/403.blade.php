@extends('layouts.master')

@section('title','Unauthorized Access')

@section('customstyle')
    <style>
        .bodyerror {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 500px;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
        }

        .container2 {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-family: 'Lato','Calibri light';
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>

@section('content')
    <div class="bodyerror">
        <div class="container2">
            <div class="content">
                <div class="title">Unautorized Access</div>
            </div>
        </div>
    </div>
@endsection()

