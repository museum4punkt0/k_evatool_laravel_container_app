# k:evatool laravel container app
## Production

### Recommended Server Setup
#### Backend (Laravel)
- Ubuntu 20.04
- Apache 2.4.x (nginx can be used as well)
- PHP 8.0 (Several addition php packages are needed. Please see https://laravel.com/docs/8.x/deployment)
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
cd packages/twoavy
git clone git@github.com-twoavy-ms:museum4punkt0/k_evatool_laravel_package.git ./packages/twoavy/evaluation-tool
git -C ./packages/twoavy/evaluation-tool checkout master
docker-compose build
docker-compose up -d
docker-compose exec k_evatool composer install
docker-compose exec k_evatool php artisan migrate
docker-compose exec k_evatool php artisan passport:install
docker-compose exec k_evatool php artisan users:create-admin
```

Alternatively you can use the Makefile and run "make magic"

#### If simple "sail" does not work
```
./vendor/bin/sail up -d --build
```

#### Migration with seed
* migrate: `sail artisan migrate:fresh --seed`

#### Migration
* migrate: `sail artisan migrate:fresh`

#### Run seeders
* seed: `sail artisan db:seed`
* seed demo data: `sail artisan db:seed --class=Twoavy\\EvaluationTool\\Seeders\\EvaluationToolDemoDataSeeder`
* seed demo survey results: `sail artisan evaluation:seed_survey_results SURVEYID COUNT`

#### Passport installation
```
sail artisan passport:install
```

#### Tests
* run all tests: `sail artisan test`
* run all tests in class: `sail artisan test --filter "EvaluationToolSurveyTest"`
* run only one specific method: `sail artisan test --filter "EvaluationToolSurveyTest::test_get_surveys"`
