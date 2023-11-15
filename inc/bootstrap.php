<?php

declare(strict_types=1);

namespace SocialBrothers;

use RuntimeException;

use function define;
use function defined;
use function dirname;
use function is_file;

use const PATHINFO_EXTENSION;
use const PHP_URL_HOST;

(static function (): void {
    try {
        /**
         * Conditionally load composers autoload.php, based on its location.
         * Which could be either:
         * In the plugin root during local development.
         * In the WordPress root when installed as wp plugin through composer.
         *
         * @throws RuntimeException
         */
        (static function (): void {
            $paths = [dirname(__DIR__) . '/'];

            if (defined('ABSPATH')) {
                $paths[] = ABSPATH;
            }

            foreach ($paths as $path) {
                if (is_file($path .= 'vendor/autoload.php')) {
                    include_once $path;

                    return;
                }
            }

            throw new RuntimeException('Couldn\'t find autoload.php, make sure you have run `composer install`.');
        })();
    } catch (RuntimeException $e) {
        if (! defined('ABSPATH')) {
            throw $e;
        }

        wp_die($e->getMessage());
    }

    /**
     * Sets 'WP_ENV' constant based on the current url.
     * Checks the domain extension either of the following will be considered development:
     * - `.local` for LocalWP
     * - `.test` for `laravel/valet`.
     *
     * @see https://localwp.com/
     * @see https://laravel.com/docs/9.x/valet
     */
    if (defined('ABSPATH') && (! defined('WP_ENV') || ! defined('WP_ENVIRONMENT_TYPE'))) {
        $env = (static function (): string {
            $extension = pathinfo(
                parse_url(get_option('siteurl', ''), PHP_URL_HOST),
                PATHINFO_EXTENSION
            );

            return 1 === preg_match('/^(test|local)$/D', $extension)
                ? 'development'
                : 'production';
        })();

        if (! defined('WP_ENV')) {
            define('WP_ENV', $env);
        }

        if (! defined('WP_ENVIRONMENT_TYPE')) {
            define('WP_ENVIRONMENT_TYPE', $env);
        }
    }
})();
