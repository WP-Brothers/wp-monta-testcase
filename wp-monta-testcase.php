<?php

declare(strict_types=1);

/**
 * Main plugin file for socialbrothers/wp-monta-testcase
 *
 * Plugin demonstrating dependency collision with prepackaged vendor
 *
 * @package SocialBrothers
 * @version 0.0.1
 *
 * @author  Social Brothers <backend@socialbrothers.nl>
 *
 * @wordpress-plugin
 * Plugin Name:       Monta Dependency Collision testcase
 * Plugin URI:        https://wpbrothers.nl
 * Description:       Plugin demonstrating dependency collision with prepackaged vendor
 * Version:           0.0.1
 * Requires PHP:      8.0.22
 * Author:            Social Brothers
 * Author URI:        https://socialbrothers.nl/
 * Update URI:        false
 */

/**
 * Loads composer autoloader based on circumstances.
 *
 * Looks for the right autoloader for the situation (Dev, local, wp-root).
 * Throws exception when autoload.php doesn't exist.
 *
 * @throws RuntimeException
 */
require_once __DIR__ . '/inc/bootstrap.php';
