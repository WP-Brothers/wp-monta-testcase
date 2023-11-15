# Monta Dependency Collision testcase

Plugin demonstrating dependency collision with prepackaged vendor

## Getting started

### Prerequisites

- PHP 8.0.22
- Composer `^2`
- Phive `^1`

### Installation

Add the private composer repository in the `repositories` array in your site `composer.json`.

Minimal site `composer.json` example:

```json
{
  "name": "site/example",
  "repositories": [
    {
      "type": "composer",
      "url": "https://composer.sbdev.nl/"
    }
  ],
  "require": {
    "composer/installers": "^1",
    "socialbrothers/wp-monta-testcase": "*"
  },
  "extra": {
    "installer-paths": {
      "wp-content/plugins/{$name}/": [
        "type:wordpress-plugin"
      ]
    }
  }
}
```

> A composer managed WordPress environment is required to install this plugin through composer.
> This package is hosted on the private SocialBrothers [composer repo](https://composer.sbdev.nl), to install from this
> repository a valid `auth.json` with credentials for this server is required.


```sh
composer require socialbrothers/wp-monta-testcase
```

## Usage

...

## Development

### Note on development dependencies

To minimize the chance of namespace or dependency collision some dev-dependencies are provided as phar archives using [phive](https://phar.io/), which is an alternative package manager that focusses on providing dependencies as phar archives.

Install Phive by running these steps in your terminal.

```sh
wget -O phive.phar https://phar.io/releases/phive.phar
wget -O phive.phar.asc https://phar.io/releases/phive.phar.asc
gpg --keyserver hkps://keys.openpgp.org --recv-keys 0x9D8A98B29B2D5D79
gpg --verify phive.phar.asc phive.phar
chmod +x phive.phar
sudo mv phive.phar /usr/local/bin/phive
```

For alternative installation methods check [phar.io](https://phar.io/).

### Running unit tests

The shell command shown below will execute the default PHPUnit testsuite with code coverage as defined in `phpunit.xml`.

```sh
composer test
```

### Formatting project

The shell command shown below will run php-cs-fixer with the config defined in `.php-cs-fixer.php`.

```sh
composer format
```

### Analysing project

The shell command shown below will analyse the project using phpstan with the config defined in `phpstan.neon`.

```sh
composer analyse
```
