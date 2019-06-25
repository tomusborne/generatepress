=== GeneratePress ===
Contributors: edge22
Donate link: https://generatepress.com/ongoing-development/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: two-columns, three-columns, one-column, right-sidebar, left-sidebar, footer-widgets, blog, e-commerce, flexible-header, full-width-template, buddypress, custom-header, custom-background, custom-menu, custom-colors, sticky-post, threaded-comments, translation-ready, rtl-language-support, featured-images, theme-options
Requires at least: 4.5
Tested up to: 5.2
Stable tag: 2.3.2

GeneratePress is a lightweight WordPress theme built with a focus on speed and usability.

== Description ==

GeneratePress is a lightweight WordPress theme built with a focus on speed and usability. Performance is important to us, which is why a fresh GeneratePress install adds less than 15kb (gzipped) to your page size.

We take full advantage of the new block editor (Gutenberg), which gives you more control over creating your content.

If you use page builders, GeneratePress is the right theme for you. It is completely compatible with all major page builders, including Beaver Builder and Elementor.

Thanks to our emphasis on WordPress coding standards, we can boast full compatibility with all well-coded plugins, including WooCommerce.

GeneratePress is fully responsive, uses valid HTML/CSS and is translated into over 25 languages by our amazing community of users.

A few of our many features include microdata integration, 9 widget areas, 5 navigation locations, 5 sidebar layouts, dropdown menus (click or hover) and navigation color presets.

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

== Changelog ==

= 2.3.2 =

Release date: June 25, 2019

* Fix: Don't include font icon requests in cached CSS

= 2.3.1 =

Release date: June 25, 2019

* Fix: Touch issue with sub-menus using "Click - Menu Item" option

= 2.3 =

Release date: June 18, 2019

* New: Add SVG icon option
* New: Add option to inline the logo and site branding
* New: Add combine CSS option
* New: Add container alignment option
* New: Add generate_header_entry_meta_items filter for defining/ordering header entry meta
* New: Add generate_footer_entry_meta_items filter for defining/ordering footer entry meta
* New: Add generate_header_items_order filter to order header elements
* New: Add wp_body_open hook
* New: Add generate_after_primary_menu hook
* New: Add generate_mobile_menu_media_query filter
* New: Add generate_after_loop hook
* New: Add generate_show_block_editor_styles filter
* New: Add generate_google_font_display filter
* New: Add support for future mobile separating space option
* Tweak: Remove footer widget placeholders
* Tweak: Properly filter comment_form() defaults
* Tweak: Check for container_class variable existence
* Tweak: Align header to center on mobile even if aligned right
* Tweak: Check for option existence in generate_get_option()
* Tweak: Simplify separate container margin CSS
* Tweak: Make navLinks a11y selector more specific
* Tweak: Hook archive description in so it can be moved
* Tweak: Set X-UA-Compatible in wp_headers filter
* Tweak: Move Layout metabox to the sidebar by default
* Tweak: Use generate_not_mobile_menu_media_query filter in nav drop point
* Tweak: Target headings in blocks not necessarily in core heading block
* Tweak: Increase tap targets of entry meta on mobile
* Tweak: Remove negative margin from align-wide/full items when they're first block
* Fix: generate_search_label filter
* Fix: Sub-menu direction in right sidebar
* Fix: Heading selector in block editor
* Fix: Sub-menu dropdown on tablets/touch screens
* Fix: Sub-menu dropdown click issue when no menu location is set

= 2.2.2 =

Release date: January 30, 2019

* New: Add support for responsive embeds (videos etc..)
* Fix: Background/text color conflict in block editor if content background is using rgba
* Fix: Remove aria-expanded attribute from menu dropdown arrows when no menu is set
* Fix: Notice in block editor when h5 font size is set
* Fix: Notice if right/left content padding values are non-numeric
* Fix: Microdata spelling of WPSideBar
* Fix: Align-full alignment issue in block editor when Gutenberg plugin is active
* Fix: Shortcode block label text color when using light text
* Fix: Content title color in Gutenberg while in code editor

= 2.2.1 =

Release date: November 21, 2018

* Fix: Change h4-h6 margin-bottom back to 20px
* Fix: Prevent content link option from applying to block editor button
* Tweak: Change dropdown menu arrow role when no menu is set
* Tweak: Replace last generate_get_setting() instance with generate_get_option()

= 2.2 =

Release date: November 19, 2018

