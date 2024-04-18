(※このファイルは雛形です。以下の内容は記載例となります。ドキュメント内容がプロジェクト内容に沿った内容であることを確認し、必要な場合には内容を更新してからコミットしてください。)

# 静的解析
当資料は、本プロジェクトにおける静的解析について記載するドキュメントである。

静的解析の内容についての概要および検査失敗時の対応方針等について、以下に示す。

## 対象 / subject
- アプリケーション担当者 / Application Engineer
- 品質管理担当者 / Quality Assurance Engineer

## 備考
本プロジェクトの静的コード解析は、[qa/scripts/sa](../../qa/scripts/sa)
以下に格納されるプログラムにより構成されている。これらの設定は、[qa/settings/sa](../../qa/settings/sa)
に格納されている。詳細については前掲シェル、および各シェルから参照される [設定ファイル](../../qa/settings/sa) の内容を確認すること。

# 詳細
## 010-parallel-lint.sh

[php-parallel-lint/php-parallel-lint](php-parallel-lint/php-parallel-lint) によるphp のsyntaxチェック。

この検査に失敗した場合、検査をパスする状態にソースコードを修正しなければならない。

## 020-composer-require-checker.sh

[https://github.com/maglnet/ComposerRequireChecker](https://github.com/maglnet/ComposerRequireChecker) による、暗黙的依存関係の検査。

この検査は、require-dev にのみ記載されているためlocalでは依存解決できるが、productionにデプロイした際に必要パッケージが存在せず発生するエラー、障害等を未然に防ぐ目的で行われる。

この検査に失敗した場合、以下のいずれかの修正を行わなければならない。

- 1.依存関係を明示的に記載する => composer.json の"require" 項目への追加
    - ソースコードが利用しているパッケージがcomposer.jsonに記載されていない場合、composer.jsonの "require" 項目にパッケージを追加する。
    - ソースコードが利用しているPHP拡張がcomposer.jsonに記載されていない場合、composer.jsonの "require" 項目にPHP拡張を追加する。
    - ※修正する際の記載方法等については、[Composerのドキュメント該当箇所](https://getcomposer.org/doc/04-schema.md#package-links) を参照すること。
- 2.暗黙的に依存しているソースコードを削除する
    - composer.jsonの "require" に依存関係が示されていないパッケージ、PHP拡張を利用しているソースコードを削除する。
    - または、use statementを用いて、利用しているパッケージ等の名前空間を適切に指定するよう、ソースコードを修正する。

## 040-phpcs.sh

[phpcs(PHP Code Sniffer)](https://github.com/squizlabs/PHP_CodeSniffer) による、コーディング標準(PSR-12)に適合しているかどうかの検査。

この検査に失敗した場合、検査をパスする状態となるようソースコードを修正しなければならない。

※本検査と同一設定でのphpcbf（030-phpcbf.sh）実行により、修正可能な誤りは自動的に修正されるため、開発担当者が修正を行う必要があるのは、phpcbfが自動で修正できない内容のみである。

## 050-maintainability.sh

phpcsを利用して独自に定義した、潜在的問題点の検査。主としてreliability、maintainability、readability、testabilityを維持する目的で行われる。

この検査に失敗した場合、検査をパスする状態となるようソースコードを修正しなければならない。

以下、詳細。

### メソッドの認知的複雑度検査

メソッドごとの認知的複雑度が、設定されたしきい値の範囲内であることを検査する。

※認知的複雑度の基本的な傾向として、ネストが深くなるほど高い数値となる。詳細ついては右記リンク参照。 [https://www.sonarsource.com/docs/CognitiveComplexity.pdf](https://www.sonarsource.com/docs/CognitiveComplexity.pdf)

### Requestクラスをメソッド引数に利用することの禁止

LaravelのRequestクラスに関するルール。Requestクラスを引数とするメソッドを定義することを禁止する。

例外として、app/Http/ 以下のディレクトリは対象外。

### Eloquentを継承するクラスを利用できるディレクトリの制限

LaravelのEloquentクラスに関するルール。以下の3つのディレクトリ以外では、Eloquentを継承するクラスの利用を禁止する。

- app/Gateway/Repository
- app/Models
- app/Query

### 複数のpublicメソッドを持つコントローラークラスの実装禁止

LaravelのControllerに関するルール。複数のpublic メソッドを持つコントローラークラスはコミットしてはならない。

コントローラークラスは、唯一のpublic メソッド __invoke()
のみを有する[シングルアクションコントローラー](https://readouble.com/laravel/10.x/ja/controllers.html#single-action-controllers) として実装すること。

## 051-strict-types.sh

phpcsを利用した、strict-types の定義を強制するための検査。

この検査に失敗した場合、以下参考例の通りにソースコードを修正し、 strict-types=1 を設定しなければならない。

```php
<?php
//PHPファイルの先頭に記載する
declare(strict_types=1);

``` 

- 参考: [厳密な片付け](https://www.php.net/manual/ja/language.types.declarations.php#language.types.declarations.strict)

## 060-phpmd-app.sh

[PHPMD（PHP Mess Detector）](https://phpmd.org/)
による潜在的問題点の検査。主としてreliability、maintainability、readability、testabilityを維持する目的で行われる。

詳細な検査内容については、設定ファイル、及び [PHPMDマニュアル](https://phpmd.org/rules/index.html) に記載されたRule内容を参照。

この検査に失敗した場合、以下のいずれかの対応を実施しなければならない。

- 1.ソースコードを修正する
- 2.検査基準を変更する
- 3.ソースコードコメントにアノテーションを追記することにより、警告を抑止する

※2または3の対応を実施する場合、メンテナ、または品質管理担当者と協議を行わなければならない。

## 080-larastan.sh

[phpstan](https://phpstan.org/user-guide/getting-started) による潜在的問題点の検査。 主としてreliability、testabilityを維持する目的で行われる。

この検査に失敗した場合、以下のいずれかの対応を実施しなければならない。

- 1.ソースコードを修正する
- 2.検査基準を変更する
- 3.ソースコードコメントにアノテーションを追記することにより、警告を抑止する

※2または3の対応を実施する場合、メンテナ、品質管理担当者と協議を行わなければならない。

