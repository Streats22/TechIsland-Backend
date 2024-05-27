<x-filament::page>
    <x-slot name="header">
        My Profile - {{ optional($teacher)->first_name }} {{ optional($teacher)->last_name }}
    </x-slot>

    <x-filament::grid>
        <x-filament::card>
            <div class="text-xl font-bold mb-2">Personal Information</div>
            <p><strong>Name:</strong> {{ optional($teacher)->first_name }} {{ optional($teacher)->last_name }}</p>
            <p><strong>Email:</strong> {{ optional($teacher)->email }}</p>
        </x-filament::card>

        <x-filament::card>
            <div class="text-xl font-bold mb-2">My Students</div>
            @if($students->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Number</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($students as $student)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $student->student_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $student->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-4 text-center text-sm text-gray-500">No students assigned yet.</div>
            @endif
        </x-filament::card>
    </x-filament::grid>
</x-filament::page>
