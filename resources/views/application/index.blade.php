<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            一覧表示
        </h2>
    </x-slot>
    <div class="mx-auto px-6">
        <div class="mt-4 p-8 bg-white w-full rouded-2xl">
            <a href="/import-csv" class="btn btn-primary">インポート</a>
            <!-- Search function start here -->
            <div class="search container">
                <form action="{{ route('application.index') }}" method="GET">
                    @csrf

                    <div class="form-group row">
                        <div class="col">
                            <label for="">申込番号
                                <input type="text" name="application_id" value="{{ $application_id }}">
                            </label>
                        </div>

                        <div class="col">
                            <label for="">サイト名
                                <input type="text" name="site_name" value="{{ $site_name }}">
                            </label>
                        </div>
                        <div class="col">
                            <label for="">ステータス
                                <select name="paidy_status" data-toggle="select">
                                    <option value="">全て</option>
                                    <option value="null">審査中</option>
                                    <option value="approved">承認</option>
                                    <option value="rejected">否決</option>
                                    <option value="canceled">キャンセル</option>
                                </select>
                            </label>
                        </div>

                        <div class="col">
                            <label for="">送信結果
                                <select name="set_status" data-toggle="select">
                                    <option value="">全て</option>
                                    <option value="1">成功</option>
                                    <option value="2">失敗</option>
                                </select>
                            </label>
                        </div>

                        <div class="col">
                            <label for="">申込日付検索</label>
                            <input type="date" name="created_from" placeholder="from_date" value="{{ $created_from }}">
                                <span class="mx-3">~</span>
                            <input type="date" name="created_until" placeholder="until_date" value="{{ $created_until }}">
                        </div>

                        <div class="col">
                            <label for="">更新日付検索</label>
                            <input type="date" name="updated_from" placeholder="from_date" value="{{ $updated_from }}">
                                <span class="mx-3">~</span>
                            <input type="date" name="updated_until" placeholder="until_date" value="{{ $updated_until }}">
                        </div>

                        <div>
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
            <!--Search function ends here -->
                    <table class="table">
                <thead class="thead-primary">
                    <tr><th>申込番号</th><th>サイト名</th><th>会社名</th><th>サイトURL</th><th>ステータス</th><th>送信結果</th><th>申込日時</th><th>更新日時</th></tr>
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
                    <td>@if($application->created_at != null )
                        {{$application->created_at->format('Y年n月d日 g:i')}}
                        @endisset
                    </td>
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
