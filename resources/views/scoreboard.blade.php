<x-app-layout>
    <script src="{{ mix('js/scoreboard.js') }}" defer></script>
    <script>window.games = {!! $games !!}</script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div id="scoreboard"></div>
                </div>
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2"></div>
            </div>
        </div>
    </div>
</x-app-layout>
