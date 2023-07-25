<div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="myModal">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="bg-white p-4 rounded-lg shadow-lg z-10 w-1/2">
        <!-- Modal content here -->
        <h2 class="text-xl font-bold mb-4">Edit Spending</h2>
        <div>
            <form id="editForm" class="flex flex-col gap-2">
                <input type="hidden" id="spendId" name="spendId" value="">
                <div class="flex flex-col gap-2">
                    <label for="empId">Name</label>
                    <select class="p-2 w-1/2 border-2 rounded-lg" name="empId" id="editEmpId" required>
                        @foreach ($employees as $emp)
                            <option value="{{ $emp->id }}">
                                {{ $emp->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="department">Department</label>
                    <select class="p-2 w-1/2 border-2 rounded-lg" name="empId" id="editDepartmentId" required>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="dateSpend">Date</label>
                    <input type="date" id="dateSpend" name="dateSpend" class="p-2 w-1/2 border-2 rounded-lg"
                        required>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="valueSpend">Value</label>
                    <input type="number" name="valueSpend" id="valueSpend" class="p-2 w-1/2 border-2 rounded-lg"
                        required>
                </div>
            </form>
        </div>
        <div class="flex justify-end items-center space-x-2">
            <button class="mt-4 px-4 py-2 bg-red-400 text-white rounded-lg" id="closeModalBtn">Cancel</button>
            <button class="mt-4 px-4 py-2 bg-blue-400 text-white rounded-lg" id="submitEdit">Save</button>
        </div>
    </div>
</div>

<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0;
        /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
        -moz-appearance: textfield;
        /* Firefox */
    }
</style>
