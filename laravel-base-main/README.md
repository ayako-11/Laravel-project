# laravel-base
- このリポジトリはLaravelプロジェクトの雛形です。新規にプロジェクトを立ち上げる際に利用してください。
- 全社に共通で採用された方針などの実装は、このリポジトリで管理します。

# 利用手順
## 0.準備
- baloccoのprivateリポジトリにアクセス可能な権限を持つPAT（personal access token）を作成する
- PATの作成方法については [githubのドキュメント参照](https://docs.github.com/ja/authentication/keeping-your-account-and-data-secure/managing-your-personal-access-tokens) を参照。

## 1.Laravel環境コンテナの起動
以下手順を実施し、Laravel 11 が動作する環境を構築します。

### ダウンロード
本リポジトリのソースコードをダウンロードする(cloneではない)

### .envの作成 
ダウンロードしたソースコードをDockerが利用可能なディレクトリに配置し、`.env.example` をコピーし `.env` を作成する

### .envの編集
- 作成した`.env` を編集する。
- 通常は、`APP_DOMAIN_NAME` のみ変更すれば良い

### 環境の起動
以下コマンドを実行し、コンテナを起動する
```sh
docker compose up -d
```

### Nginx、https-portal の動作確認
- ローカル端末のhostsファイルに記載する等して、`APP_DOMAIN_NAME` の名前解決ができる状態にする
- https://`APP_DOMAIN_NAME` にブラウザからアクセスし、`File not found` が表示されることを確認する
  - この時点では、Laravelが動作する環境の構築のみが完了した状態です。
    - Laravelのソースコード自体はまだ存在していない状態のため、File not found となります。
- 環境の詳細は、[docker-compose-local.yml](./docker-compose-local.yml) を参照してください。


## 2.Laravelセットアップ（010-init-laravel.sh）
以下手順を実施し、Laravel 11 ソースコードを配置します。

### コンテナへのログイン
Dockerコンテナのlaravelサービスにログインする。
```sh
docker compose exec laravel bash
```

### シェルの実行権限の変更
operation ディレクトリ内のシェルに実行権限を付与する。
```shell
chmod 755 ./operation/*
```

### 010-init-laravel.sh の実行
このシェルは、Laravelの最新stableをダウンロードして、不要ファイルの削除、一部ファイル（.gitignoreなど）のマージを行った上で、プロジェクトルートディレクトリにLaravelのソースコードをセットアップします。

シェルが成功すると、Laravel 11 stableが実行可能な状態となります。

- 実行時にgithubから認証情報を求められた場合は、準備の時点で作成したPATを入力する。
- 実行中にcomposerから確認を求められた場合は、「y（yes）」を選択する。

```shell
./operation/010-init-laravel.sh
```

### 1st commit
main または master ブランチにcommitを行う。


## 3.依存パッケージの追加とプロジェクトのセットアップ（020-setup-project.sh）
以下手順を実施し、開発に必要なLaravel以外のパッケージのインストール、セットアップを行います。

### コンテナへのログイン
Dockerコンテナのlaravelサービスにログインする。

### 020-setup-project.sh の実行
このシェルは、composer.jsonを更新し、開発に必要なパッケージの導入と、セットアップを行います。
シェルが成功すると、以下のパッケージが利用可能な状態となります。

- git-balocco/php-qa-utils
- k-yamamoto-balocco/laravel-ui-cli
- k-yamamoto-balocco/laravel-env-documentator
- php-flasher/flasher-notyf-laravel


- 実行時にgithubから認証情報を求められた場合は、準備の時点で作成したPATを入力する。
- 実行中にcomposerから確認を求められた場合は、「y（yes）」を選択する。
```shell
./operation/020-setup-project.sh
```

### 2nd commit
main または master ブランチにcommitを行う

ここまでで、開発を開始するためのソースコードの準備が完了します。

## 4.開発ドキュメントの確認
docsディレクトリ以下に格納されているプロジェクトに関するドキュメントの雛形の内容を確認し、実際のプロジェクトに即した内容に適宜修正してコミットします。
docsディレクトリは、ドキュメントが取り扱う領域ごとに、以下の4つのサブディレクトリに分かれます。

### development（開発）
開発全般に関するドキュメントは、[docs/development/](./docs/development) ディレクトリ以下に格納します。

主要なドキュメントを以下に示します。

- [開発/Overview](./docs/development/001-overview.md)
- [開発/Environment（デプロイ環境）](./docs/development/030-environment.md)
- [開発/Workflow](./docs/development/040-workflow.md)

### domain
ここで言うdomainとは、このプロジェクトが解決の対象とする問題、関心領域を指す語です。

開発に関わるメンバーが理解、把握しておくべきdomainに関する資料は、[docs/domain/](./docs/domain) ディレクトリ以下に格納します。

### infrastructure
アプリケーションが動作するシステム基盤に関連する資料は、[docs/infrastructure/](./docs/infrastructure) ディレクトリに格納します。

### quality-assurance
アプリケーションの品質保証に関連する資料は、[docs/quality-assurance/](./docs/quality-assurance) ディレクトリに格納します。

主要なドキュメントを以下に示します。

- [品質保証/Overview](./docs/quality-assurance/001-overview.md)
- [品質保証/Commit基準](./docs/quality-assurance/010-commit.md)
- [品質保証/Merge基準](./docs/quality-assurance/020-merge.md)
- [品質保証/Release基準](./docs/quality-assurance/030-release.md)

# 補足事項
## 品質保証用スクリプト
020-setup-project.sh の実行によって、品質管理用のチェックプログラムが利用可能となります。
Dockerコンテナのlaravelサービスにログインした状態で、以下コマンドを実行してください。
```shell
vendor/bin/balocco-qa run sa
```

## ポート番号について
- https-portalのポート番号は、443で固定としている。
