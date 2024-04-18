#!/bin/bash
# プロジェクトルートに移動
cd `dirname $0`/..

# package name
read -p "Please enter package name.(e.g., git-balocco/package-name):" pakage_name
composer config name $pakage_name
echo "Package name in 'composer.json' updated successfully."


# composer.json の内容を変更して、phpunit を10に下げる
# 11だと後続のphp-qa-utilsに含まれている maglnet/composer-require-checker が入らないため
sed -i 's/"phpunit\/phpunit": "^11.0"/"phpunit\/phpunit": "^10.0"/' composer.json

# qa-utils
composer config repositories.php-qa-utils vcs https://github.com/git-balocco/php-qa-utils.git
composer config repositories.phpcs-wp-theme-sniff vcs https://github.com/git-balocco/phpcs-wp-theme-sniff.git
composer config repositories.phpcs-sniffs vcs https://github.com/git-balocco/phpcs-sniffs.git
composer config repositories.common-structures vcs https://github.com/k-yamamoto-balocco/common-structures.git

# php-qa-utils
composer require --dev --no-install --no-scripts git-balocco/php-qa-utils

# install
composer install


# 品質管理系の設定ファイル作成
vendor/bin/balocco-qa init
vendor/bin/balocco-qa publish-item sa-for-laravel-strict sa
vendor/bin/balocco-qa publish-item mm-for-laravel-strict mm

# env-documentator
composer config repositories.laravel-env-documentator vcs https://github.com/k-yamamoto-balocco/laravel-env-documentator.git
composer require --dev k-yamamoto-balocco/laravel-env-documentator

# laravel-ui-cli
composer config repositories.laravel-ui-cli vcs https://github.com/k-yamamoto-balocco/laravel-ui-cli.git
composer require --dev k-yamamoto-balocco/laravel-ui-cli

# php-flasher/flasher-notyf-laravel
composer require php-flasher/flasher-notyf-laravel

#
echo "laravel/laravel,git-balocco/php-qa-utils のインストール、セットアップが完了したことを確認してください。"
echo "確認が完了したら、ファイルの変更内容を確認してコミットしてください。"
