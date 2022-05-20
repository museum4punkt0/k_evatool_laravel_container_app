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
A MySQL database must be installed and configured. The credentials must be inserted in the .env file.

#### Install
Run this in project directory
```
php composer.phar install
php artisan migrate
php artisan passport:install
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
mkdir ./packages
mkdir ./packages/twoavy
git clone git@github.com:museum4punkt0/k_evatool_laravel_package.git

composer install
sail up -d --build
```

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
