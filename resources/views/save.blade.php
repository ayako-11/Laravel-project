<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODOの新規登録</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap 5 Datepicker CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>TODOの新規登録</h1>
    <!-- errors.blade.phpを読み込む -->
            @include('errors')
        <form>
            <div class="mb-3">
                <label for="title">件名</label>
                <textarea name="title" class="form-control" id="titleTextarea" rows="3" placeholder="入力フォーム"></textarea>
            </div>
            <div class="mb-3">
                <label for="description">詳細</label>
                <textarea name="detail" class="form-control" id="detailTextarea" rows="3" placeholder="入力フォーム"></textarea>
            </div>
            <div class="mb-3 row">
                <div class="col">
                                <label for="start_date">期限 開始</label>
                                <input type="text" class="form-control" id="start_date" name="start_date" placeholder="年/月/日">
                            </div>
                            <div class="col">
                                <label for="end_date">期限 終了</label>
                                <input type="text" class="form-control" id="end_date" name="end_date" placeholder="年/月/日">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="priority">優先度</label>
                            <select class="form-select" id="priority">
                                <option value="urgent">緊急</option>
                                <option value="high">高</option>
                                <option value="low">低</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">登録</button>
                    </form>

                </div>

                <!-- Bootstrap 5 JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
                <!-- jQuery (Necessary for Bootstrap's JavaScript plugins) -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <!-- Bootstrap 5 Datepicker JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
                <script>
                    // 期限をカレンダーで選択できるようにする
                    $(document).ready(function(){
                        $('#start_date, #end_date').datepicker({
                            format: 'yyyy/mm/dd', // 期限のフォーマット
                            autoclose: true, // カレンダーをクリックした後、自動的に閉じる
                            todayHighlight: true // 今日の日付をハイライト表示する
                        });
                    });
                </script>
            </body>
            </html>
