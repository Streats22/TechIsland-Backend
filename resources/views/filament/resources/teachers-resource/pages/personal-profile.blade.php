<x-filament::page>
    <x-filament-panels::page>
        <x-slot name="header">
            My Profile
        </x-slot>

        <x-filament::grid>
            <x-filament::card>
                <div class="text-xl font-bold mb-2">Personal Information</div>
                <p><strong>Name:</strong> {{ $this->teacher->first_name }}</p>
                <p><strong>Email:</strong> {{ $this->teacher->email }}</p>
                <!-- Add other personal details here -->
            </x-filament::card>

            <x-filament::card>
                <div class="text-xl font-bold mb-2">My Students</div>
                <div class="overflow-x-auto">
                    <x-filament::table>
                        <x-slot name="header">
                            <tr>
                                <th>Student Number</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <!-- Add other necessary headers here -->
                            </tr>
                        </x-slot>
                        @foreach($this->students as $student)
                            <tr>
                                <td>{{ $student->student_number }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->last_name }}</td>
                                <!-- Add other data fields here -->
                            </tr>
                        @endforeach
                    </x-filament::table>
                </div>
                @if($this->students->isEmpty())
                    <div class="p-4 text-center text-sm text-gray-500">
                        No students assigned yet.
                    </div>
                @endif
            </x-filament::card>
        </x-filament::grid>
    </x-filament-panels::page>
</x-filament::page>
