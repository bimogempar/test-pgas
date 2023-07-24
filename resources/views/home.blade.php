@extends('layout')

@section('content')
    this home view
    <a href="{{ route('logout') }}">Logout!</a>

    <div>
        <div id="getEmp">data employee</div>
        <div id="getDept">data department</div>
        <div id="getSpend">data spending</div>

        <div id="table">

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('getEmployee') }}',
                method: 'GET',
                success: function(response) {
                    $('#table').html(response);
                },
                error: function(error) {
                    console.error(error);
                }
            })
        })

        $('#getEmp').click(function() {
            $.ajax({
                url: '{{ route('getEmployee') }}',
                method: 'GET',
                success: function(response) {
                    $('#table').html(response);
                },
                error: function(error) {
                    console.error(error);
                }
            })
        })

        $('#getDept').click(function() {
            $.ajax({
                url: '{{ route('getDepartment') }}',
                method: 'GET',
                success: function(response) {
                    $('#table').html(response);
                },
                error: function(error) {
                    console.error(error);
                }
            })
        })

        $('#getSpend').click(function() {
            $.ajax({
                url: '{{ route('getSpending') }}',
                method: 'GET',
                success: function(response) {
                    $('#table').html(response);
                },
                error: function(error) {
                    console.error(error);
                }
            })
        })
    </script>
@endsection
