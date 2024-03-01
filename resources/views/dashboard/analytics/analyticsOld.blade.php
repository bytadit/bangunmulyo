<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('/js/chart.umd.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('/datatables/1.10.24/js/dataTables.bootstrap4.min.js') }}"></script>

    <title>Analytics Tamu</title>
</head>

<body class="">
    @include("navbar")

    <div class="container h-100 d-flex align-items-center flex-column">

    <h1 class="text-center my-3">Data Analytics Buku Tamu</h1>

    <div class="container-md row my-3 d-flex flex-row justify-content-between align-items-center">
        <div class="mx-2 col-3">
            <label for="start">Start Date</label>
            <input type="date" class="form-control" id="start">
        </div>

        <div class="mx-2 col-3">
            <label for="end">End Date</label>
            <input type="date" class="form-control" id="end">
        </div>

        <div class="mx-2 col-3">
            <label for="end">Group By</label>
            <select class="form-control w-100" id="type">
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
            </select>
        </div>

        <div class="col-2 h-full d-flex align-items-end">
            <button class="btn btn-primary" style="height:40px; width: 100px" id="btn">Analytics</button>
        </div>
    </div>

    <div class="spinner-border text-primary loading-state d-none" role="status">
        <span class="sr-only">Loading...</span>
    </div>

    <div class="chart my-5">
        <canvas id="barChart" style="width: 90vw; max-height: 500px; min-height: 250px; "></canvas>
    </div>
    </div>


</body>

<script type="text/javascript" src="{{ asset('/js/analytics/barChart.js') }}"></script>

<script>
    $(function() {
        $('#btn').click(function() {
            $('.loading-state').removeClass('d-none');

            $('#barChart').remove();
            $('.chart').append(
                '<canvas id="barChart" style="width: 90vw; max-height: 500px; min-height: 250px; background-color:#FFF"></canvas>'
            );

            const start = $('#start').val();
            const end = $('#end').val();
            const type = $('#type').val();
            const csrf = "{{ csrf_token() }}";

            const ctx = document.getElementById('barChart').getContext('2d');

            barChart(csrf, {
                    start: start,
                    end: end,
                    type: type
                },
                ctx
            );
        });
    });
</script>

</html>
