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
* seed: `php artisan db:seed`

##### Demo data
TODO
<!-- * install demo seeders: `sail artisan vendor:publish --provider="Twoavy\EvaluationTool\EvaluationToolServiceProvider" --tag="demo-seeders"` -->
<!-- * seed: `php artisan db:seed --class=Twoavy\\EvaluationTool\\Seeders\\EvaluationToolDemoDataSeeder` -->

