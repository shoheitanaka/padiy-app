<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            CSVインポート
        </h2>
    </x-slot>
    <div class="mx-auto px-6">
        <div class="mt-4 p-8 bg-white w-full rouded-2xl">
            <form action="/import-csv" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file">
                <button type="submit" class="btn btn-primary">インポート</button>
            </form>
        </div>
        @if($error_msg)
        <div class="mt-4 p-8 bg-danger w-full rouded-2xl" style="color:#fff">{!! nl2br(e($error_msg)) !!}</div>
        @elseif($result_msg)
        <div class="mt-4 p-8 bg-success w-full rouded-2xl text-xl" style="color:#fff">{{$result_msg}}</div>
        @endif
    </div>
</x-app-layout>
