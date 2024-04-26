<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO検索</title>
</head>
<body>
    <h1>TODO検索</h1>
    
    <!-- 検索フォーム -->
<form action="<?php echo e(route('search')); ?>" method="GET">
    <div>
        <label for="due_date_from">期限:</label>
        <!-- 期限（開始） -->
        <input type="date" id="due_date_from" name="due_date_from">
        <!-- 期限（終了） -->
        <label for="due_date_to">~</label>
        <input type="date" id="due_date_to" name="due_date_to">
    </div>
    <div>
        <label for="content">内容:</label>
        <input type="text" id="content" name="content">
    </div>
    <div>
        <label>優先度:</label>
        <input type="checkbox" id="priority_high" name="priority[]" value="high">
        <label for="priority_high">緊急</label>
        <input type="checkbox" id="priority_medium" name="priority[]" value="medium">
        <label for="priority_medium">高</label>
        <input type="checkbox" id="priority_low" name="priority[]" value="low">
        <label for="priority_low">低</label>
    </div>
    <div>
        <label>ステータス:</label>
        <input type="checkbox" id="status_new" name="status[]" value="new">
        <label for="status_new">新規</label>
        <input type="checkbox" id="status_pending" name="status[]" value="pending">
        <label for="status_pending">進行中</label>
        <input type="checkbox" id="status_completed" name="status[]" value="completed">
        <label for="status_completed">完了</label>
        <input type="checkbox" id="status_cancelled" name="status[]" value="cancelled">
        <label for="status_cancelled">中止</label>
    </div>
    <div>
        <label for="order_by">並び替え対象:</label>
        <select name="order_by" id="order_by">
            <option value="id">ID</option>
            <option value="priority">優先度</option>
            <option value="due_date">期限</option>
        </select>
    </div>
    <div>
        <label for="order">並び替え順序:</label>
        <select name="order" id="order">
            <option value="asc">昇順</option>
            <option value="desc">降順</option>
        </select>
    </div>
    <button type="submit">検索</button>
</form>

 
    <!-- 検索結果のテーブル -->
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>期限</th>
                <th>優先度</th>
                <th>内容</th>
                <th>アクション</th>
            </tr>
        </thead>
    </table>
</body>
</html>



      <?php /**PATH /var/www/html/resources/views/search-result.blade.php ENDPATH**/ ?>