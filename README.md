## Local development

#### Install && update
```sh
mkdir ./packages
mkdir ./packages/twoavy
git clone git@github.com:twoavy/evaluation-tool.git

composer install
sail up -d --build

#if simple "sail" does not work
./vendor/bin/sail up -d --build
```

#### Migration
* install migrations: `sail artisan vendor:publish --provider="Twoavy\EvaluationTool\EvaluationToolServiceProvider" --tag="migrations"`
* migrate: `sail artisan migrate:fresh`

#### Seeders
* seed: `sail artisan db:seed`
* seed demo data: `sail artisan db:seed --class=Twoavy\\EvaluationTool\\Seeders\\EvaluationToolDemoDataSeeder`

<<<<<<< HEAD
#### Tests
* run all tests: `sail artisan test`
* run all tests in class: `sail artisan test --filter "EvaluationToolSurveyTest"`
* run only one specific method: `sail artisan test --filter "EvaluationToolSurveyTest::test_get_surveys"`

=======
#### Passport
```
sail artisan passport:install
```
>>>>>>> 10f0eee39db6a69433743a256a1c1d31e1bc434e
