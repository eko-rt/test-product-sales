Dockerビルド  
１.git clone git@github.com:eko-rt/test-product-sales.git  
２.DockerDesktopアプリを立ち上げる  
３.docker-compose up -d --build  

Laravel環境構築  
１.docker-compose exec php bash  
２.composer install  
３.「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成  
４..envに以下の環境変数を追加  
DB_CONNECTION=mysql  
DB_HOST=mysql  
DB_PORT=3306  
DB_DATABASE=laravel_db  
DB_USERNAME=laravel_user  
DB_PASSWORD=laravel_pass  

５.アプリケーションキーの作成  
php artisan key:generate  

６.マイグレーションの実行  
php artisan migrate  

７.シーディングの実行  
php artisan db:seed  

８.シンボリックリンクを作成  
php artisan storage:link  


使用技術(実行環境)  
nginx1.21.1  
PHP7.4.9  
Laravel8.83.27  
MySQL8.0.26  

ER図  
![Image](https://github.com/user-attachments/assets/e376eace-9409-4713-9589-15b3afedb904)  

URL

開発環境：http://localhost/products

phpMyadmin:http://localhost:8080
