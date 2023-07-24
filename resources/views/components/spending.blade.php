<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Employee</th>
            <th>Date</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($spendings as $spd)
            <tr>
                <td>{{ $spd->id }}</td>
                <td>{{ $spd->employees->name }}</td>
                <td>{{ $spd->date }}</td>
                <td>{{ $spd->value }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
