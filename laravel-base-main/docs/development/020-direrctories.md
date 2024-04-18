(※このファイルは雛形です。以下の内容は記載例となります。ドキュメント内容がプロジェクト内容に沿った内容であることを確認し、必要な場合には内容を更新してからコミットしてください。)

# Directories
本資料では、当リポジトリ内のディレクトリ構成についての注意事項、各ディレクトリに格納すべき内容、格納するべきではない内容、についての方針を示す。
  また、以下の説明において、
- 1.Laravel標準ディレクトリ: Laravelインストールによって作成されるディレクトリ群
- 2.拡張ディレクトリ: それ以外のディレクトリ群

に分けて説明する。

## 対象
- アプリケーション担当者 / Application Engineer
- インフラ担当者 / Infrastructure Engineer

# Laravel標準ディレクトリ
Laravel標準ディレクトリについての基礎的な内容については、Laravelのリファレンスを参照すること。
[https://readouble.com/laravel/10.x/ja/structure.html](https://readouble.com/laravel/10.x/ja/structure.html)

以下に、本プロジェクトにおける、Laravel標準ディレクトリに格納する内容についての補足事項を記載する。

## app/Models
- Eloquent Modelを格納する。
  - このディレクトリ外に、Eloquent Modelを格納してはならない。

## tests
- 自動テストを配置する。
- 名前空間「Tests」のルートディレクトリである。

### tests/Feature
- FeatureTest = 機能テスト（複数のオブジェクト、メソッドの協調、相互作用を要する、あるまとまった機能が期待通りに動作することを検証するテスト）を配置する。

- 具体的には、以下の2種の機能テストである。
  - [Httpテスト](https://readouble.com/laravel/10.x/ja/http-tests.html)
  - [コンソールテスト](https://readouble.com/laravel/10.x/ja/console-tests.html) 

### tests/Unit
- 単体テスト（単一のメソッドに対するテスト）を配置する。


# 2.拡張ディレクトリ
## docker
- docker関連の資材を配置する。
  - docker以下には、デプロイ環境ごとに管理できるよう、develop,local,staging,production の各ディレクトリを配置する。

## docs
- 当リポジトリ、ないしプロジェクトに関する資料ファイルを配置する。

### docs/development
- 開発に関する資料を格納する。
- 要求に関する資料はこのディレクトリに格納しない。

### docs/quality-assurance
- コード品質保証に関する資料を格納する。

### development
- 主に開発者向けの各種ドキュメントを配置する。

### domain
- アプリケーションの関心領域（アプリケーション/プロジェクト固有の要件、要求、仕様等）に関する資料を配置する。
### qa
- 品質保証に関連する資料を配置する。

## operation
- 運用に関連する資材を配置する。

## qa
- 品質管理に関する資材を配置する。

### result
- 品質管理用シェルの実行結果を格納する。
- 後述するscripts以下のシェルを実行することによって、このディレクトリにファイルが生成されるため、基本的にgit管理対象外とする。

### scripts
- 品質管理用シェルを配置する。

### settings
- 品質管理用シェルの設定ファイル、ベースラインファイル等を配置する。
