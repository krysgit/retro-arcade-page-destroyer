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

Turn your site into an interactive arcade battlefield. Click to launch and fly a retro arcade spaceship around your webpage, blasting apart elements, headings, and text.

The plugin offers full flexibility: embed it anywhere using shortcodes with customizable graphic triggers, or use the dedicated WordPress sidebar widget.

This plugin is a modernized, independent fork of the classic "Asteroids Widget" by Eric Burger and Erik Rothoff Andersson. It has been refactored for modern WordPress security standards and tested for full PHP 8.0, 8.1, 8.2, and 8.3+ compatibility.

== How to Play ==

Controls:
* **W / Up Arrow:** Thrust spaceship forward
* **A / S / D / Left & Right Arrows:** Steer and rotate ship
* **Spacebar:** Fire bullets to destroy webpage elements
* **B:** Highlight breakable targets on screen
* **Esc:** Quit game and return to standard webpage

== Shortcode Usage ==

Use the `[asteroids]` shortcode anywhere in your content, block editor, or Elementor Shortcode widget.

Available attributes:
* `image`: `none` (default), `image-1` (Classic Target), `image-2` (Hover Effect), `image-3` (Rocket), `image-4` (Red Cabinet), `image-5` (Yellow Cabinet), `image-6` (Black Cabinet).
* `button`: `push-1` (default button), `text-1` (text link), or `none` (hides button).
* `bullet_color`: Leave empty for default or set to `yellow`.

Examples:
* Launch with a Rocket icon and no button:
  `[asteroids image="image-3" button="none"]`
* Launch with Red Arcade cabinet and yellow bullets:
  `[asteroids image="image-4" button="none" bullet_color="yellow"]`
* Text link only:
  `[asteroids button="text-1" image="none"]`

== Installation ==

1. Upload the `retro-arcade-page-destroyer` folder to the `/wp-content/plugins/` directory (or upload the `.zip` file via **Plugins > Add New > Upload Plugin**).
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Add the launcher via the `[asteroids]` shortcode or navigate to **Appearance > Widgets** to use the **Retro Arcade Destroyer** widget.

== Frequently Asked Questions ==

= Does this version support PHP 8+? =
Yes. All fatal errors from deprecated functions (such as `create_function()`) and legacy PHP constructors have been resolved.

= Where can I report bugs or contribute? =
Report issues and contribute code on GitHub: https://github.com/krysgit/retro-arcade-page-destroyer

== Credits ==

* Original WordPress Plugin by Eric Burger (Electric Tree House).
* Original JavaScript game engine by Erik Rothoff Andersson.
* Arcade machine graphics by Alta Peterson.
* PHP 8+ modernization, shortcode enhancements, and maintenance by Krystalia Saldari.

== Changelog ==

= 1.0.0 =
* Forked from original Asteroids Widget.
* Fixed Fatal Error: Uncaught Error: Call to undefined function create_function() for PHP 8+ compatibility.
* Updated widget constructor to standard __construct().
* Added security sanitization, output escaping, and direct access guards.
* Added custom attributes to the [asteroids] shortcode (image, button, bullet_color).