* New: Sub-menu direction option
* New: Floated navigation drop point option
* New: Logo width option
* New: Content title color option
* New: Blog post title color option
* New: H1-H3 typography options
* New: generate_comment_form_title filter
* New: Header Presets control inside the Customizer
* New: Navigation Color Presets control inside the Customizer
* New: generate_entry_meta_post_types filter
* New: generate_footer_meta_posts_types filter
* New: Add paragraph bottom margin to Gutenberg blocks
* New: Add .alignwide and .alignfull class for Gutenberg blocks
* New: Styling for Gutenberg gallery block
* New: Add frontend styling to Gutenberg editor
* New: Add defaults for H1-H3 bottom margin options
* New: generate_show_default_sidebar_widgets filter
* New: generate_schema_type filter
* New: generate_{context}_microdata filters
* Tweak: Output theme microdata using generate_do_microdata()
* Tweak: Replace individual element class functions with generate_do_element_classes()
* Tweak: Major PHP code cleanup
* Tweak: Replace generate_get_setting() with generate_get_option()
* Tweak: Remove default text-align: left from site header
* Tweak: Only add navigation alignment class to body if necessary
* Tweak: Major style.css cleanup
* Tweak: Remove different sub-menu width if in sidebar
* Tweak: Set navigation search height (fixes full height nav search on mobile/in sidebars)
* Tweak: Change Delete Customizer Settings button text to Reset
* Tweak: Add quick Customize links to GP Dashboard
* Tweak: Give H4-H6 elements the paragraph bottom margin
* Tweak: Don't close mobile menu when item is tapped
* Tweak: Simplify a11y outline script
* Tweak: Keep mobile sub-menus open if mobile toggle is closed
* Tweak: Replace default sidebar widget content in template files with generate_do_default_sidebar_widgets()
* Tweak: Clean up extra spaces in footer class attribute
* Fix: screen-reader-text class conflicts with some plugins
* Deprecated: generate_get_setting()
* Deprecated: generate_right_sidebar_class()
* Deprecated: generate_get_right_sidebar_class()
* Deprecated: generate_left_sidebar_class()
* Deprecated: generate_get_left_sidebar_class()
* Deprecated: generate_content_class()
* Deprecated: generate_get_content_class()
* Deprecated: generate_header_class()
* Deprecated: generate_get_header_class()
* Deprecated: generate_inside_header_class()
* Deprecated: generate_get_inside_header_class()
* Deprecated: generate_container_class()
* Deprecated: generate_get_container_class()
* Deprecated: generate_navigation_class()
* Deprecated: generate_get_navigation_class()
* Deprecated: generate_inside_navigation_class()
* Deprecated: generate_menu_class()
* Deprecated: generate_get_menu_class()
* Deprecated: generate_main_class()
* Deprecated: generate_get_main_class()
* Deprecated: generate_footer_class()
* Deprecated: generate_get_footer_class()
* Deprecated: generate_inside_footer_class()
* Deprecated: generate_top_bar_class()
* Deprecated: generate_body_schema()
* Deprecated: generate_article_schema()

= 2.1.4 =

Release date: August 21, 2018

* Tweak: Update theme screenshot to be within new WordPress.org rules

= 2.1.3 =

Release date: July 3, 2018

* Tweak: Set blog index content to show excerpts by default
* Tweak: Darken default post meta colors for better contrast (a11y)
* Tweak: Darken default site tagline color for better contrast (a11y)
* Tweak: Add slight opacity to post meta icons
* Tweak: Set post meta font size to 100% on mobile (SEO)
* Tweak: Various WP Coding Standard tweaks
* Tweak: Update default copyright message
* Tweak: Reduce author archives avatar margin

= 2.1.2 =

Release date: May 16, 2018

* Tweak: Add support for new comment cookie checkbox in WP 4.9.6

= 2.1.1 =

Release date: May 7, 2018

* Tweak: Improve baseline of theme icons
* Tweak: Prevent JS error if back to top button HTML doesn't exist
* Fix: Mobile menu item alignment on RTL sites
* Fix: Clearing issue in full width footer bar areas

= 2.1 =

Release date: May 2, 2018

* New: Structured data to comments
* New: aria-label to sidebar navigation mobile menu
* New: Update all theme icons
* New: generate_metabox_tabs filter
* New: generate_after_footer hook
* New: generate_before_comments_container hook
* Tweak: Simplify mobile menu CSS
* Tweak: Load updated date before published date
* Tweak: Force array in Layout metabox to prevent PHP notices
* Tweak: Use https for schema.org references
* Tweak: Replace wildcard CSS selectors with specific selectors
* Tweak: Remove list item bullets in sidebar and footer widgets only
* Tweak: Make button/input line height consistent with link buttons
* Tweak: Add version to database for future migrations
* Tweak: Move back to top button to generate_after_footer
* Tweak: Remove focus class from menu items on click if leaving site
* Tweak: Keep tab focus inside navigation search when open
* Tweak: Remove roles from sidebars
* Fix: Sidebar sub-menu positioning after click
* Fix: Rare Customizer JS error related to typography
* Fix: Various small W3 errors
* Fix: Navigation aria-hidden issue
* Remove: Font Awesome Essentials HTTP request
* Remove: dropdown.js HTTP request
* Remove: IE6 CSS
* Remove: Secondary navigation CSS added to GPP 1.6
* Remove: Secondary navigation JS

