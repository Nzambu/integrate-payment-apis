Getting started

Download the project and place it in on this path `var/www/html/microservice`

Launch terminal and Change directory to the parent folder microservices ie `cd /var/www/html/microservice`

Change directory to `gateway` by running the command `cd gateway` on the terminal opened above and follow the steps below.

Run the following commands on the same terminal `composer install && php artisan passport:install && php artisan migration:fresh && php artisan db:seed`

On the terminal, go back one step `cd ..` and change directory to payment service `cd payment_service` and run command `composer install`.

On the same terminal run the following commands `php artisan migrate:fresh && php artisan db:seed`

On the same terminal, go back one step `cd ..` and change directory to payment service `cd profile_service` and run command `composer install`.

The application is set and ready to run. 

Change directory back to the parent folder `microservice` by running the command on the same terminal `cd ..` and change

Change directory to `gateway folder` by running on same terminal the command `cd gateway` and run the command 
`php artisan serve --port 8000`

Access the documentation of the API's on the browser by visiting the link `http://localhost:8000/docs/`

Launch postman (reccomended) and login with the following credentials

    email : patricknzambu@gmail.com
    password : password

Use the email above to email the author regarding this application

Thank you so much