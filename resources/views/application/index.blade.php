<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            一覧表示
        </h2>
    </x-slot>
    <div class="mx-auto px-6">
        <div class="mt-4 p-8 bg-white w-full rouded-2xl">
            <table class="table">
                <thead class="thead-primary">
                    <tr><th>申し込み番号</th><th>サイト名</th><th>会社名</th><th>サイトURL</th><th>ステータス</th><th>送信結果</th><th>申込日時</th><th>更新日時</th></tr>
                </thead>
                <tbody>
                @foreach ($applications as $application)
                <tr>
                    <td>{{$application->application_id}}</td>
                    <td>{{$application->site->site_name}}</td>
                    <td>{{$application->site->trade_name}}</td>
                    <td>{{$application->site->site_url}}</td>
                    <td>@if ($application->paidy_status == null)
                        審査中
                        @elseif ($application->paidy_status == 'approved')
                        承認
                        @elseif ($application->paidy_status == 'rejected')
                        否決
                        @elseif ($application->paidy_status == 'canceled')
                        キャンセル
                        @else
                        不明
                        @endif
                    </td>
                    <td>@if ($application->set_status == 0)
                        -
                        @elseif ($application->set_status == 1)
                        成功
                        @else
                        失敗
                        @endif
                    </td>
                    <td>{{$application->created_at->format('Y年n月d日 g:i')}}</td>
                    <td>@isset($application->updated_at)
                        {{$application->updated_at->format('Y年n月d日 g:i')}}
                        @endisset
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
</div>
</x-app-layout>
