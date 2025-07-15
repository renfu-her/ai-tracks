# ai-tracks

## 安裝
```
composer install
cp .env.example .env
php artisan key:generate
```

## 修改 DB，以及 APP_URL 然後執行以下命令
```
php artisan migrate
php artisan storage:link
```

## Filament v3 的做法
```
php artisan vendor:publish --force --tag=livewire:assets
php artisan filament:assets
php artisan filament:cache-components
```