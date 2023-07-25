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
                <td class="p-3 text-gray-500">
                    {{ $dept->id }}
                </td>
                <td class="p-3">
                    {{ $dept->name }}
                </td>
                <td class="p-3 ">
                    <a href="#" class="text-gray-400 hover:text-gray-500 mr-2">
                        <i class="material-icons-outlined text-base">visibility</i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500  mx-2">
                        <i class="material-icons-outlined text-base">edit</i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500  ml-2">
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
