=== GeneratePress ===
Contributors: edge22
Donate link: https://generatepress.com/ongoing-development/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: two-columns, three-columns, one-column, right-sidebar, left-sidebar, footer-widgets, blog, e-commerce, flexible-header, full-width-template, buddypress, custom-header, custom-background, custom-menu, custom-colors, sticky-post, threaded-comments, translation-ready, rtl-language-support, featured-images, theme-options
Requires at least: 6.5
Requires PHP: 7.4
Tested up to: 6.8
Stable tag: 3.6.0

GeneratePress is a lightweight WordPress theme built with a focus on speed and usability.

== Description ==

GeneratePress is a lightweight WordPress theme built with a focus on speed and usability. Performance is important to us, which is why a fresh GeneratePress install adds less than 10kb (gzipped) to your page size.

We take full advantage of the block editor (Gutenberg), which gives you more control over creating your content.

If you use page builders, GeneratePress is the right theme for you. It is completely compatible with all major page builders, including Beaver Builder and Elementor.

Thanks to our emphasis on WordPress coding standards, we can boast full compatibility with all well-coded plugins, including WooCommerce.

GeneratePress is fully responsive, uses valid HTML/CSS, and is translated into over 25 languages by our amazing community of users.

A few of our many features include 60+ color controls, powerful dynamic typography, 5 navigation locations, 5 sidebar layouts, dropdown menus (click or hover), and 9 widget areas.

