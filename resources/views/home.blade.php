@extends('layout')

@section('content')
    <div class="m-6 p-6 rounded-xl space-y-4 bg-gray-100">

        <div class="flex items-center space-x-4">
            <img class="w-20 rounded-full border-2"
                src="https://www.gotosovie.com/wp-content/uploads/woocommerce-placeholder.png" alt="">
            <div class="space-y-2">
                @if (auth()->check())
                    <div>{{ auth()->user()->email }}</div>
                @endif
                <button id="doLogout"
                    class="p-2 rounded-md bg-red-400 text-white hover:bg-red-500 transition ease-in-out delay-100 ">Logout</button>
            </div>
        </div>

        <div class="flex inline-flex border-b border-gray-300 space-x-4">
            <div id="getEmp"
                class="buttonTab p-2 hover:cursor-pointer hover:bg-gray-400 hover:rounded-t-lg ease-in-out delay-100">
                Employee
            </div>
            <div id="getDept"
                class="buttonTab p-2 hover:cursor-pointer hover:bg-gray-400 hover:rounded-t-lg ease-in-out delay-100">
                Department
            </div>
            <div id="getSpend"
                class="buttonTab p-2 hover:cursor-pointer hover:bg-gray-400 hover:rounded-t-lg ease-in-out delay-100">
                Spending
            </div>
        </div>

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
            $('#getEmp').addClass('bg-gray-300 rounded-t-lg')
            $('.buttonTab').on('click', function() {
                $('.buttonTab').removeClass('bg-gray-300 rounded-t-lg');
                $(this).addClass('bg-gray-300 rounded-t-lg');
            });
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

        $('#doLogout').click(function() {
            const logout = confirm("Are you sure you want to log out ?")
            if (logout) {
                $.ajax({
                    url: '{{ route('logout') }}',
                    method: 'GET',
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(error) {
                        console.error(error);
                    }
                })
            }
        })
    </script>
@endsection
