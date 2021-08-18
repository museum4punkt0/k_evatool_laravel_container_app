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

#### Seeders and factories
* install factories: `sail artisan vendor:publish --provider="Twoavy\EvaluationTool\EvaluationToolServiceProvider" --tag="factories"`
* install seeders: `sail artisan vendor:publish --provider="Twoavy\EvaluationTool\EvaluationToolServiceProvider" --tag="seeders"`
* seed:
```
php artisan db:seed --class=Twoavy\\EvaluationTool\\Seeders\\EvaluationToolSurveyLanguageSeeder
php artisan db:seed --class=Twoavy\\EvaluationTool\\Seeders\\EvaluationToolSurveyElementTypeSeeder
```

