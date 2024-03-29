# k:evatool laravel container app

This part of the system functions as a wrapper for the k:evatool Laravel package. It is intended to provide a fully functional backend including user management and OAUTH Authentication.
It is part of the k:evatool

### Funding
This project is part of the project museum4punkt0 - Digital Strategies for the Museum of the Future, sub-project k:eva. Further information: https://www.museum4punkt0.de.

The project museum4punkt0 is funded by the Federal Government Commissioner for Culture and the Media in accordance with a resolution issued by the German Bundestag (Parliament of the Federal Republic of Germany).

![BKM-Logo](https://github.com/museum4punkt0/Object-by-Object/blob/77bba25aa5a7f9948d4fd6f0b59f5bfb56ae89e2/04%20Logos/BKM_Fz_2017_Web_de.gif)
![NeustartKultur](https://github.com/museum4punkt0/Object-by-Object/blob/22f4e86d4d213c87afdba45454bf62f4253cada1/04%20Logos/BKM_Neustart_Kultur_Wortmarke_pos_RGB_RZ_web.jpg)

## Production

### Recommended Server Setup
#### Backend (Laravel)
- Ubuntu 20.04
- Apache 2.4.x (nginx can be used as well)
- PHP 8.0 (Several addition php packages are needed. Please see https://laravel.com/docs/8.x/deployment. We additionally recommend installing the GMP
  extension.)
- MySQL 8.0
- Composer 2.x

#### Prerequisites
A MySQL database must be installed and configured. Configuration also includes the creation of a database with the necessary access writes so that PHP can
access it. The
credentials must be inserted in the .env
file.

**IMPORTANT:** Please clone https://github.com/museum4punkt0/k_evatool_laravel_package into the "packages/twoavy" directory. Otherwise installation would fail.

#### Install
Run this in project directory on initial install
```
php composer.phar install
php artisan storage:link
php artisan migrate
php artisan passport:install
```

#### Updates
Run this in project directory after each update
```
php composer.phar install
php artisan storage:link
php artisan migrate
```

#### Symlinks needed
Create the following symlinks for proper file paths. Run these commands on public folder
```
ln -s ../storage/app/evaluation-tool/assets evaluation-tool
ln -s ../storage/app/evaluation-tool/audio evaluation-tool-audio
ln -s ../storage/app/evaluation-tool/settings_assets evaluation-tool-settings-assets
```

## Local development

#### Install & update
```sh
cp .env.example .env
mkdir -p ./packages/twoavy/evaluation-tool
git clone git@github.com:museum4punkt0/k_evatool_laravel_package.git ./packages/twoavy/evaluation-tool
git -C ./packages/twoavy/evaluation-tool checkout master
docker-compose build
docker-compose up -d
docker-compose exec k_evatool composer install
docker-compose exec k_evatool php artisan migrate:fresh --seed
docker-compose exec k_evatool php artisan passport:install
docker-compose exec k_evatool php artisan users:create-admin
```

Alternatively you can use the Makefile and run "make magic"

#### Fresh migration (deletes all data)
```
docker-compose exec k_evatool php artisan migrate:fresh
```

#### Fresh migration with seed (deletes all data and seeds sample data)
```
docker-compose exec k_evatool php artisan migrate:fresh --seed
```

### Run seeders
#### Seed
```
docker-compose exec k_evatool php artisan db:seed
```
#### Seed demo data
```
docker-compose exec k_evatool php artisan db:seed --class=Twoavy\\EvaluationTool\\Seeders\\EvaluationToolDemoDataSeeder
```
#### Seed demo survey results
```
docker-compose exec k_evatool php artisan evaluation:seed_survey_results SURVEYID COUNT
```

#### Passport installation
```
docker-compose exec k_evatool php artisan passport:install
```

### Tests
#### Run all tests
```
docker-compose exec k_evatool php artisan test
```
#### Run all tests in class
```
docker-compose exec k_evatool php artisan test --filter "EvaluationToolSurveyTest"
```
#### Run only one specific method
```
docker-compose exec k_evatool php artisan test --filter "EvaluationToolSurveyTest::test_get_surveys"
```

### License
GNU GENERAL PUBLIC LICENSE <br>
Copyright © 2022, 2av GmbH <br>
Please also see the LICENSE file provided within this repository
