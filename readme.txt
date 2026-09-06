=== Retro Arcade Page Destroyer ===
Contributors: ksaldari
Tags: arcade, game, retro, widget, shooter
Requires at least: 5.0
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Turn your WordPress site into a retro arcade shooter. Destroy webpage contents with your ship. A modernized fork compatible with PHP 8+.

== Description ==

Turn your site into an interactive arcade battlefield. Click to activate and fly a retro arcade spaceship around your webpage, blasting apart elements and text.

The plugin is customizable, allowing you to add custom descriptions, images, and button triggers, as well as controlling exactly which pages the widget appears on.

This plugin is a modernized, independent fork of the classic "Asteroids Widget" by Eric Burger and Erik Rothoff Andersson. It has been completely refactored to meet modern WordPress coding standards and ensure full compatibility with PHP 8.0, 8.1, 8.2, and 8.3+.

== Installation ==

1. Upload the `retro-arcade-page-destroyer` folder to the `/wp-content/plugins/` directory (or upload the `.zip` file via **Plugins > Add New > Upload Plugin**).
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Navigate to **Appearance > Widgets** and add the **Asteroids** widget to your sidebar.
4. (Optional) Embed the game trigger anywhere on pages or posts using the shortcode `[asteroids]`.

== How to Play ==

Controls:
* **W / Up Arrow:** Thrust forward
* **A / S / D / Left & Right Arrows:** Steer and rotate the spaceship
* **Spacebar:** Fire bullets to destroy page elements
* **B:** Highlight breakable targets on the screen
* **Esc:** Quit game and exit back to standard webpage

== Frequently Asked Questions ==

= Does this version support PHP 8+? =
Yes. The fatal errors caused by deprecated functions (such as `create_function()`) and legacy constructors have been completely resolved.

= Where can I report issues? =
You can report bugs or contribute code on GitHub: https://github.com/krysgit/asteroids-widget

== Credits ==

* Original WordPress Plugin by Eric Burger (Electric Tree House).
* Original JavaScript game engine by Erik Rothoff Andersson.
* Arcade machine graphics by Alta Peterson.
* PHP 8+ modernization, security hardening, and maintenance by Krystalia Saldari.

== Changelog ==

= 1.0.0 =
* Forked from original Asteroids Widget.
* Fixed Fatal Error: Uncaught Error: Call to undefined function create_function() for PHP 8+ compatibility.
* Updated class constructor to standard __construct().
* Added security sanitization, escaping, and direct access guards.
* Added support for WordPress shortcode [asteroids].
