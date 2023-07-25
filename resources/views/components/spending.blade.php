<div class="flex justify-end">
    <button class="bg-gray-600 text-white p-2 rounded-lg" id="downloadExcel">Download Excel</button>
</div>
<table class="table w-full lg:w-1/2 text-gray-400 border-separate space-y-6 text-sm">
    <thead class="bg-gray-600 text-white">
        <tr>
            <th class="p-3">Employee</th>
            <th class="p-3 text-left">Departments</th>
            <th class="p-3 text-left">Date</th>
            <th class="p-3 text-left">Value</th>
            <th class="p-3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($spendings as $idx => $spd)
            <tr class="bg-white">
                <td class="p-3">
                    <div class="flex items-center px-12 space-x-6">
                        <img class="rounded-full h-12 w-12 border-2 object-cover"
                            src="https://www.gotosovie.com/wp-content/uploads/woocommerce-placeholder.png"
                            alt="unsplash image">
                        <div class="ml-3">
                            <div class="text-gray-500">{{ $spd->employees->name }}</div>
                        </div>
                    </div>
                </td>
                <td class="p-3">
                    {{ $spd->employees->departments->name }}
                </td>
                <td class="p-3">
                    {{ $spd->date }}
                </td>
                <td class="p-3">
                    {{ number_format($spd->value, 0, ',', '.') }}
                </td>
                <td class="p-3 ">
                    <a id="{{ $spd }}"
                        class="view-spd hover:cursor-pointer text-gray-400 hover:text-gray-500 mr-2">
                        <i class="material-icons-outlined text-base">visibility</i>
                    </a>
                    <a id="{{ $spd }}"
                        class="edit-spd hover:cursor-pointer openModalBtn text-gray-400 hover:text-gray-500  mx-2">
                        <i class="material-icons-outlined text-base">edit</i>
                    </a>
                    <a id="{{ $spd }}"
                        class="delete-spd hover:cursor-pointer text-gray-400 hover:text-gray-500  ml-2">
                        <i class="material-icons-round text-base">delete_outline</i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@include('components.modal.editSpending')

<style>
    tr td:nth-child(n+5),
    tr th:nth-child(n+5) {
        border-radius: 0 .625rem .625rem 0;
    }
</style>

<script>
    $(document).ready(function() {
        $('.openModalBtn').click(function() {
            $('#myModal').removeClass('hidden');
        });

        $('#closeModalBtn').click(function() {
            $('#myModal').addClass('hidden');
        });

        $('#downloadExcel').on('click', function() {
            const url = '{{ route('getExportSpending') }}'
            window.open(url, '_blank');
        })

        $('.delete-spd').on('click', function() {
            if ("{{ auth()->check() }}") {
                if ("{{ auth()->user()->role }}" == 'admin') {
                    const spend = JSON.parse($(this).attr('id'));
                    const validate = confirm('Are you sure you want to delete this spend ' + spend
                        .employees.name + ' ?')
                    if (validate) {
                        $.ajax({
                            url: '/delete-spending/' + spend.id,
                            method: 'DELETE',
                            success: function(response) {
                                alert(response.message);
                                window.location.reload();
                            },
                            error: function(xhr, status, error) {
                                alert('Error deleting spending: ' + xhr.responseText);
                            }
                        })
                    }
                } else {
                    alert("You are not allowed to delete")
                }
            }
        })

        $('.edit-spd').on('click', function() {
            if ("{{ auth()->check() }}") {
                if ("{{ auth()->user()->role }}" == 'admin') {
                    const spend = JSON.parse($(this).attr('id'));
                    $('#spendId').val(spend.id);
                    $('#editEmpId').val(spend.employeeId);
                    $('#editDepartmentId').val(spend.employees.departmentId);
                    $('#dateSpend').val(moment(spend.date, 'D-F-Y').format(
                        'YYYY-MM-DD'));
                    $('#valueSpend').val(spend.value);
                } else {
                    alert("You are not allowed to delete")
                }
            }
        })

        $('#submitEdit').click(function() {
            const bodyReq = $('#editForm').serialize()
            const spendId = $('#spendId').val()
            $.ajax({
                url: '/update-spending/' + spendId,
                method: 'POST',
                data: bodyReq,
                success: function(res) {
                    alert(res.message);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    alert('Error updating spending: ' + xhr.responseText);
                }
            })
            $('#myModal').addClass('hidden');
        });
    })
</script>
