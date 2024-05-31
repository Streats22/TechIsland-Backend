<x-filament-widgets::widget>
    <x-filament::section>
        <!-- Check for session message and display as an alert -->
        @if(session('success'))
            <div class="custom-alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('assign-codenames') }}" method="POST">
            @csrf
            <button class="fi-btn " type="submit">Verdeel Codenames</button>
        </form>
        <form action="{{ route('clear-codenames') }}" method="POST">
            @csrf
            <button class="fi-btn "  type="submit">Verwijder Codenames</button>
        </form>
    </x-filament::section>
</x-filament-widgets::widget>
<style>
    .custom-alert {
        position: fixed; /* Fixed position to stay in place during scroll */
        top: 20px; /* 20px from the top */
        left: 50%; /* Center horizontally */
        transform: translateX(-50%); /* Center align */
        z-index: 10000; /* High z-index to ensure it's above other content */
        background-color: #04AA6D; /* Green background for success message */
        color: white; /* White text color */
        padding: 10px 20px; /* Padding for aesthetics */
        border-radius: 5px; /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* Subtle shadow for floating effect */
    }
</style>
