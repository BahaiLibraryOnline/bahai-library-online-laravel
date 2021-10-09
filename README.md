# Bahai-Library-Online
Rebuild of the legacy bahai-library.com site in Laravel

## Style

### [PHPInsights][]
To correct the code automatically:

```shell
php artisan insights --fix -n
```

To review code that does not follow the standard:

```shell
php artisan insights --no-interaction
```
### [PHPCS][]
To correct the code automatically:

```shell
vendor/bin/phpcbf .
```

To review code that does not follow the standard:

```shell
vendor/bin/phpcs .
```
## Static analysis

### [PHPStan][]
To detect bugs and errors in code using [larastan]:
```shell
php vendor/bin/phpstan analyse -v
```
### [Rector]

To detect if code needs to be refactored or upgraded:
```shell
php vendor/bin/rector process --dry-run
```
To refactor and upgrade the code:
```shell
php vendor/bin/rector process
```

### Run all tools
Run using composer:
```shell
composer dev:build
```

[PHPInsights]: https://phpinsights.com/
[PHPCS]: https://github.com/squizlabs/PHP_CodeSniffer
[PHPStan]: https://github.com/phpstan/phpstan
[Larastan]: https://github.com/nunomaduro/larastan
[Rector]: https://github.com/rectorphp/rector
