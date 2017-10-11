# Base Theme for WordPress

This is a very basic theme/plugin combination for starting out a new build. Front-end styles and scripts use a Gulp build process with SCSS styles. This is not a theme framework or "all-in-one" theme builder – it is a set of templates and processes meant to cut down on project setup time.

## Requirements
If running the accompanying plugin, PHP v5.3.2 or higher is required.

## Theme Setup
1. Rename the `base` theme directory
2. Rename the theme declaration in assets/scss/style.scss
3. Install the necessary node modules by running `npm install` in the theme's directory.
4. Start Gulp by running `gulp` in the theme's directory

## Plugin Setup
1. Rename the `base` plugin directory
2. Rename the namespace declaration in `composer.json`
3. Rename namespace in classes under `app/`
4. Run `composer install` to build the autoloader
5. Add post types/taxonomies as needed in their respective classes