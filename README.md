# 🌟 APSI-Crowdfunding Backend

This project built with PHP, Laravel 10, TailwindCSS, AlpineJS, and Much More.

## Starter Introduction

This application use OOP Paradigm and MVC pattern. Here you can learn a little about MVC pattern, [Visit me](https://www.dicoding.com/blog/apa-itu-mvc-pahami-konsepnya/)

---

## 🎖️ Web Technologies

| Technology  | Description                                                                     | Version |
| ----------- | ------------------------------------------------------------------------------- | ------- |
| TailwindCSS | A utility-first CSS framework for rapidly building custom user interfaces.      | ^3.1.0  |
| PHP         | JPHP is a general-purpose scripting language geared towards web development.    | ^8.0    |
| Laravel     | Laravel is a PHP web application framework with expressive, elegant syntax.     | ^10.0   |
| AlpineJS    | Alpine is a rugged, minimal tool for composing behavior directly in your markup | ^3.0.6  |

## 🛠️ Setup Project

To get this project up and running in your development environment, follow these step-by-step instructions.

### 🍴 Prerequisites

We need to install or make sure that these tools are pre-installed on your machine:

-   [PHP](https://www.php.net/downloads): It is a popular general-purpose scripting language that is especially suited to web development.
-   [Composer](https://getcomposer.org/download/): It is a dependency manager for PHP.
-   [NodeJS](https://nodejs.org/en/download/): It is a JavaScript runtime build.
-   [Git](https://git-scm.com/downloads): It is an open source version control system.

## 🔍 Usage

### How To Use

To clone and run this application, you'll need [Git](https://git-scm.com) and [Node.js](https://nodejs.org/en/download/) (which comes with [npm](http://npmjs.com)) installed on your computer. From your command line:

### 🚀 Install Project

1. Clone the Repository

```bash
git clone https://github.com/Apiiyu/APSI-Crowdfunding-BE.git
```

2. Install dependencies using composer

```shell
composer install
```

3. Change **.env.example** to **.env**

You must change the .env.example to .env and match it with you local machine.

5. Generate key

```shell
php artisan key:generate
```

7. Install dependencies using npm

```shell
npm install
```

8. Compile all javascript and css

```shell
npm run dev
```

9. Adjust the database configuration in the .env file

```shell
DB_CONNECTION=pgsql // In this case we use PostgreSQL
DB_HOST=127.0.0.1
DB_PORT=5432 // Default port for PostgreSQL
DB_DATABASE=apsi_crowdfunding // Your database name. If you don't have it, create a new one
DB_USERNAME=postgres // Your database username
DB_PASSWORD=postgres // Your database password
```

10. Migrate the database and seed the data

```shell
php artisan migrate --seed
```

11. Run the application

```shell
php artisan serve
```

12. Open your browser and go to `http://127.0.0.1:8000`
13. You can login with this account:
    -   Email: admin@rpu.co.id
    -   Password: password

---

### ⚒️ How to Contribute

Want to contribute? Great!

To fix a bug or enhance an existing module, follow these steps:

-   Fork the repo
-   Create a new branch (`git checkout -b improve-feature`)
-   Make the appropriate changes in the files
-   Add changes to reflect the changes made
-   Commit your changes (`git commit -am 'Improve feature'`)
-   Push to the branch (`git push origin improve-feature`)
-   Create a Pull Request

### 📩 Bug / Feature Request

If you find a bug (the website couldn't handle the query and / or gave undesired results), kindly open an issue [here](https://github.com/Apiiyu/APSI-Crowdfunding-BE/issues/new) by including your search query and the expected result.

If you'd like to request a new function, feel free to do so by opening an issue [here](https://github.com/Apiiyu/APSI-Crowdfunding-BE/issues/new). Please include sample queries and their corresponding results.

## 📜 Credits

List your collaborators, if any, with links to their GitHub profiles.

I'd like to acknowledge my collaborators, who contributed to the success of this project. Below are links to their GitHub profiles.

Furthermore, I utilized certain third-party assets that require attribution. Find the creators' links in this section.

If I followed tutorials during development, I'd include the links to those as well.

👦 Rafi Khoirulloh <br>
Email: khoirulloh.rafi2@gmail.com <br>
GitHub: @apiiyu
