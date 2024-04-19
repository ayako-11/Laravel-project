(※このファイルは雛形です。以下の内容は記載例となります。ドキュメント内容がプロジェクト内容に沿った内容であることを確認し、必要な場合には内容を更新してからコミットしてください。)

# Deployment
本資料では、以下の2種類のデプロイについて、詳細手順を記載する。
- 環境構築が既に済んでいる環境に対して更新を反映する場合のに行う通常の手順（運用時デプロイ手順）
- ある環境に初めてデプロイを行って環境構築をする場合に行う初回デプロイ手順

## 対象 / Subject
- アプリケーション担当者 / Application Engineer
- インフラ担当者 / Infrastructure Engineer

## 関連資料
- [Laravel 10.x 設定](https://readouble.com/laravel/10.x/ja/configuration.html)

## 注意事項
- [概要](./001-overview.md) に記載されているデプロイ手順に関する注意事項を遵守すること。
- デプロイについてのすべての手順はこの資料に記載すること。
- 以下のような場合は特に、本ドキュメントの更新が必要であるか確認を行い、必要に応じて追記、変更を行うこと。
    - やむを得ずafter-pull.sh の内容を変更した場合
    - CodePipeline、Github actions等、CIに関連するデプロイプロセスの設定変更を行った場合
    - 本番環境の環境設定等に変更が生じた場合


# 詳細
## 運用時デプロイ手順 / For second time onwards at the environment.
### git pull
ソースコードを最新の状態に更新し、目的のブランチ、リリースタグをチェックアウトする。

### after-pull.sh
after-pull.shを実行し、デプロイを実施する。
Just execute command below.[^1]

引数に、デプロイ先の環境名、復号キーを指定する。
~~~shell
./operation/after-pull.sh デプロイ先 
~~~

- デプロイ先については、[030-environment.md](./030-environment.md) に記載されているものからいずれかを入力。
- 必要に応じて、第二引数に設定ファイル復号のための暗号化キーを指定する。
- local,staging,production の場合、キーは指定できない。after-pull.sh 実行前に .env を作成しておく必要がある。

以上


### 運用時デプロイ手順に関する注意事項
- 手作業によるデプロイ手順は追加してはならない。

## ローカル開発環境等の初回デプロイ手順 / For the first time at the local environment.
※案件アサイン時、開発開始時点等、主にローカル環境において初めてデプロイを行う場合の特殊な手順について以下に記載します

ローカル環境等にこのアプリケーションをはじめてデプロイする場合、以下の手順を実行する。

If you are deploying this application for the first time in local environment, follow these steps:

- git clone
- .envファイルの作成 / Copy ".env.example" to ".env" and modify it.
- 実行環境の起動 / Launching the execution environment
- 依存パッケージのインストール / Install dependent packages
- php artisan key:generate の実行
- DB接続の確認
- ./operation/after-pull.sh の実行

## git clone

アプリケーションのソースコード（このファイルを含む）をリポジトリからcloneする。

## .envファイルの作成 / Create .env file and modify it
clone直後には.envファイルが存在しないため、.envを作成する。

```
cp .env.example .env
```

必要に応じて、.envファイルの内容を編集する。一例として、データベースのホスト、データベース名など。

Edit the contents of .env if necessary. As an example, the value of DB_HOST , DB_DATABASE etc...



## 実行環境の起動 / Launching the execution environment

```shell
docker compose -f docker-compose-local.yml up -d
```

## 依存パッケージのインストール / Install dependent packages

```shell
# PHPコンテナへのログイン
docker compose -f docker-compose-local.yml exec laravel.sakura bash
# 依存関係のインストール
composer install --optimize-autoloader
```

## DB接続の確認
PHPコンテナからDBコンテナへの接続ができているか確認する
```shell
# PHPコンテナへのログイン
docker compose -f docker-compose-local.yml exec laravel.sakura bash
# DB接続の確認(タイムスタンプが表示されれば接続OK)
php artisan tinker --execute="dump(DB::select('select now()'));"
```

※以下のエラー等が表示される場合、DBのコンテナが起動していない可能性がある。しばらく待って、コンテナの上げ下げなどをすると治ると思う
~~~
SQLSTATE[08006] [7] could not translate host name "pgsql" to address: Temporary failure in name resolution (Connection: pgsql, SQL: select now()).
~~~


## after-pull.sh の実行

~~~shell
./operation/after-pull.sh local
~~~

# 参考）github actions でのテスト実行時デプロイ
詳細については下記ファイルを参照。
- [sonar-qube.yml](../../.github/workflows/sonar-qube.yml)
- [quality-check.yml](../../.github/workflows/quality-check.yml)


# 備考
## マイグレーションについて
- デプロイ手順中でマイグレーションが実行される。
- マスタデータの更新等、全環境において同一のデータ状態を保つ必要性がある内容は、すべてマイグレーションとして実装しコミット、デプロイにより反映すること。
    - データベースの直接操作は、上記に該当しない内容についてのみ行う

## アセットの構築

- デプロイ手順中で、アセットの構築（npm run build）が行われる。
- クライアント側リソースはnpmおよびViteで管理し、適切に難読化、minifyされるよう留意すること。


# Annotations

[^1]:*1 アプリケーション開発者は、標準的なデプロイ手順である after-pull.sh
の実行のみでデプロイが完了するよう、留意して開発すること。また、追加のデプロイ手順が必要となる場合は場合、ドキュメントに記載の上、開発関係者への周知を徹底すること。 
