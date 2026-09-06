# Retro Arcade Page Destroyer

Turn your WordPress site into an interactive retro arcade shooter. Launch a spaceship and blast apart webpage elements, blocks, and typography.

This repository is a modernized, secure fork of the classic "Asteroids Widget" by Eric Burger (Electric Tree House) and Erik Rothoff Andersson, updated for modern WordPress coding standards and **PHP 8.0, 8.1, 8.2, and 8.3+**.

---

## Game Controls
* **W / Up Arrow:** Thrust forward
* **A / S / D / Left & Right Arrows:** Steer and rotate
* **Spacebar:** Fire bullets
* **B:** Highlight breakable targets
* **Esc:** Quit game

---

## Shortcode Attributes

Embed the launcher anywhere using the `[asteroids]` shortcode:

| Attribute | Options | Default | Description |
| :--- | :--- | :--- | :--- |
| `image` | `none`, `image-1`, `image-2`, `image-3`, `image-4`, `image-5`, `image-6` | `none` | Select launcher graphic (e.g., rocket or arcade cabinets) |
| `button` | `push-1`, `text-1`, `none` | `push-1` | Select trigger button style or disable it completely |
| `bullet_color` | `yellow`, `""` | `""` | Change bullet trace color to yellow |

### Examples
* **Rocket graphic only (no button):**
  ```text
  [asteroids image="image-3" button="none"]
