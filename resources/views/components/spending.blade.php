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
    tr td:nth-child(n+5),
    tr th:nth-child(n+5) {
        border-radius: 0 .625rem .625rem 0;
    }
</style>
