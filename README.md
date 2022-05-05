
# Football Club

A Football Club Management Platform




## Run Locally

Clone the project

```bash
  git clone https://github.com/himanshu1690/football-club.git
```

Go to the project directory

```bash
  cd football-club
```

Install dependencies

```bash
  composer install
  npm install
  npm run dev
```

Copy env

```bash
  cp env.example env
```

Set Mailtrap 

```bash
 MAIL_MAILER=smtp
 MAIL_HOST=smtp.mailtrap.io
 MAIL_PORT=2525
 MAIL_USERNAME=xxxxxxx
 MAIL_PASSWORD=xxxxxxx
 MAIL_ENCRYPTION=tls
```

Run database migration and seed for default data

```bash
  php artisan migrate --seed
```

Run server

```bash
  php artisan serve
  php artisan queue:work --tries=3
```

Demo Credentials for Super admin 

```bash
  username: superadmin@football.club
  password: password 
```

