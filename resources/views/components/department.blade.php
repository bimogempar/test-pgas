<table class="table w-full lg:w-1/2 text-gray-400 border-separate space-y-6 text-sm">
    <thead class="bg-gray-600 text-white">
        <tr>
            <th class="p-3">Id</th>
            <th class="p-3 text-left">Department</th>
            <th class="p-3 text-left">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departments as $idx => $dept)
            <tr class="bg-white">
                <td class="p-3 text-gray-500 text-center">
                    {{ $dept->id }}
                </td>
                <td class="p-3">
                    {{ $dept->name }}
                </td>
                <td class="p-3 ">
                    <a id="{{ $dept }}"
                        class="edit-dept openModalBtn hover:cursor-pointer text-gray-400 hover:text-gray-500  mx-2">
                        <i class="material-icons-outlined text-base">edit</i>
                    </a>
                    <a id="{{ $dept }}"
                        class="delete-dept hover:cursor-pointer text-gray-400 hover:text-gray-500  ml-2">
                        <i class="material-icons-round text-base">delete_outline</i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@include('components.modal.editDepartment')

<style>
    tr td:nth-child(n+3),
    tr th:nth-child(n+3) {
        border-radius: 0 .625rem .625rem 0;
    }
</style>

<script>
    $(document).ready(function() {

        $('.delete-dept').on('click', function() {
            if ("{{ auth()->check() }}") {
                if ("{{ auth()->user()->role }}" == 'admin') {
                    const dept = JSON.parse($(this).attr('id'));
                    confirm('Are you sure you want to delete this department ' + dept.name + ' ?')
                    if (confirm) {
                        $.ajax({
                            url: '/delete-dept/' + dept.id,
                            method: 'DELETE',
                            success: function(response) {
                                alert(response.message);
                                window.location.reload();
                            },
                            error: function(xhr, status, error) {
                                alert('Error deleting department: ' + xhr.responseText);
                            }
                        })
                    }
                } else {
                    alert("You are not allowed to delete")
                }
            }
        })

        $('.edit-dept').on('click', function() {
            if ("{{ auth()->check() }}") {
                if ("{{ auth()->user()->role }}" == 'admin') {
                    const dept = JSON.parse($(this).attr('id'));
                    $('#deptId').val(dept.id);
                    $('#editNameDept').val(dept.name);
                } else {
                    alert("You are not allowed to delete")
                }
            }
        })

        $('.openModalBtn').click(function() {
            $('#myModal').removeClass('hidden');
        });

        $('#closeModalBtn').click(function() {
            $('#myModal').addClass('hidden');
        });

        $('#submitEdit').click(function() {
            const bodyReq = $('#editForm').serialize()
            const deptId = $('#deptId').val()
            $.ajax({
                url: '/update-dept/' + deptId,
                method: 'POST',
                data: bodyReq,
                success: function(res) {
                    alert(res.message);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    alert('Error updating department: ' + xhr.responseText);
                }
            })
            $('#myModal').addClass('hidden');
        });
    });
</script>
