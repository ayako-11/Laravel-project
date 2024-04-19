(※このファイルは雛形です。以下の内容は記載例となります。ドキュメント内容がプロジェクト内容に沿った内容であることを確認し、必要な場合には内容を更新してからコミットしてください。)

# validation
本資料は、プロジェクトにおけるバリデーション実装に関する方針、注意事項等について記載するドキュメントである。

## 対象 / Subject
- アプリケーション担当者 / Application Engineer

## 参考資料
- [https://readouble.com/laravel/10.x/ja/validation.html](https://readouble.com/laravel/10.x/ja/validation.html)

## 前提


# 詳細
## 基本方針
- 社内研修 https://wiki.balocco.info/6541dd7c633ba58086c3825e にて説明を行った内容が、バリデーション実装における基本的な方針である。

## エラーメッセージの管理方法 
- エラーメッセージは、[言語ファイルにより管理](https://readouble.com/laravel/10.x/ja/validation.html#specifying-custom-messages-in-language-files)
することを推奨する。

## FormRequestクラス

## サーバーサイド実装サンプル

[sample/validation](./sample/validation)

