# Student Registration System

A Laravel-based web application for the College of Information Technology's digital student registration module. Built as Mini Project 03 for ITST 302 – Client-Server Technologies.

**Author:** Jairo D. Banaag
**Course:** ITST 302 – Client-Server Technologies
**Activity:** Week 4 Laboratory Activity – MP03

---

## 1. Introduction

Student registration is one of the most common workflows in enterprise information systems. Universities, hospitals, banks, and government offices all rely on secure, validated systems to collect and manage user information. A poorly built registration system can lead to duplicate records, corrupted data, or security vulnerabilities that expose sensitive personal information.

This project implements a **Student Registration System** using Laravel. It allows a student to fill out a registration form, upload a profile picture, and have that information validated on the server before being stored in a MySQL database. Data validation is critical here — it is the first line of defense against invalid, incomplete, or malicious input, and it ensures that every record saved to the database is trustworthy and usable by the rest of the system.

Registration systems like this one are the backbone of enterprise applications. The same patterns used here — form handling, validation, file uploads, and database persistence — scale directly into larger systems such as the Enterprise Laravel E-Commerce Project planned later in this course.

---

## 2. Objectives

By completing this activity, the following objectives were accomplished:

- Built a professional, organized student registration form using Blade templates.
- Implemented server-side validation for all required fields.
- Prevented invalid or incomplete submissions from reaching the database.
- Implemented secure file upload for student profile pictures using Laravel Storage.
- Stored validated student records in a MySQL database via Eloquent.
- Understood and traced Laravel's full request lifecycle, from browser to response.
- Practiced Git version control with meaningful, descriptive commits.
- Documented the development process for portfolio and future reference.

---

## 3. Laravel Request Lifecycle

Every registration submission in this system passes through the following stages:

1. **Browser** – The user fills out the form and submits it as an HTTP POST request.
2. **Route** – `routes/web.php` matches the incoming request to the correct URI (`POST /students`).
3. **Controller** – `StudentController@store()` receives the request and takes over processing.
4. **Validation** – `$request->validate()` checks every field against its rules (required, unique, email, numeric, image, etc.). If validation fails, Laravel automatically redirects back with the old input and error messages.
5. **Model** – On success, the `Student` model is used to persist data, and `Storage::put()` saves the uploaded profile picture to `storage/app/public`.
6. **Database** – The validated record is written to the `students` table in MySQL.
7. **Response** – A flash success message is set, and the user is redirected to the student's profile page for confirmation.

![Laravel Request Lifecycle](documentation/request-lifecycle-diagram.png)

---

## 4. Validation Rules

The following validation rules were implemented in the controller:

```php
$request->validate([
    'student_id'      => 'required|unique:students',
    'first_name'      => 'required|string|max:100',
    'middle_name'     => 'nullable|string|max:100',
    'last_name'       => 'required|string|max:100',
    'email'           => 'required|email|unique:students',
    'mobile_number'   => 'required|digits:11',
    'gender'          => 'required',
    'date_of_birth'   => 'required|date',
    'program'         => 'required',
    'year_level'      => 'required',
    'address'         => 'required',
    'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
]);
```

**Why each rule matters:**

- **Required fields** ensure that essential student information is never missing. Without this, the database could end up with incomplete records that break downstream features like the profile page.
- **Unique constraints** (`student_id`, `email`) prevent duplicate registrations — a real concern in any enrollment system, where one student should map to exactly one record.
- **Email validation** confirms the address is properly formatted before it's stored, reducing bounced communications and fraudulent entries.
- **Numeric/digits validation** on `mobile_number` guarantees the field can be used reliably for SMS notifications or verification later.
- **Image validation** (`image`, `mimes`) restricts uploads to actual image files, blocking disguised executables or corrupted files from being accepted as a profile picture.
- **File size restriction** (`max:2048`, i.e. 2MB) protects server storage from abuse and keeps upload times reasonable.

---

## 5. Database Design

The system uses a single `students` table.

| Column           | Data Type    | Constraint          |
|-------------------|--------------|----------------------|
| id                | BIGINT       | Primary Key, Auto Increment |
| student_id        | VARCHAR(50)  | Unique, Not Null    |
| first_name        | VARCHAR(100) | Not Null            |
| middle_name       | VARCHAR(100) | Nullable            |
| last_name         | VARCHAR(100) | Not Null            |
| email             | VARCHAR(150) | Unique, Not Null    |
| mobile_number     | VARCHAR(11)  | Not Null            |
| gender            | VARCHAR(10)  | Not Null            |
| date_of_birth     | DATE         | Not Null            |
| program           | VARCHAR(100) | Not Null            |
| year_level        | VARCHAR(20)  | Not Null            |
| address           | TEXT         | Not Null            |
| profile_picture   | VARCHAR(255) | Not Null (stores file path only) |
| created_at        | TIMESTAMP    | Nullable            |
| updated_at        | TIMESTAMP    | Nullable            |

The `id` column serves as the Primary Key. `student_id` and `email` both carry unique constraints to prevent duplicate student records. Only the **file path** of the profile picture is stored in the database — the actual image lives in `storage/app/public`, linked to the public directory via `php artisan storage:link`.

![Database ERD](documentation/database-erd.png)

---

## 6. Registration Flowchart

The registration process follows the flow shown below: the user fills out the form, submits it, and Laravel validates the data. Valid data is saved, the photo is uploaded, a success message is shown, and the user is taken to their profile page. Invalid data instead displays error messages and returns the user to the form.

![Registration Flowchart](documentation/registration-flowchart.png)

---

## 7. Screenshots

All screenshots are located in the `screenshots/` folder:

