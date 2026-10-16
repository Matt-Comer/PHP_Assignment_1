# Tattoo Studio Gallery – PHP Assignment 4

## Project Overview

Tattoo Studio Gallery is a PHP and MySQL web application developed for the PHP and MySQL Development course.

This project builds on the existing Assignment 1 repository and includes adding, viewing, updating, and deleting tattoo records, image uploads, image previews, and a tattoo details page.

The application follows the concepts and structure demonstrated in the Contact Manager class project.

## Features

- Database connection using PDO
- Prepared statements with bound parameters
- Database error handling
- Add, view, update, and delete tattoo records
- Artist selection from the artists table
- Image uploads with thumbnail and larger image versions
- Current image displayed on the update form
- Preview of a selected replacement image before submitting
- Update the stored image filename when replacing an image
- Remove old image files after replacement when no other record uses them
- Preserve placeholder images during replacement
- Tattoo details page combining tattoo and artist information
- Details image displayed at 400 pixels high
- Confirmation pages
- Reusable header and footer
- Custom CSS styling

## Tech Stack

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- phpMyAdmin
- XAMPP
- Visual Studio Code
- Git and GitHub

## Main Files and Folders

| File or Folder | Purpose |
| --- | --- |
| css/app.css | Application styling |
| images/ | Uploaded images and resized versions |
| database.php | PDO database connection |
| database_error.php | Database error page |
| index.php | Tattoo gallery with record actions |
| add_tattoo_form.php | New tattoo form |
| add_tattoo.php | Validate and insert a tattoo |
| update_tattoo_form.php | Prefilled update form and image preview |
| update_tattoo.php | Update tattoo data and replace images |
| delete_tattoo.php | Delete a tattoo record |
| tattoo_details.php | Display tattoo details and artist information |
| image_util.php | Image resizing functions |
| header.php | Shared page header |
| footer.php | Shared page footer |
| tattoo_studio .sql | Current database export |

## Database

**Database name:** `tattoo_studio`

The database contains two related tables:

- `artists`: stores artist names.
- `tatoos`: stores tattoo records and references an artist through `artistID`.

The spelling `tatoos` matches the existing database table.

The details page uses a SQL JOIN to retrieve tattoo information and its related artist name.

All studio records are fictitious.

## Local Setup

1. Place the project folder inside the XAMPP `htdocs` folder.
2. Start Apache and MySQL in XAMPP.
3. Open phpMyAdmin and create a database named `tattoo_studio`.
4. Import the current database export, `tattoo_studio .sql`, from the project root.
5. Check that the connection settings in `database.php` match your local MySQL setup.
6. Open `http://localhost/PHP_Assignment_1/` in your browser.

Keep the included images in the `images` folder so the exported records can display their associated images.

## Assignment 4 Updates

- Added image previews to the update form.
- Added replacement image uploads and database filename updates.
- Added cleanup of old image files with placeholder protection.
- Added a tattoo details page displaying information from both related tables.
- Added gallery access to the details page.
- Displayed the larger details image at 400 pixels high.
- Included an updated database export.

## Course Information

**Course:** PHP and MySQL Development  
**Assignment:** Assignment 4, continuing the existing Tattoo Studio project  
**Instructor:** Doug Jasper  
**Student:** Matthew Comer

## Author

Matthew Comer
