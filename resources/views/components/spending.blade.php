<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Employee</th>
            <th>Departments</th>
            <th>Date</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($spendings as $idx => $spd)
            <tr>
                <td>{{ $idx + 1 }}</td>
                <td>{{ $spd->employees->name }}</td>
                <td>{{ $spd->employees->departments->name }}</td>
                <td>{{ $spd->date }}</td>
                <td>{{ $spd->value }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
