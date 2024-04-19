#!/bin/bash
if !(type "shopt" > /dev/null 2>&1); then
    echo "shopt doesnt exists."
    exit 1
fi

# プロジェクトルートに移動
cd `dirname $0`/..

# app が存在している場合は中止
if [ -e ./app ]; then
    echo "app directory exists."
    exit 1
fi
# composer.json が存在している場合も中止
if [ -f ./composer.json ]; then
    echo "composer.json exists."
    exit 1
fi

# tmp が存在しているとcrate-projectが失敗するため中止
if [ -e ./tmp ]; then
    echo "tmp directory exists."
    exit 1
fi

# see https://getcomposer.org/doc/03-cli.md#create-project
# Laravelのstableをダウンロード
composer create-project --no-scripts --no-install laravel/laravel tmp

# 不要なファイルを削除
rm -f tmp/.editorconfig
rm -f tmp/READEME.md

# .env を作成
cat tmp/.env.example .env> tmp/.env
# .env.example をマージ
cat tmp/.env.example .env.example > tmp/.env.example.merged
mv tmp/.env.example.merged tmp/.env.example

# .gitignore をマージ
cat tmp/.gitignore .gitignore > tmp/.gitignore.merged
mv tmp/.gitignore.merged tmp/.gitignore

# 設置先のファイルを削除
rm -f ./.gitignore
rm -f ./.env
rm -f ./.env.example


# tmp 以下のファイルを1階層上に移動
shopt -s dotglob
mv tmp/* .
shopt -u dotglob
# tmp を削除
rm -r tmp



git config --global --add safe.directory /var/www/html
git update-index --add --chmod=+x operation/110-resolve-dependency.sh
git update-index --add --chmod=+x operation/120-after-pull.sh

#
echo "ファイルの変更内容を確認してコミットしてください。"
