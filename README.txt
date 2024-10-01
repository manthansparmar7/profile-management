
---

## `readme.txt` (for WordPress.org)

```txt
=== Profile Management ===
Contributors: manthansparmar7
Tags: profiles, HR, hiring, profile management, ajax filtering
Requires at least: 5.0
Tested up to: 6.0
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
The Profile Management plugin is a powerful WordPress tool designed to streamline the hiring process. It enables HR professionals and hiring personnel to efficiently manage and evaluate candidate profiles, enhancing the overall recruitment experience.

== Purpose ==
The purpose of the Profile Management plugin is to simplify and improve the hiring process by providing a centralized platform for managing candidate profiles. This plugin allows users to quickly search, sort, and filter profiles, ensuring that the recruitment process is efficient and effective.

== Features ==
* Custom Post Type (CPT) for managing candidate data.
* Capture and display essential information about candidates, such as skills, education, and years of experience.
* Efficient filtering options to streamline the hiring process.
* AJAX-based filtering for seamless user experience.
* Shortcode: `[profile_listing]` to display the profile listing on any page or post.

== Installation ==
1. Download the plugin files.
2. Rename the folder from `profile-management-master` to `profile-management`.
3. Upload the plugin folder to the `/wp-content/plugins/` directory.
4. Activate the plugin from the 'Plugins' menu in WordPress.
5. A new Custom Post Type called **Profile** will be created for managing candidate data.

== Usage ==
After activating the plugin:
1. Navigate to the **Profile** menu in your WordPress admin dashboard.
2. Click on **Add New** to create a new candidate profile.
3. To display the profile listing on a page or post, use the shortcode `[profile_listing]`.

== Dummy Data for Testing ==
To make testing easier, we have provided a dummy data XML file. You can find it in the `sample-data` folder.

== How to Import Dummy Data ==
1. Go to **Tools > Import** in your WordPress admin dashboard.
2. Select **WordPress** from the list of importers (install it if needed).
3. Upload the `dummy-data.xml` file and assign it to the appropriate user.
4. Click **Submit** to import the sample data.

== Coding Standards ==
The Profile Management plugin follows **Object-Oriented Programming (OOP)** methodologies. It adheres to **PHP_CodeSniffer (PHPCS)** and **PHP Code Beautifier and Fixer (PHPCBF)** coding standards for **WordPress VIP** to ensure high-quality, maintainable, and consistent code.

== Development Status ==
**Current Phase:** The plugin is still in the development and enhancement phase. The initial release is available, and we are actively working on adding new features and improvements. Feedback and suggestions are welcomed.
