<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODOの新規登録</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap 5 Datepicker CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>TODOの新規登録</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title">件名</label>
                <textarea name="title" class="form-control" id="titleTextarea" rows="3" placeholder="入力フォーム">{{ old('title') }}</textarea>
                @if($errors->has('title'))<span style="color: red">{{ $errors->first('title') }}</span>@endif
            </div>
            <div class="mb-3">
                <label for="description">詳細</label>
                <textarea name="detail" class="form-control" id="detailTextarea" rows="3" placeholder="入力フォーム">{{ old('detail') }}</textarea>
                @if($errors->has('detail'))<span style="color: red">{{ $errors->first('detail') }}</span>@endif
            </div>
            <div class="mb-3 row">
                <div class="col">
                    <label for="deadline">期限</label>
                    <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline') }}">
                    @if($errors->has('deadline'))<div class="deadline"><span style="color: red">{{ $errors->first('deadline') }}</span></div>@endif
                </div>
            </div>
            <div class="mb-3">
                <label for="priority">優先度</label>
                <select class="form-select" id="priority" name="priority">
                    <option value="">選択してください</option>
                    <option value="10" >緊急</option>
                    <option value="20" >高</option>
                    <option value="30" >低</option>
                </select>
                @if($errors->has('priority'))<div class="priority"><span style="color: red">{{ $errors->first('priority') }}</span></div>@endif
            </div>
            <input type="submit" name="button1" value="登録" class="btn btn-primary btn-wide">
        </form>
    </div>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (Necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap 5 Datepicker JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>
</html>
