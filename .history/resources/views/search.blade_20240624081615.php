<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODOアプリ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
        .pagination {
            margin-top: 20px;
        }
        .pagination .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .menu {
        display: flex;
        justify-content: flex-start;
        list-style-type: none;
        color: #fff;
        padding: 0;
        }
        .menu li {
        position: relative;
        width: 100px;
        margin-left: 1px;
        padding: 5px;
        background: #444444;
        }
       .menuSub li a:hover {
        background: #FFCA7B;
        }
        .menu li:nth-of-type(odd) {
        background-color: #fcc;
        }
        .menu li:nth-of-type(even) {
        background-color: #ccf;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="text-center">TODO検索</h1>
            <form action="{{ route('index.search') }}" method="GET">
                @csrf
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_deadline">開始日</label>
                                <input type="date" class="form-control" id="start_deadline" name="start_deadline" value="{{ old('start_deadline') }}">
                                @if($errors->has('start_deadline'))<span style="color: red">{{ $errors->first('start_deadline') }}</span>@endif
                            </div>
                            <div class="col-md-6">
                                <label for="end_deadline">終了日</label>
                                <input type="date" class="form-control" id="end_deadline" name="end_deadline" value="{{ old('end_deadline') }}">
                                @if($errors->has('end_deadline'))<span style="color: red">{{ $errors->first('end_deadline') }}</span>@endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="keyword">内容</label>
                                    <input type="text" textarea name="keyword" class="form-control" placeholder="キーワードを入力" value="{{ old('keyword') }}">
                                    @if($errors->has('keyword'))<span style="color: red">{{ $errors->first('keyword') }}</span>@endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="priority">優先度</label>
                                    <select class="form-select" id="priority" name="priority">
                                        <option value="">選択してください</option>
                                        <option value="10" >{{ old('10') }}緊急</option>
                                        <option value="20" >{{ old('20') }}高</option>
                                        <option value="30" >{{ old('30') }}低</option>
                                    </select>
                                    @if($errors->has('priority'))<span style="color: red">{{ $errors->first('priority') }}</span>@endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label>ステータス</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="10" name="status[]" value="10" {{ in_array('10', (array)old('status', ['10', '20'])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="new">新規</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="20" name="status[]" value="20" {{ in_array('10', (array)old('status', ['10', '20'])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="in_progress">進行中</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="30" name="status[]" value="30" {{ in_array('30', (array)old('status', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="completed">完了</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="40" name="status[]" value="40" {{ in_array('40', (array)old('status', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cancelled">中止</label>
                                    </div>
                                    @if($errors->has('status'))<span style="color: red">{{ $errors->first('status') }}</span>@endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>並び替え対象</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sort_by" id="sort_by_id" value="id" {{ old('sort_by', 'id') == 'id' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sort_by_id">ID</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sort_by" id="sort_by_priority" value="priority" {{ old('sort_by') == 'priority' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sort_by_priority">優先度</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sort_by" id="sort_by_deadline" value="deadline" {{ old('sort_by') == 'deadline' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sort_by_deadline">期限</label>
                                        </div>
                                        <div class="sort_by"><span style="color: red">@error('sort_by'){{ $message }}@enderror</span></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>並び替え順序</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sort_order" id="sort_order_asc" value="asc" {{ old('sort_order', 'asc') === 'asc' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sort_order_asc">昇順</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sort_order" id="sort_order_desc" value="desc" {{ old('sort_order') === 'desc' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sort_order_desc">降順</label>
                                        </div>
                                        <div class="sort_order"><span style="color: red">@error('sort_order'){{ $message }}@enderror</span></div>
                                    </div>
                                </div>

                            <div class="form-group">
                                <input type="submit" name="button" value="検索" class="btn btn-primary btn-wide">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 検索結果表示領域 -->
                @if(!empty($tasks))
                <div class="mt-4">
                    <h2>検索結果</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>期限</th>
                                <th>優先度</th>
                                <th>件名</th>
                                <th>アクション</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->deadline }}</td>
                                <td>{{ $task->priority_id }}</td>
                                <td>{{ $task->title }}</td>
                                <td>
                                    <div>
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            ≡
                                          </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $task->id }}">
                                            <a class="dropdown-item" href="{{ route('edit.form', $task->id) }}">内容の編集</a>
                                            <a class="dropdown-item" href="#">期限、優先度の変更</a>
                                            <a class="dropdown-item" href="#">開始</a>
                                            <a class="dropdown-item" href="#">完了</a>
                                            <a class="dropdown-item" href="#">中止</a>
                                            <a class="dropdown-item" href="#">削除</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  <!-- ページネーションの表示 -->
                    {{ $tasks->appends(request()->query())->links('pagination::bootstrap-5')}}
                    @else
                      <p>検索結果がありません。</p>
                      @endif
            </div>
        </form>
        </div>
    </div>
<!-- Bootstrap 5 Datepicker JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<!-- popper.js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
<!-- bootstrap.js -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"></script>
</body>
</html>
