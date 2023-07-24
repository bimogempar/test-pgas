<select name="departmentId" id="departmentId">
    <option value="">All Departments</option>
    @foreach ($departments as $department)
        <option value="{{ $department->id }}" @if ($department->id == $deptId) selected @endif>{{ $department->name }}
        </option>
    @endforeach
</select>

<input type="text" id="searchInput" placeholder="" value="{{ $search }}">
<button type="button" id="searchButton">Search</button>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Department</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $emp)
            <tr>
                <td>{{ $emp->id }}</td>
                <td>{{ $emp->name }}</td>
                <td>{{ $emp->departments->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

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
    })
</script>
