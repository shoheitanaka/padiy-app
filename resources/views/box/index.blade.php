<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            BOX
        </h2>
    </x-slot>
    @if($result_msg)
    <div class="mt-4 p-8 bg-success w-full rouded-2xl text-xl" style="color:#000">{{$result_msg}}</div>
    @endif

</x-app-layout>