- `01-vscode-project-structure.png` – Project structure in VS Code
- `02-terminal-output.png` – Terminal output of `migrate` and `storage:link`
- `03-github-repository.png` – Public GitHub repository
- `04-registration-form-blank.png` – Blank registration form
- `05-validation-errors.png` – Validation error messages
- `06-flash-success-profile-upload.png` – Flash success message, uploaded photo, and student profile page
- `07-database-records.png` – Saved student record in phpMyAdmin

---

## 8. Problems Encountered

**1. Incorrect repository name.**
The GitHub repository was initially created as `week4-student-registration` instead of the required `week04-student-registration`, missing the leading zero.

**2. Confusion between SQLite and MySQL when checking the database.**
An SQLite Viewer extension was used to inspect `database.sqlite`, but the `students` table was nowhere to be found. It turned out the application was actually configured to use MySQL (`DB_CONNECTION=mysql` in `.env`), so the SQLite file was never the real data source.

**3. Database connection pointed to the wrong MySQL port.**
The `.env` file was set to `DB_PORT=3306`, but the MySQL instance actually running through XAMPP was listening on port `3307`. This caused `php artisan migrate` to report that the `student_registration` database did not exist, since it was checking the wrong server entirely.

**4. "Storage link already exists" message when re-running `storage:link`.**
Running `php artisan storage:link` a second time returned an error stating the link already existed, which initially looked like a failure but was actually confirmation that the link had been created successfully before.

---

## 9. Solutions

**1.** The repository was renamed to `week04-student-registration` through GitHub's repository Settings, and the local Git remote URL was updated using `git remote set-url origin <new-url>` to match.

**2.** The `.env` file was checked directly to confirm the actual database driver in use. Once confirmed as MySQL, the SQLite Viewer was abandoned in favor of phpMyAdmin, the correct tool for a MySQL-backed Laravel app.

**3.** The `DB_PORT` value in `.env` was updated from `3306` to `3307` to match XAMPP's running MySQL instance. `php artisan migrate` was then re-run, which created the `student_registration` database and all required tables on the correct server.

**4.** The existing symbolic link was removed with `rmdir public\storage` before running `php artisan storage:link` again, producing a clean, error-free confirmation message.

---

## 10. Reflection

Working on this Student Registration System gave me a much deeper appreciation for what happens beneath a simple web form. Before this activity, I thought of registration forms as just an interface — a way to collect information. Now I understand that the real work happens after the "Submit" button is clicked: the validation, the file handling, and the database writes that turn raw user input into trustworthy data.

Validation turned out to be the most important lesson of this project. It is easy to assume users will type things correctly, but in practice, forms are full of blank fields, mistyped emails, and unexpected input. Laravel's server-side validation gave me a structured, reliable way to catch these issues before they ever touched the database. I also learned firsthand why **server-side validation matters more than client-side validation**. Client-side checks (like HTML5 `required` attributes or JavaScript) can improve user experience by giving instant feedback, but they can be bypassed entirely — a user can disable JavaScript, use browser developer tools, or send a raw HTTP request straight to the server. Server-side validation is the only layer that cannot be skipped, which is why Laravel enforces it at the controller level regardless of what happens in the browser.

Handling user input also taught me to be more careful about what a system trusts by default. Every field submitted by a user is, in a sense, unverified until the server says otherwise. This mindset extended naturally into file uploads. Allowing users to upload a "profile picture" sounds harmless, but without restrictions on file type and size, an attacker could attempt to upload disguised scripts or oversized files that strain server storage. Restricting uploads to specific image MIME types and a maximum file size, and storing only the file *path* in the database rather than the raw file, reinforced how important **file security** is in any application that accepts uploads from users. Files should never be blindly trusted, and where they are stored, and how they are referenced, needs to be handled deliberately.

Debugging the database connection issues during this project was also a valuable, if frustrating, learning experience. Realizing that my application was pointed at the wrong MySQL port taught me to always verify configuration values like `DB_HOST` and `DB_PORT` against what is actually running, rather than assuming defaults are correct. It reinforced that a working application depends on many small pieces of configuration lining up correctly, and that troubleshooting is as much a part of development as writing the initial code.

Beyond the technical skills, this project helped me see how directly these patterns apply to real-world enterprise software. Every university, hospital, and government portal that collects personal information depends on the same core ideas demonstrated here: validated forms, secure storage, and a clear separation between what the user submits and what the system ultimately trusts and saves. Registration is often the very first interaction a user has with a system, which makes it one of the most important parts to get right — a broken or insecure registration process can compromise everything built on top of it.

Overall, this activity strengthened both my practical Laravel skills and my understanding of why secure, validated form handling is treated as a foundational requirement in professional software development, not an optional add-on.

---

## 11. References

Laravel. (2026). *Laravel documentation*. Laravel LLC. https://laravel.com/docs

The PHP Group. (2026). *PHP manual*. https://www.php.net/manual/en/

Oracle Corporation. (2026). *MySQL 8.0 reference manual*. https://dev.mysql.com/doc/

Tailwind Labs. (2026). *Tailwind CSS documentation*. https://tailwindcss.com/docs

Mozilla Developer Network. (2026). *MDN web docs*. Mozilla Foundation. https://developer.mozilla.org/

---

## 12. Repository Structure

```
week04-student-registration/
├── app/
│   ├── Http/Controllers/StudentController.php
│   └── Models/Student.php
├── database/migrations/
├── documentation/
│   ├── registration-flowchart.png
│   ├── database-erd.png
│   └── request-lifecycle-diagram.png
├── resources/views/students/
├── routes/
├── screenshots/
├── storage/
└── README.md
```