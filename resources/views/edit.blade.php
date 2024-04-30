<!DOCTYPE html>
<html lang="en">
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
        <form>
            <div class="mb-3">
                <label for="title">件名</label>
                <input type="text" class="form-control" id="title" placeholder="件名">
            </div>
            <div class="mb-3">
                <label for="description">詳細</label>
                <textarea class="form-control" id="description" rows="3" placeholder="詳細"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">保存</button>
        </form>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
