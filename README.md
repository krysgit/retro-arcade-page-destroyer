# Retro Arcade Page Destroyer

Turn your WordPress site into an interactive retro arcade shooter. Click to launch the ship and destroy webpage contents by flying around and blasting them.

This repository contains a modernized, secure fork of the classic "Asteroids Widget" by Eric Burger (Electric Tree House) and Erik Rothoff Andersson, fully updated for modern WordPress standards and **PHP 8.0, 8.1, 8.2, and 8.3+**.

---

## Features
* Classic arcade vector gameplay directly on your WordPress pages.
* Multiple button and retro arcade machine triggers.
* Optional custom backgrounds and auto-formatting.
* Embed anywhere using the [asteroids] shortcode or as a Sidebar Widget.
* Zero fatal errors on PHP 8+.
* Cleaned of insecure functions (eval removed, proper escaping & sanitization).

---

## Requirements
* WordPress: 5.0 or higher
* PHP: 7.4 to 8.3+
* License: GPLv2 or later

---

## Installation

### Manual Upload (.zip)
1. Download the latest .zip release from the Releases section.
2. In your WordPress Admin, go to Plugins > Add New > Upload Plugin.
3. Select the .zip file and click Install Now.
4. Click Activate Plugin.

### Widget Setup
1. Go to Appearance > Widgets.
2. Add the Asteroids Widget to your preferred sidebar or widget area.
3. Configure your display rules, images, and button styles.

### Shortcode
Add the trigger anywhere in your post or page content using:
[asteroids]

---

## Changelog

### 1.0.0
* Modernized fork compatible with PHP 8+.
* Fixed fatal errors caused by deprecated functions.
* Updated class constructors to standard __construct().
* Added output escaping, sanitization, and security guards.
* Added shortcode support.

---

## Credits & License
* Original Plugin: Eric Burger (Electric Tree House)
* Original Game Script: Erik Rothoff Andersson
* PHP 8+ Modernization & Fork Maintainer: Krystalia Saldari (https://github.com/krysgit)
* License: Distributed under the GNU General Public License v2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html).
