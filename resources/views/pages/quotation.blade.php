<!DOCTYPE html>
<html lang="en">

<head>
    @livewireStyles
    <title>
        Print Preview
    </title>
    <style>
        html {
            margin: 0px
        }

        .container {
            padding-left: 10px;
            padding-right: 20px;
        }

        img {
            margin-top: -10px;
            width: 250px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h2 {
            margin: 5px !important;
            font-family: Arial, Helvetica, sans-serif;
        }

        h4 {
            margin: 5px !important;
            font-family: Arial, Helvetica, sans-serif;
        }

        h5 {
            margin: 5px !important;
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
        }

        h6 {
            margin: 5px !important;
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
        }

        .fw-bold {
            font-weight: bold;
            color: #212529;
            font-size: 14px;
        }

        .print-details {
            text-decoration: underline;
            text-transform: uppercase;
            margin-left: 5px;
            font-size: 14px;
        }

        .text-underline {
            text-decoration: underline;
        }

        .title {
            text-transform: uppercase !important;
            font-weight: 700 !important;
            font-size: 1.125rem;
            text-align: center !important;
            width: 100%;
        }

        .column3 {
            float: left;
            width: 33.33%;
            font-size: 13px;
        }

        .column2 {

            float: left;
            width: 50.0%;
            font-size: 13px;
        }

        .column4 {
            float: left;
            width: 25.0%;
            font-size: 13px;
        }

        .column6 {
            float: left;
            width: 25.0%;
            font-size: 13px;
        }

        .column5 {
            float: left;
            width: 20.0%;
            font-size: 13px;
        }

        .column10 {
            float: left;
            width: 10.0%;
            font-size: 13px;
        }

        .column40 {
            float: left;
            width: 40.0%;
            font-size: 13px;
        }

        .column70 {
            float: left;
            width: 70.0%;
            font-size: 13px;
        }


        .column1 {
            float: left;
            width: 100.0%;
            font-size: 13px;
        }

        .footer-column {
            font-size: 13px;
            float: left;
            width: 50%;
            padding: 10px;
        }

        .row:after {

            content: "";
            display: table;
            clear: both;
        }

        .table-dark {
            background: #212529;
            color: #fff;
        }

        table {
            border-spacing: none !important;
            border-collapse: collapse;
            width: 1200px;
        }

        th {
            font-size: 14px;
            padding: 10px;
        }

        td {
            padding: 5px;
            border: 1px solid;
            font-size: 12px;
        }

        p {
            margin: 5px !important;
            width: 90%;
            font-size: 9px;
        }

        .footer {
            column-count: 2;
        }

        .footer-text {
            display: flex;
            margin-bottom: 10px;
        }

        .footer-text p {
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body>
    @livewire('quotation-show', ['id' => $id])
    @livewireScripts

</body>

</html>
