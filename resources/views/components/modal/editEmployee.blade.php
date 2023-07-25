<div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="myModal">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="bg-white p-4 rounded-lg shadow-lg z-10 w-1/2">
        <!-- Modal content here -->
        <h2 class="text-xl font-bold mb-4">Modal Title</h2>
        <div>
            <form id="editForm" class="flex flex-col gap-2">
                <div class="flex flex-col gap-2">
                    <label for="name">Name</label>
                    <input type="text" id="editName" name="name" class="w-1/2 p-2 border-2 rounded-lg">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="department">Department:</label>
                    <select class="p-2 w-1/2 border-2 rounded-lg" name="departmentId" id="editDepartmentId" required>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
        <div class="flex justify-end items-center space-x-2">
            <button class="mt-4 px-4 py-2 bg-red-400 text-white rounded-lg" id="closeModalBtn">Cancel</button>
            <button class="mt-4 px-4 py-2 bg-blue-400 text-white rounded-lg" id="submitEdit">Save</button>
        </div>
    </div>
</div>
