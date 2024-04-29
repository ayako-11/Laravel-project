<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODOの新規登録</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>TODOの新規登録</h1>
        <form>
            <div class="mb-3">
                <label for="title">件名</label>
                <input type="text" class="form-control" id="title" placeholder="入力フォーム">
            </div>
            <div class="mb-3">
                <label for="description">詳細</label>
                <textarea class="form-control" id="description" rows="3" placeholder="入力フォーム"></textarea>
            </div>
            <div class="mb-3">
                <label for="due_date">期限</label>
                <input type="text" class="form-control" id="due_date" placeholder="年/月/日~年/月/日">
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
</body>
</html>
