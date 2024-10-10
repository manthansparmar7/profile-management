# Profile Management

**Description:** The Profile Management plugin is a powerful WordPress tool designed to streamline the hiring process. It enables HR professionals and hiring personnel to efficiently manage and evaluate candidate profiles, enhancing the overall recruitment experience.

## Table of Contents
- [Purpose](#purpose)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Dummy Data for Testing](#dummy-data-for-testing)
- [Coding Standards](#coding-standards)
- [Development Status](#development-status)

## Purpose
The purpose of the Profile Management plugin is to simplify and improve the hiring process by providing a centralized platform for managing candidate profiles. This plugin allows users to quickly search, sort, and filter profiles, ensuring that the recruitment process is efficient and effective.

## Features
- **Custom Post Type (CPT)**: Creates a new CPT called **Profile** for managing candidate data.
- **Comprehensive Profile Details**: Capture and display essential information about candidates, including skills, education, years of experience, and other relevant data.
- **Efficient Filtering**: Users can search profiles based on specific criteria, streamlining the hiring process.
- **AJAX-based Filtering**: Experience seamless filtering of profiles without page reloads, improving user experience.
- **Shortcode Support**: Easily display the profile listing on any page or post using the shortcode: [profile_listing].

## Installation
To install the Profile Management plugin, follow these steps:

1. **Download the Plugin Files**: Obtain the plugin files from the repository.
2. **Rename the Folder**: After downloading, rename the folder from profile-management-master to profile-management.
3. **Upload to WordPress**: Upload the plugin folder to the /wp-content/plugins/ directory of your WordPress installation.
4. **Activate the Plugin**: Go to the 'Plugins' menu in your WordPress dashboard and activate the Profile Management plugin.
5. **Create Custom Post Type**: A new Custom Post Type called **Profile** will be created for managing candidate data.

## Usage
After activating the plugin, you can begin adding candidate profiles:

1. Navigate to the **Profile** menu in your WordPress admin dashboard.
2. Click on **Add New** to create a new candidate profile.
3. Fill in the candidate's details as required.
4. To display the profile listing on a page or post, use the shortcode:
   [profile_listing]

## Dummy Data for Testing

To make testing easier, we have provided a dummy data XML file. You can find it in the `sample-data` folder:

- [Download dummy-data.xml](sample-data/dummy-data.xml)

### How to Import Dummy Data:
1. Go to **Tools > Import** in your WordPress admin dashboard.
2. Select **WordPress** from the list of importers (if you haven't installed the WordPress importer, you’ll be prompted to do so).
3. Upload the `dummy-data.xml` file and assign it to the appropriate user.
4. Click **Submit** to import the sample data.

## Coding Standards
The Profile Management plugin is developed using **Object-Oriented Programming (OOP)** methodologies. It adheres to the **PHP_CodeSniffer (PHPCS)** and Fixer **(PHPCBF) coding standards** for **WordPress VIP**. This commitment to coding standards ensures high-quality, maintainable, and consistent code throughout the project.

## Development Status
**Current Phase:** This plugin is still in the development and enhancement phase. The initial release is available, and we are actively working on adding new features and improvements. We welcome feedback and suggestions from users to help us refine and enhance the plugin further.
