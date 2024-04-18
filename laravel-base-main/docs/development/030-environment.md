(※このファイルは雛形です。以下の内容は記載例となります。ドキュメント内容がプロジェクト内容に沿った内容であることを確認し、必要な場合には内容を更新してからコミットしてください。)

# Environment
当資料は、本プロジェクトのデプロイ環境についての情報を記載する。  
- 環境差分に関する情報を整理して記載し、必要に応じて随時更新を行うこと。
- デプロイ環境によって動作が切り替わるような機能（スタブ/ドライバ等含む）が存在する場合、このドキュメントに必ず詳細を追記すること

## 対象 / subject
- 全てのプロジェクト関係者

# 前提

- 本ドキュメントの記載内容は、Laravel バージョン 10.2.* を前提とする。
- https://12factor.net/ja/config

# デプロイ先
本プロジェクトのデプロイ先は以下の5種となる予定である。

- production 本番環境
- staging ステージング環境
- testing テスト実行環境
- develop 開発環境
- local ローカル開発

# 設定ファイル

設定ファイル（.env）の管理について以下に記載する。

## 設定ファイルの管理

設定ファイルは、原則として暗号化した上でリポジトリ管理しなければならない。 ただし、local 用の設定については初期デプロイ時（インストール前）に参照する必要があるため、暗号化せず .env.example
として平文でリポジトリにコミットされている。

- 暗号化する際のキーは指定のものを利用すること。 
- 暗号化キーを変更する場合は、Github Action のsecret設定変更が必要となるため、注意が必要。
※暗号化キーはリポジトリにコミットされるファイルに記載せずに、Redmine、社内wiki等の認証が必要な領域にて管理すること。

### production

- .env.production.encrypted をリポジトリ管理。

~~~shell
# 暗号化
php artisan env:encrypt --env=production --force --key=**************** 
# 復号
php artisan env:decrypt --env=production --force --key=**************** 
~~~

### staging

- .env.staging.encrypted をリポジトリ管理

~~~shell
# 暗号化
php artisan env:encrypt --env=staging --force --key=**************** 
# 復号
php artisan env:decrypt --env=staging --force --key=**************** 
~~~

### testing

- .env.testing.encrypted をリポジトリ管理

~~~shell
# 暗号化
php artisan env:encrypt --env=testing --force --key=**************** 
# 復号
php artisan env:decrypt --env=testing --force --key=**************** 
~~~

#### 注意事項

以下のGithub Action中で、testingの設定ファイル復号処理が実行される。この際、復号キーはGithub のsecrets (ENV_TESTING_ENCRIPT_KEY)
を参照している。したがって、暗号化キーを変更する場合はgithub secrets の内容も更新しなければならない。

- [品質チェック](../../.github/workflows/quality-check.yml)
- [SonarQube解析](../../.github/workflows/sonar-qube.yml)

# 設定値の確認

各環境の設定値についての詳細は、以下のコマンドにて確認すること。

```shell
# 各環境の設定値のみ表示
php artisan env:documentator 

# 各環境の設定値とメタ情報
php artisan env:documentator -m description,laravels
```

※コマンド実行の準備として、.env に ENV_DOCUMENTATOR_DEFAULT_KEY を設定する必要がある。
※env:documentator コマンドの設定は[env-documentator.php](../../config/env-documentator.php) 参照。

# 環境により動作が切り替わる機能等について
必要に応じて、以下に追記すること。

## after-pull.sh
production,staging,develop,testing,local すべてのデプロイ環境においてこのシェルでデプロイを行うため、内部で環境変数による分岐が行われる。
詳細はシェルの内容を確認すること。[after-pull.sh](../../operation/after-pull.sh)
