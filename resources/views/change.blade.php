<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO期限、優先度の変更</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
            <h1 class="text-center">TODO期限、優先度の変更</h1>
            <form action="{{ route('change.post', ['id' => $task->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$task->id}}">
        <form>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                <label for="title">件名</label>
                <input type="text" class="form-control" id="title" placeholder="件名" value="{{$task->title}}" {{ old('title') }}>
                @if($errors->has('title'))<span style="color: red">{{ $errors->first('title') }}</span>@endif
            </div>
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
            <div class="row mb-3">
                <div class="mb-3">
                    <label for="priority">優先度</label>
                    <select class="form-select" id="priority" name="priority"  value="{{$task->priority}}">
                        <option value="">選択してください</option>
                        <option value="10" >緊急</option>
                        <option value="20" >高</option>
                        <option value="30" >低</option>
                    </select>
                    @if($errors->has('priority'))<div class="priority"><span style="color: red">{{ $errors->first('priority') }}</span></div>@endif
                </div>
        </div>
            <div class="form-group">
                <input type="submit" name="button" value="保存" class="btn btn-primary btn-wide">
            </div>
        </div>
    </div>
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


