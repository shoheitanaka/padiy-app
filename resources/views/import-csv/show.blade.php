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
        {{-- エラーメッセージ表示 --}}
        @if($error_msg)
        <div class="mt-4 p-8 bg-danger w-full rouded-2xl" style="color:#fff">{!! nl2br(e($error_msg)) !!}</div>
        @endif

        {{-- 結果メッセージ表示 --}}
        @if($result_msg)
        <div class="mt-4 p-8 bg-success w-full rouded-2xl text-xl" style="color:#fff">{{$result_msg}}</div>
        @endif

        {{-- API送信成功リスト --}}
        @if(!empty($api_success_list) && count($api_success_list) > 0)
        <div class="mt-4 p-6 bg-white w-full rounded-2xl border-l-4 border-green-500">
            <h3 class="text-lg font-semibold text-green-700 mb-4">
                <i class="fas fa-check-circle mr-2"></i>API送信成功 ({{ count($api_success_list) }}件)
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-green-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-green-700">アプリケーションID</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-green-700">送信先URL</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-green-700">ステータス</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-green-100">
                        @foreach($api_success_list as $success)
                        <tr class="hover:bg-green-50">
                            <td class="px-4 py-2 text-sm text-gray-800 font-mono">{{ $success['application_id'] }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600 break-all">{{ $success['site_url'] }}</td>
                            <td class="px-4 py-2 text-sm">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $success['status'] }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        {{-- API送信失敗リスト --}}
        @if(!empty($api_error_list) && count($api_error_list) > 0)
        <div class="mt-4 p-6 bg-white w-full rounded-2xl border-l-4 border-red-500">
            <h3 class="text-lg font-semibold text-red-700 mb-4">
                <i class="fas fa-exclamation-triangle mr-2"></i>API送信失敗 ({{ count($api_error_list) }}件)
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-red-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-red-700">アプリケーションID</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-red-700">送信先URL</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-red-700">エラー内容</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-red-100">
                        @foreach($api_error_list as $error)
                        <tr class="hover:bg-red-50">
                            <td class="px-4 py-2 text-sm text-gray-800 font-mono">{{ $error['application_id'] }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600 break-all">
                                {{ isset($error['site_url']) ? $error['site_url'] : '-' }}
                            </td>
                            <td class="px-4 py-2 text-sm text-red-600">
                                <div class="max-w-xs break-words">{{ $error['error'] }}</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        {{-- サマリー情報（両方のリストがある場合） --}}
        @if((!empty($api_success_list) && count($api_success_list) > 0) || (!empty($api_error_list) && count($api_error_list) > 0))
        <div class="mt-4 p-4 bg-gray-100 w-full rounded-2xl">
            <div class="flex flex-wrap gap-4 justify-center text-sm">
                @if(!empty($api_success_list))
                <div class="flex items-center">
                    <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                    <span class="text-gray-700">成功: {{ count($api_success_list) }}件</span>
                </div>
                @endif
                @if(!empty($api_error_list))
                <div class="flex items-center">
                    <span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                    <span class="text-gray-700">失敗: {{ count($api_error_list) }}件</span>
                </div>
                @endif
                <div class="flex items-center">
                    <span class="inline-block w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                    <span class="text-gray-700">合計: {{ (count($api_success_list ?? []) + count($api_error_list ?? [])) }}件</span>
                </div>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
