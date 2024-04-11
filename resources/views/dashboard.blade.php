<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <div class="py-12 container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 row">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-50 col mr-4">
                <div class="p-6 text-gray-900">
                    <a href="/application" class="btn btn-primary">申込一覧</a>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-50 col">
                <div class="p-6 text-gray-900">
                    <a href="/import-csv" class="btn btn-primary">インポート</a>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12 container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 row">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-50 col mr-4">
                <div class="p-6 text-gray-900">
                    <a href="/box" class="btn btn-primary">BOX更新</a>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-50 col">
<!--                <div class="p-6 text-gray-900">
                    <a href="/import-csv" class="btn btn-primary">インポート</a>
                </div>-->
            </div>
        </div>
    </div>
</x-app-layout>
