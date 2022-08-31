# Conventional Changelog Checker

## Introduction
This library was build to parse a recent changelog file which was generated using the [marcocesarato/php-conventional-changelog](https://github.com/marcocesarato/php-conventional-changelog) PHP package.

So far none of the configuration works outside of the initial settings however there are plans to read the existing `.changelog` configuration file to attempt to parse it.

## Contributing
This application uses [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/) in order to assist in version management. Therefore, we need to ensure that all commits conform to this standard.

## Automated Testing
This CLI tool is built on top of the [Laravel Zero](https://laravel-zero.com/) Framework and uses [Pest](https://pestphp.com/) for testing.

To run the suite, make sure composer dependencies have been installed then run

```
vendor/bin/pest
```
