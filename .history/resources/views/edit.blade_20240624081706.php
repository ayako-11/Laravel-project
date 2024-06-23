<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODOの内容の編集</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>TODOの内容の編集</h1>
        <form action="{{ route('edit.post', ['id' => $task->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$task->id}}">
            <div class="mb-3">
                <label for="title">件名</label>
                <input name="title" class="form-control" id="title" placeholder="入力フォーム" value="{{$task->title}}" type="text">
                @if($errors->has('title'))<span style="color: red">{{ $errors->first('title') }}</span>@endif
            </div>
            <div class="mb-3">
                <label for="detail">詳細</label>
                <input name="detail" class="form-control" id="detail" placeholder="入力フォーム" value="{{$task->detail}}" type="text">
                @if($errors->has('detail'))<span style="color: red">{{ $errors->first('detail') }}</span>@endif
            </div>
            <button type="submit" class="btn btn-primary">保存</button>
        </form>


    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
