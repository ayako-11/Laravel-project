#!/bin/bash
# プロジェクトルートに移動
cd `dirname $0`/..

echo "[Laravel default database settings]"
php artisan tinker --execute="dump(config('database.connections.'.config('database.default')))"

echo "[Execute query 'select now() as connection_test']"
php artisan tinker --execute="dump(DB::select('select now() as connection_test')[0]->connection_test);"
