(※このファイルは雛形です。以下の内容は記載例となります。ドキュメント内容がプロジェクト内容に沿った内容であることを確認し、必要な場合には内容を更新してからコミットしてください。)

# Workflow
当資料は、プロジェクトの開発進行におけるワークフローについて記載するドキュメントである。

# 詳細
## 基本方針
原則として、gitflowに沿って開発を進行すること。
[https://www.atlassian.com/ja/git/tutorials/comparing-workflows/gitflow-workflow](https://www.atlassian.com/ja/git/tutorials/comparing-workflows/gitflow-workflow)


## 開発着手時
- 開発をアサインされた担当者は、Redmine上のチケットステータスを「進行中」に変更し、チケット番号にてブランチを作成する。
    - hotfixとするかfeatureとするかの判断がつかない場合、マネージャまたはメンテナに判断を仰ぐ。
    - hotfixの場合、ブランチ名を hotfix/チケット番号 とする
    - featureの場合、ブランチ名を feature/チケット番号 とすること。
    - ブランチ名の末尾に、_ に続けてタスク内容を簡潔に示す名称を付けてもよい。

## 開発中

- 担当者は、コミットの前に以下の静的解析コマンドを実行し、警告、エラー等が発生する場合は修正を実施する。

```shell
vendor/bin/balocco-qa run sa
``` 

- 静的解析コマンドが成功した場合、ユニットテストを実行する。エラー、警告、Riskyテスト等が検出された場合、修正を実施する。

```shell
vendor/bin/phpunit
``` 

## 開発終了時
担当者が実装を完了したと判断した場合、以下の手順を進行する。
- 担当者は、以下の2点を行う
  - github上にてPullRequestを作成し、自分をAssigneeに指定し、Reviewerを指定する。
  - Redmine上でレビュアを指定し、PullRequestのURLを記載した上でチケットステータスを「RV待ち」に設定する。

- レビュアは、以下の3点を行う
  - vendor/bin/balocco-qa run sa を実行。静的解析コマンドが失敗した場合、レビュー終了（NG）。
  - vendor/bin/phpunit を実行。静的解析コマンドが失敗した場合、レビュー終了（NG）。
  - 内容のレビュー。

- レビュアは、レビュー結果に従って、以下の3点を行う
    - レビュー結果OKの場合、github上でPullRequestに対してApproveする
    - レビュー結果NGの場合、github上でPullRequestに対してRequest changes する(理由も記載する)
    - Redmine上でレビュー結果をコメント二記載し、チケットステータスを「進行中」に変更する。

- 担当者は、レビュー結果に従って以下のいずれかを行う。
  - レビュー結果がNGの場合、修正して再度PullRequest
  - レビュー結果がOKの場合、Redmineのステータスをチェック待ちに変更

## PullRequestのマージ
- メンテナは、ApproveされたPullRequestを随時マージする。

## リリース時
[010-deployment.md](./010-deployment.md) に従って各環境に対してデプロイを行う。

