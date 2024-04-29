<!DOCTYPE html>
<html lang="en">
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
    </style>
</head>
<body>
    <div class="container">
        <h1>TODO検索</h1>
        <form>
            <div class="mb-3">
                <label for="due_date">期限</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="due_date" placeholder="開始年/月/日 ~ 終了年/月/日">
                </div>
            </div>
            <div class="mb-3">
                <label for="content">内容</label>
                <input type="text" class="form-control" id="content" placeholder="入力フォーム">
            </div>
            <div class="mb-3">
                <label>優先度</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="urgent" value="urgent">
                    <label class="form-check-label" for="urgent">緊急</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="high" value="high">
                    <label class="form-check-label" for="high">高</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="low" value="low">
                    <label class="form-check-label" for="low">低</label>
                </div>
            </div>
            <div class="mb-3">
                <label>ステータス</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="new" value="new">
                    <label class="form-check-label" for="new">新規</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="in_progress" value="in_progress">
                    <label class="form-check-label" for="in_progress">進行中</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="completed" value="completed">
                    <label class="form-check-label" for="completed">完了</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="cancelled" value="cancelled">
                    <label class="form-check-label" for="cancelled">中止</label>
                </div>
            </div>
            <div class="mb-3">
                <label>並び替え対象</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sort_by" id="sort_by_id" value="id" checked>
                    <label class="form-check-label" for="sort_by_id">ID</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sort_by" id="sort_by_priority" value="priority">
                    <label class="form-check-label" for="sort_by_priority">優先度</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sort_by" id="sort_by_due_date" value="due_date">
                    <label class="form-check-label" for="sort_by_due_date">期限</label>
                </div>
            </div>
            <div class="mb-3">
                <label>並び替え順序</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sort_order" id="sort_order_asc" value="asc" checked>
                    <label class="form-check-label" for="sort_order_asc">昇順</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sort_order" id="sort_order_desc" value="desc">
                    <label class="form-check-label" for="sort_order_desc">降順</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">検索</button>
        </form>

        <div class="mt-4">
            <h2>結果</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>期限</th>
                        <th>優先度</th>
                        <th>件名</th>
                        <th>アクション</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 結果表示部分はここに追加 -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#due_date", {
            mode: "range",
            dateFormat: "Y/m/d",
            placeholder: "開始年/月/日 ~ 終了年/月/日",
        });
    </script>
</body>
</html>