= 2.0.2 =

Release date: January 17, 2018

* Fix: Double tap issue in sub-menus on iOS devices
* Fix: Secondary nav sub-menu positioning in sidebars

= 2.0.1 =

Release date: December 14, 2017

* Fix: PHP notice in Customizer using multisite
* Fix: Retina logo container width in Firefox
* Fix: RTL dropdown menu issue
* Fix: undefined .closest() error
* Fix: Mobile sub-menu issue when no theme location is set
* Fix: Various small dropdown menu issues

= 2.0 =

Release date: December 6, 2017

* New: Full web accessibility
* New: All jQuery replaced with vanilla javascript
* New: System stack font set to default
* New: H6 typography options
* New: Option to turn on Font Awesome essentials
* New: Font Awesome set to essentials by default
* New: Retina logo option
* New: Cache dynamic CSS
* New: Option to enable/disable dynamic CSS caching
* New: Merge all separate metaboxes into one master metabox
* New: generate_dashboard_page_capability filter
* New: generate_dashboard_inside_container hook
* New: generate_dashboard_after_header hook
* New: generate_after_primary_content_area hook
* New: generate_show_post_navigation filter
* Tweak: PHP performance profiled and improved
* Tweak: generate_sidebars hook removed ** Update your child themes *
* Tweak: Style select inputs the same as other inputs
* Tweak: Archive titles same font size as other h1 elements
* Tweak: Add accessibility to read more links
* Tweak: Add alt tag to featured images
* Tweak: Remove title tag from featured images
* Tweak: Make mobile menu keyboard accessible
* Tweak: Make dropdown menu types keyboard accessible
* Tweak: Make dropdown toggle arrow larger on mobile
* Tweak: Load style.min.css instead of style.css
* Tweak: Clean up minified Font Awesome file
* Tweak: Comments title screen reader text set to h2
* Tweak: Remove margin from last author info paragraph
* Tweak: Adjust mobile menu icon position
* Tweak: Load admin-specific files in the admin only
* Tweak: Move skip to content link into hook and remove from header.php
* Tweak: Add screen reader labels to comment form fields
* Tweak: Change widget titles to h2 elements
* Tweak: Remove existing separate meta boxes
* Tweak: File structure completely re-organized
* Tweak: Code re-written to adhere to WordPress coding standards
* Tweak: Fix mobile nav search position on RTL sites
* Tweak: Make footer bar menu widget RTL compatible
* Tweak: Set comment website field as URL input type
* Tweak: Set comment email field as email input type
* Tweak: Use WP defaults for comment must_log_in and logged_in_as messages
* Tweak: Fix admin notice position in GP Dashboard
* Tweak: Let WP figure out featured image alt attribute
* Fix: Button text color in content when content link is set
* Fix: Left aligned footer bar alignment
* Fix: Spacing when sticky nav is activated
* Fix: Header alignment in RTL languages
* Fix: Tablet/desktop grid bug
* Fix: Header inner width live preview bug
* Deprecated: generate_get_min_suffix()
* Deprecated: generate_add_layout_meta_box()
* Deprecated: generate_show_layout_meta_box()
* Deprecated: generate_save_layout_meta()
* Deprecated: generate_add_footer_widget_meta_box()
* Deprecated: generate_show_footer_widget_meta_box()
* Deprecated: generate_save_footer_widget_meta()
* Deprecated: generate_add_page_builder_meta_box()
* Deprecated: generate_show_page_builder_meta_box()
* Deprecated: generate_save_page_builder_meta()
* Deprecated: generate_add_de_meta_box()
* Deprecated: generate_show_de_meta_box()
* Deprecated: generate_save_de_meta()
* Deprecated: generate_add_base_inline_css()
* Deprecated: generate_color_scripts()
* Deprecated: generate_typography_scripts()
* Deprecated: generate_spacing_scripts()
* Deprecated: generate_leave_reply
* Deprecated: generate_cancel_reply

= Earlier versions =

For the changelog of earlier versions, please refer to our [development log](https://generatepress.com/category/development/).
