# 2223-waai-001 webapp

## Requirements
1. Make sure you have xammp installed on your computer.
2. Make sure you have composer installed on your computer.
3. Make sure you have apache running on your computer (xammp).

## Installation
1. Make sure to install this repository in your xammp/htdocs folder.
2. Then run the following commands in your terminal:
3. Do all these commands in the webapp folder! (2223-waai-001-waaiburg-web-app/code/webapp)
4. composer install
5. npm install
6. Copy .env.example to .env
7. Generate an app encryption key with php artisan key:generate
8. Use php artisan serve in your terminal to run the application
9. Use npm run dev to compile the assets (use 2 terminals!)
10. Open the link to 127.0.0.1:8000 in your browser
11. Use php artisan migrate in your terminal to create the database
