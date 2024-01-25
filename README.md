# Film Management

The Application is based on Laravel 9 with PHP Version 8.1. backend completely based on container based. All the required images setup in docker-compose.yml file. For setting Application follow these steps.

## Installation

Note: Make sure docker and docker-compose must be install in your OS version must be latest. 
Copy .env.example (currently you will get sample .env) to .env and update credentials

```bash
git clone https://github.com/MuhammadAteebHussain/laravel-reactjs-sample-code.git
```
* stop any previous development environment.
```bash
docker-compose -f docker-compose.yml down --remove-orphans
docker-compose -f docker-compose.yml rm -f -s
```
* starting development environment please make sure check the ports in docker-compose.yml

```bash
docker-compose up -d --build
```
* it will take some time in building application. After successful installation enter in your php container by using the following command.

```bash
sudo docker exec -it film_application_laravel_php  bash
```
* Note: For checking your all up containers run the below command. This will show you all the ports that your containers are using.
```bash
sudo docker-compose ps -a
```

* Now give write access permission to storage directory by using the following command.
```bash
root@9525a373f4d1:/server/http# chmod 777 -R storage 
```
* Now give write access permission to root tmp.
```bash
root@9525a373f4d1:/server/http# chmod -R 777 /tmp
```
* Install composer
```bash
root@9525a373f4d1:/server/http# composer install
```
* generate autoload files
```bash
root@9525a373f4d1:/server/http# composer dumpautoload -o
```
* RUN DB migrations it will setup migrations with DB seeders
```bash
root@9525a373f4d1:/server/http# php artisan migrate:fresh --seed
```
* Install passport
```bash
root@9525a373f4d1:/server/http# php artisan install:passport
```
* Run Tests
```bash
root@9525a373f4d1:/server/http# php artisan test
```
## Setting Front End ReactJs

For setting Frontend make sure your system have node version v12.22.12 and npm version 7.5.2. In this release you will see frontend validation and alerts are missing. but It will be deploy soon in upcoming release. For installing current application follow these steps. make sure run the commands outside to your container.

```bash
cd front_end/
```

```bash
install npm
```
Note: if you will face any permission issue run the commands by using sudo.
```bash
install run start
```
Congratulations! Your application is working now


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
