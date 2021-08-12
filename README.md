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

#### Install migrations
```sh
sail artisan vendor:publish --provider="Twoavy\EvaluationTool\EvaluationToolServiceProvider" --tag="migrations"
```