Learn more and check out our [powerful premium version](https://generatepress.com).

== Installation ==

= From within WordPress =
1. Visit "Appearance > Themes > Add New"
1. Search for "GeneratePress"
1. Install and activate

== Frequently Asked Questions ==

= Is GeneratePress Free? =
Yes! GeneratePress is a free theme, and always will be.

= Does GeneratePress have a pro version? =
It does! GeneratePress has a premium plugin which extends the available options in the theme.

You can learn more about GP Premium [here](https://generatepress.com/premium).

= Where can I find documentation? =
GeneratePress has extensive documentation you can find [here](https://docs.generatepress.com).

= Do you offer support? =
Definitely. We offer support for the free theme in the [WordPress.org forums](https://wordpress.org/support/theme/generatepress).

Premium customers have access to our very own [support forum](https://generatepress.com/support).

We try to answer all questions - free or premium - within 24 hours.

= Where can I find the theme options? =
All of our options can be found in the Customizer in 'Appearance > Customize'.

= Does GeneratePress have any widget areas? =
GeneratePress has up to 9 widget areas which you can add widgets to in Appearance > Widgets.

= How can I make my site look like your screenshot? =
If you want to replicate the screenshot you see on WordPress.org, please refer to [this article](https://docs.generatepress.com/article/replicating-the-screenshot/).

== License ==

GeneratePress is licensed under the GNU General Public License v2 or later

More details [here](http://www.gnu.org/licenses/gpl-2.0.html).

= Unsemantic Framework =

http://opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html

= Font Awesome =

Font License: SIL OFL 1.1 - http://scripts.sil.org/OFL
Code License: MIT License - http://opensource.org/licenses/mit-license.html

= classList =

By Eli Grey, http://eligrey.com
License: Dedicated to the public domain.
See https://github.com/eligrey/classList.js/blob/master/LICENSE.md

= selectWoo =

MIT License: https://github.com/woocommerce/selectWoo/blob/master/LICENSE.md

= TinyColor =

By Brian Grinstead, http://briangrinstead.com
MIT License: https://github.com/bgrins/TinyColor/blob/master/LICENSE

= React Select =
By Jed Watson
MIT License: https://github.com/JedWatson/react-select/blob/master/LICENSE

== Changelog ==

= 3.6.0 =
* Fix: Inability to add more than one font in the Font Manager
* Tweak: Improve accessibility of navigation search modal
* Tweak: Better support for full iframed editor
* Tweak: Use passive event listening for a11y script
* Tweak: Use `wp_print_inline_script_tag` for a11y script
* Tweak: Use `wp_add_inline_script()` for inline script variables

= 3.5.1 =
* Tweak: Revert addition of appearance-tools theme support
* Fix: Dropdown click conflict with off-canvas panel

= 3.5.0 =
* Feature: Add support for more core block options
* Feature: Add support for GPP Font Library in the Customizer
* Fix: Underlined buttons in the editor
* Tweak: Add minimal header/footer templates for future GPP site editor
* Tweak: Allow bottom margin value in custom typography elements
* Accessibility: Add role to back to top button
* Accessibility: Use h2 for comments title
* Accessibility: Add aria-controls to menu dropdowns
* Accessibility: Add aria-label to menu dropdown toggles
* Accessibility: Add proper roles to menu dropdown toggles
* Accessibility: Allow spacebar to open menu dropdowns

= 3.4.0 =

* Important: Require PHP 7.4 or later
* Accessibility: Add label to search modal input
* Feature: Allow CSS variables and string-based values in Typography
* Feature: Add read more label filters
* Fix: Mobile menu toggle alignment when navigation above/below header
* Fix: Disable nav search modal if using floats or font icons
* Fix: Remove unnecessary white-space from .site-title and .site-description elements
* Fix: `html` typography selector in the editor
* Fix: Content title color in editor
* Fix: Content width jump when loading editor
* Fix: Editor losing content width switching code/visual editor
* Fix: Remove prohibited attribute from header element
* Fix: Heading text color in the editor
* Fix: Wrong text domains

= 3.3.1 =

* Tweak: Update Customizer script dependencies to prevent WP 6.3 conflicts

= 3.3.0 =

* Feature: Add navigation search modal
* Fix: PHP 8.1 filter_input notice
* Fix: Comment fields PHP 8.1 notice
* Fix: Empty footer post meta
* Fix: PHP 8.1 warning in GeneratePress_Typography:get_css
* Fix: Color picker callback update not re-rendering the component
* Fix: Don't apply block margin to core Heading
* Fix: Editor width when changing previews
* Fix: Allow rgb() color values
* Fix: JS error when toggling empty mobile menu
* Fix: PHP notice when using SVG as normal and retina logo
* Fix: Color picker outline
* Tweak: Allow sub-menus to open using the spacebar
* Tweak: Increase .has- class specificity

= 3.2.4 =

* Fix: Kebab-case formatting for global colors variable names

= 3.2.3 =

* Fix: Global color picker positioning

= 3.2.2 =

* Fix: Typography system unit picker popover position
* Fix: Typography system state update possible infinite loop
* Fix: Editor content width when using large content padding values

= 3.2.1 =

* Fix: WooCommerce single product schema itemtype
* Fix: Post title font properties in the editor
* Fix: Error in Customizer when Google Fonts disabled

= 3.2.0 =

* Feature: Re-order global colors in the Customizer
* Feature: Add live preview to global color changes in Customizer
* Feature: Add font-style option to Typography
* Feature: Add text-decoration option to Typography
* Feature: Add generate_font_manager_show_google_fonts PHP filter
* Feature: Add generate_font_manager_system_fonts JS filter
* Feature: Add generate_font_manager_google_fonts JS filter
* Feature: Add generate_add_comment_date_link PHP filter
* Fix: Missing link underlines in the editor
* Fix: Code block width in the editor
* Fix: WooCommerce archive wrapper HTML attributes
* Fix: Google font API requests using a standalone numbers
* Fix: Customizer shortcut links in the GP Dashboard
* Fix: Check for logo dimension data
* Fix: Back to top iOS double-click issues
* Tweak: Use block_editor_settings_all to add editor CSS
* Tweak: Remove title attributes from logo and logo link
* Tweak: Remove excess screen reader text from post navigation
* Tweak: Improve editor width calculations based on your layouts
* Tweak: Improve check for is-dark-theme class
* Tweak: Change Google Font label in Font Manager

= 3.1.3 =

* Fix: Adjust editor block width selector to fix compatibility with GP Premium
* Fix: Missing editor styles when viewing tablet/mobile previews in Firefox
* Fix: Missing Google Fonts API request when viewing tablet/mobile previews in the editor

= 3.1.2 =

* Fix: Align-full alignment in the editor
* Fix: Missing editor text colors in responsive views

= 3.1.1 =

* Fix: Color picker UI in WP 5.9
* Fix: Translations using javascript
* Fix: Layout panel link inside the Start Customizing Dashboard

= 3.1.0 =

* New: Global color system
* New: Add all theme color options to free theme
* New: Re-build color options in the Customizer
* New: Dynamic typography system
* New: Underline links option
* New: Only load menu.js when needed
* New: generate_has_active_menu filter
* New: generate_before_loop hook
* New: Dynamic HTML attribute system
* New: React-based Dashboard
* New: generate_search_title_output filter
* New: generate_after_comment_author_name hook
* New: generate_show_comment_entry_meta filter
* Tweak: Only allow vertical comment form resizing
* Tweak: Move a11y javascript inline to the footer
* Tweak: Add aria-label attributes to elements that need them
* Tweak: Remove theme structure option for people using flexbox
* Tweak: Remove search result title from template
* Tweak: Add search result title using generate_before_loop hook
* Tweak: Remove aria-required attribute from comment form
* Tweak: Add required attribute to comment author/email fields if required
* Tweak: Move viewport head meta below the title meta
* Tweak: Optimize SVG icon HTML
* Tweak: Move generate_svg_icon_element before the "replace" icon definition
* Tweak: Change sub-menu box-shadow direction when sub-menu opens left
* Tweak: Replace sub-menu box-shadow with border when opening down
* Tweak: Remove query loop block margin
* Tweak: Use get_the_archive_description() instead of term_description()
* Fix: Missing search form button icon when using font icons
* Fix: Load comments CSS if comments exists even if new comments are disabled
* Fix: Sub-menu overlap using dropdown click

= 3.0.4 =

* Tweak: Apply default Group block padding to blocks in the content area only.

= 3.0.3 =

* Fix: is-dark-theme class in editor in WP 5.7
* Fix: Saving footer widget post meta in editor

= 3.0.2 =

* Fix: Missing logo when site title/tagline are empty but not disabled
* Fix: Widget content font-size value missing when using default
* Fix: Centered top bar text alignment on mobile
* Fix: Custom mobile-bar-items sizing not working on mobile
* Tweak: Only set margin-top of .entry-content

= 3.0.1 =

* Fix: Custom navigation search height
* Fix: Missing sub-menu on RTL sites with sub-menu set to open right
* Fix: RTL order of default flexbox mobile menu
* Fix: RTL sub-menu text alignment
* Fix: Elementor full width template when using flexbox
* Fix: editor-style.css location
* Fix: Navigation search when sticky navigation is activated
* Tweak: Add text-align: center; to centered header in flexbox
* Tweak: Center menu items in flex when nav aligned center
* Tweak: Remove float: right from navigation search toggle when centered
* Tweak: Remove justify-content: center from .site-content

= 3.0.0 =

* New: Flexbox layout option - see blog post for more info
* New: Default mobile header when using aligned nav + flexbox layout
* New: generate_before_do_template_part hook
* New: generate_after_do_template_part hook
* New: generate_do_template_part filter
* New: Better option migration system
* New: generate_post_date_show_updated_only filter
* New: generate_navigation_search_menu_item_output filter
* New: style-rtl.min.css and enqueue manually
* New: generate_load_child_theme_stylesheet filter
* New: generate_before_navigation hook
* New: generate_after_navigation hook
* New: generate_page_class filter
* New: generate_is_using_hatom filter
* New: generate_after_element_class_attribute filter
* New: generate_menu_bar_items hook
* New: generate_show_entry_header filter
* New: Container width default set to 1200
* New: Navigation location default set to float right
* New: Navigation color defaults updated
* New: Button color defaults updated
* New: Footer color defaults updated
* New: Site title font size default updated
* New: Search button added to search widget
* New: Archive post navigation design
* New: generate_comments_title_output filter
* New: generate_get_the_title_parameters filter
* New: generate_has_default_loop filter
* New: generate_localize_js_args filter
* New: is-left-sidebar and is-right-sidebar classes added to sidebars
* New: Add aria-label to dropdown menu arrows on mobile
* New: Hide pagination arrows from screen readers
* New: Prepend pagination numbers with "Page" for screen readers
* Fix: Close other sub-menus when opening a new one on touch devices
* Fix: Footer bar menu spacing on mobile
* Fix: Text aligned container width preview in Customizer when using full-width-content
* Fix: Remove disable content title toggle in editor if it doesn't apply to front-end
* Fix: One container margin based on default content padding
* Fix: Nav aligned left when using RTL languages
* Fix: Wide block alignment in the editor
* Tweak: Update screen-reader-text CSS
* Tweak: Remove all :visited references from dynamic CSS
* Tweak: Make sub-menu dropdown box-shadow harder
* Tweak: Remove content margin-top if it's the first child in parent
* Tweak: Remove featured image margin-top if it's the first child in parent
* Tweak: Only print entry-meta wrapper to page if it contains meta
* Tweak: Rebuild navigation search javascript
* Tweak: Remove all esc_attr() functions from CSS and escape entire output
* Tweak: Move all CSS and JS into assets folder
* Tweak: Break all CSS up into individual .scss files
* Tweak: Set SVG icons as default
* Tweak: Move font icon CSS into separate file
* Tweak: Load comments CSS only on pages that have comments
* Tweak: Remove speak CSS from font icons
* Tweak: Load top bar/footer bar/footer widget CSS separately if using flexbox layout
* Tweak: Remove display: inline from alignleft/right classes
* Tweak: Remove parent theme dependencies from styles
* Tweak: Fix footer widget default spacing
* Tweak: Remove HTML comments from end of elements
* Tweak: Combine a11y.js and menu.js
* Tweak: Add correct paragraph margin to block editor
* Tweak: Remove old migrations from 2.0 (font awesome, dynamic css cache, font family and blog post content)
* Tweak: Change Layout metabox option to select dropdowns
* Tweak: Change Page Builder Container label to Content Container
* Tweak: Remove itemprop attributes if microdata is turned off
* Tweak: Un-focus back to top button once the top is reached
* Tweak: Remove close nav search on document click
* Tweak: Set sub-menu open left on RTL languages by default
* Tweak: Remove mixed up alignleft/right classes when using RTL languages
* Tweak: Remove sub-menu open left CSS when using RTL languages
* Tweak: Use aria-label in back to top button instead of screen-reader-text
* Tweak: Hook comments template into generate_after_do_template_part
* Tweak: Use flexbox for author page header
* Tweak: Simplify navigation dropdown CSS
* Tweak: Set variable for get_body_class where necessary
* Tweak: Use separate SVGs for different arrow directions instead of CSS
* Tweak: Use class for navigation sub-menu direction
* Tweak: Clean up sub-menu direction CSS
* Tweak: Remove footer widget and header layout body classes when using flexbox
* Tweak: Close other sub-menus when another is opened
* Tweak: Inherit tagline/main nav/widget title/widget content/site footer font size if not set
* Tweak: Show name/email asterisk only if fields are required
* Tweak: Only remove margin-bottom from last element on page if it's a paragraph
* Tweak: Remove .wp-smiley CSS
* Tweak: Add single post navigation to generate_footer_entry_items filter
* Tweak: Hook archive post navigation into generate_after_loop hook
* Tweak: Use aria-label for read more links/buttons instead of screen reader text
* Tweak: Move microdata to generate_after_element_class_attribute where possible
* Tweak: Move back to top button CSS to dynamic CSS if enabled
* Tweak: Move navigation search CSS to dynamic CSS if enabled
* Tweak: Move dropdown-click CSS to dynamic CSS if enabled
* Tweak: Remove skip-link-focus.js
* Tweak: Disable old Beaver Builer full-width compat CSS when using flexbox layout
* Tweak: Remove CSS to disable comments link on single posts
* Tweak: Add featured-image class to singular featured images
* Tweak: Don't output body font family if it's the default that exists in stylesheet
* Tweak: Allow 0 value in dynamic CSS
* Tweak: Remove mobile navigation static CSS as it's added dynamically already
* Tweak: Improve checkMobile() javascript performance
* Tweak: Prevent font-size values from being set to 0
* Tweak: Replace deprecate .load() with on('load') in block-editor.js
* Tweak: Change navigation search line-height to 1
* Tweak: Reduce size of author archive avatar
* Tweak: Add padding-left to cancel comment reply link
* Tweak: Update navigation color and header presets
* Tweak: Add [type="search"] to .navigation-search input CSS selector
* Tweak: Better style GP core button in block editor
* Tweak: Improve comment cookie consent display across browsers
* Tweak: Add is-logo-image class to site logo
* Tweak: Remove type attribute from scripts and styles
* Tweak: Add margins to headings in the editor
* Template change: Removed generate_do_microdata() from sidebar.php and sidebar-left.php
* Template changes: Added generate_do_template_part() to all templates with a loop

= Earlier versions =

For the changelog of earlier versions, please refer to our [development log](https://generatepress.com/category/changelog/).
