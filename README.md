# iBillSplit-Laravel
A Bill Splitter App (Backend Api). Building a simple tool to help you and your friends split bills when you go out to eat together.


**To get the project up and running, Pls Do the following After Cloning :**

- `composer install`

- `php artisan key:generate`

- Set up your database. my `.env` file is available.

- `php artisan migrate`

- `php artisan db:seed` _(Seed some files to your db)_

- To avoid stress of registration and verification. Sign in as an admin user, email = `ade@gmail.com` and password = `password`

- Or Sign in as a normal user which is also already verified by default, email = `yunus@gmail.com` and password = `password` 

- Or Register a new user. A verification mail would be sent to your email

- `http://127.0.0.1:8000` is my local host for the backend