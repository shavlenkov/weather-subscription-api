# weather-subscription-api

Case task for **Software Engineering School 5.0 | KMA**

### About project
API service that allows you to subscribe to regular updates of the weather forecast in the selected location

### Endpoints
- `GET /api/weather?city={city}` - Get current weather for a given city with `Temperature`, `Humidity` and `Weather description`
- `POST /api/subscribe` - Subscribe a given `email` to weather updates for a given `city` with a given frequency (`daily` or `hourly`)
- `GET /api/confirm/{token}` - Confirm email subscription (send a link to this endpoint on the confirmation email)
- `GET /api/unsubscribe/{token}` - Unsubscribe from weather updates (send a link to this endpoint in each weather update)

### Requirements to run the application
1. PHP >= **8.3.10**
2. Laravel >= **12**
3. Composer >= **2.7.1**
4. Docker >= **26.0.0**
5. Docker Compose >= **1.29.2**

### How to run the application?
1. Clone the repository:

   `git clone https://github.com/shavlenkov/weather-subscription-api.git`
2. Navigate to the weather-subscription-api folder:

   `cd weather-subscription-api/`
3. Create an .env file from the .env.example file:

   `cp .env.example .env`
4. Update the following lines in the .env file:
   ```
   DB_CONNECTION=pgsql
   DB_HOST=postgres
   DB_PORT=5432
   DB_DATABASE=
   DB_USERNAME=
   DB_PASSWORD=
   ```

   ```
   WEATHER_API_KEY=
   ```
5. Install all dependencies using Composer:

   `composer install`
6. Run containers using Docker Compose:

   `docker-compose up -d`
7. Connect to the container:

   `docker exec -it app bash`
    1. Assign the correct permissions:

       `chmod -R 777 .`
    2. Generate App Key:

       `php artisan key:generate`
    3. Run migrations and seeders:

       `php artisan migrate --seed`
    4. Run scheduler:

       On your container, make sure the cron service is running:

       `systemctl start cron`

       Open the crontab editor:

       `crontab -e`

       Add the following line to run scheduler every minute:

       `* * * * * /usr/local/bin/php /var/www/artisan schedule:run >> /dev/null 2>&1`
    5. Run Laravel Queue Worker:

       `php artisan queue:work`
8. The API will be available at:
   [http://localhost](http://localhost "http://localhost")

### Deploy
1. Backend API (Swagger Documentation):

   http://35.194.24.127/api/documentation

2. Frontend (Client Interface):

   http://35.194.24.127:8080/index.html

3. Mailhog (Mail Testing Tool):

   http://35.194.24.127:8025
