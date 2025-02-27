(※このファイルは雛形です。以下の内容は記載例となります。ドキュメント内容がプロジェクト内容に沿った内容であることを確認し、必要な場合には内容を更新してからコミットしてください。)

# リファクタリング

当資料は、本プロジェクトにおけるリファクタリングについて記載するドキュメントである。

## 対象
- リポジトリメンテナ
- アプリケーション担当者

## 概要

リファクタリングの実施にあたっては、以下の方針を遵守すること。

# REQUIRED方針

- リファクタリングを行う場合、対象のメソッド、クラスに対するUnitTestが実装されていなければならない。
    - UnitTestが実装されていないクラス、メソッドに対するリファクタリングを行う場合、まずUnitTestの実装を行うこと。

# RECOMMENDED方針

- phpmetrics の計測結果を参照し、PageRankの高いクラスを優先にリファクタリングを実施することを推奨する。
- メソッドあたりの認知的複雑度が8を超える場合、7以下となるようにリファクタリングを実施することを推奨する。
- リファクタリングの実施にあたって、その手法は書籍「リファクタリング(第2版): 既存のコードを安全に改善する」に掲載されている手法をその参考とすること。
