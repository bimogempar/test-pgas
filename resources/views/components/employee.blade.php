<div class="flex space-x-4">
    <select class="p-2 border-2 rounded-xl" name="departmentId" id="departmentId">
        <option value="">All Departments</option>
        @foreach ($departments as $department)
            <option value="{{ $department->id }}" @if ($department->id == $deptId) selected @endif>
                {{ $department->name }}
            </option>
        @endforeach
    </select>
    <div class="flex space-x-4">
        <input class="p-2 border-2 rounded-xl w-full" type="text" id="searchInput" placeholder="Search..."
            value="{{ $search }}">
        <button class="p-2 border-2 rounded-xl bg-gray-600 text-white hover:bg-gray-400" type="button"
            id="searchButton">Search</button>
    </div>
</div>

<table class="table w-full lg:w-1/2 text-gray-400 border-separate space-y-6 text-sm">
    <thead class="bg-gray-600 text-white">
        <tr>
            <th class="p-3">Name</th>
            <th class="p-3 text-left">Department</th>
            <th class="p-3 text-left">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $idx => $emp)
            <tr class="bg-white">
                <td class="p-3">
                    <div class="flex items-center px-12 space-x-6">
                        <img class="rounded-full h-12 w-12 border-2 object-cover"
                            src="https://www.gotosovie.com/wp-content/uploads/woocommerce-placeholder.png"
                            alt="unsplash image">
                        <div class="ml-3">
                            <div class="text-gray-500">{{ $emp->name }}</div>
                        </div>
                    </div>
                </td>
                <td class="p-3">
                    {{ $emp->departments->name }}
                </td>
                <td class="p-3">
                    <a href="#" id="{{ $emp->id }}" class="view-emp text-gray-400 hover:text-gray-500 mr-2">
                        <i class="material-icons-outlined text-base">visibility</i>
                    </a>
                    <a href="#" id="{{ $emp->id }}" class="edit-emp text-gray-400 hover:text-gray-500  mx-2">
                        <i class="material-icons-outlined text-base">edit</i>
                    </a>
                    <a href="#" id="{{ $emp->id }}"
                        class="delete-emp text-gray-400 hover:text-gray-500  ml-2">
                        <i class="material-icons-round text-base">delete_outline</i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<style>
    tr td:nth-child(n+3),
    tr th:nth-child(n+3) {
        border-radius: 0 .625rem .625rem 0;
    }
</style>

<script>
    $(document).ready(function() {
        $('#departmentId').on('change', function() {
            doSearch();
        })

        $('#searchButton').on('click', function() {
            doSearch();
        });

        function doSearch() {
            var searchQuery = $('#searchInput').val();
            var selectedDept = $('#departmentId').val();
            $.ajax({
                url: '{{ route('getEmployee') }}',
                type: 'GET',
                data: {
                    ...(selectedDept.length > 0 && {
                        dept_id: selectedDept
                    }),
                    ...(searchQuery.length > 0 && {
                        search: searchQuery
                    })
                },
                success: function(res) {
                    $('#table').html(res)
                }
            })
        }

        $('.delete-emp').on('click', function() {
            if ("{{ auth()->check() }}") {
                if ("{{ auth()->user()->role }}" == 'admin') {
                    const id = $(this).attr('id');
                    const validConfirm = confirm('Are you sure you want to delete')
                    if (validConfirm) {
                        $.ajax({
                            url: '/delete-emp/' + id,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                alert(response.message);
                                window.location.reload();
                            },
                            error: function(xhr, status, error) {
                                alert('Error deleting employee: ' + xhr.responseText);
                            }
                        })
                    }
                } else {
                    alert("You are not allowed to delete")
                }
            }
        })
    })
</script>
