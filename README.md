# Krayin CRM Number Formatter

This package allows you to configure the thousand separator format (period `.` or comma `,`) in **Krayin CRM** independently of the application's language.

## Features

- **Configurable**: Choose between "Dot (.)" (European format: `1.234,56`) or "Comma (,)" (US/English format: `1,234.56`) from the admin panel.
- **Language Independent**: Forces the number format regardless of the user's interface language locale.
- **Non-Invasive**: Overrides the core formatting logic using Laravel's service container without modifying core files.

## Installation

Since this is a local/private package, you need to tell Composer where to find it.

### 1. Add Repository to `composer.json`

Open the `composer.json` file in your Krayin root directory and add/update the `repositories` section:

```json
"repositories": [
    {
        "type": "path",
        "url": "packages/Vallory/KrayinFormatter",
        "options": {
            "symlink": true
        }
    }
],
```

*Note: If you have already a `packages/*/*` wildcard repository (standard in Krayin), you can skip this step if you place the package in `packages/Vallory/KrayinFormatter`.*

### 2. Require the Package

Run the following command in your terminal:

```bash
composer require vallory/krayin-formatter:@dev
```

### 3. Clear Cache (Optional but Recommended)

It's good practice to clear the configuration cache to ensure the new settings appear immediately:

```bash
php artisan config:clear
```

## Configuration

1.  Log in to the **Krayin Admin Panel**.
2.  Navigate to **Configuration** (icon in the bottom left) > **General**.
3.  Scroll down to find the **Number Formatting** section.
4.  Select your preferred **Thousand Separator**:
    - **Comma (,)** -> `1,234.56`
    - **Dot (.)** -> `1.234,56`
5.  Click **Save Configuration**.

## Uninstallation

To remove the package and revert to default Krayin formatting behavior:

```bash
composer remove vallory/krayin-formatter
```
