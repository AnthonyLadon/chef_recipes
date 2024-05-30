# Chef Recipes

This is a side project that I have been working on for a few days now. It is a web application that allows you to create, share and discover recipes. The main goal of this project is to allow users to share their recipes with the community and to discover new recipes. The project is still under development and I am constantly adding new features to it.

## 🚀 Installation

To install this project, you will need to have composer and npm installed on your machine. You will also need to have a local server running on your machine. You can use [XAMPP](https://www.apachefriends.org/index.html) or [WAMP](https://www.wampserver.com/en/) for that.

1. Clone the project

```bash
  git clone https://github.com/AnthonyLadon/chef_recipes.git
```

2. Install the dependencies

```bash
  composer install
```

3. Modify the .env file to add your database credentials. Open the `.env` file in the root directory of the project and update the following lines with your database information:

   ```bash
   DATABASE_URL=mysql://db_user:db_password@db_host:3306/chef_recipes?serverVersion=8&charset=utf8mb4
   ```

4. Create the database

```bash
  php bin/console doctrine:database:create
```

5. Run the migrations

```bash
  php bin/console doctrine:migrations:migrate
```

6. Start the server

```bash
  symfony server:start
```

7. Open your browser and go to `http://localhost:8000`

## Author

- [@AnthonyLadon](https:anthonyladon.com)

## 🧑‍🔧 Tech Stack

**Client:** javascript, twig, TailwindCSS

**Backend:** symfony (php)

**API's & external services:** Not implemented yet
