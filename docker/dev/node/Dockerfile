FROM node:12-alpine

WORKDIR /var/www

USER 1000
php artisan make:migration create_user_profiles && php artisan make:migration create_organizations_table && php artisan make:migration create_projects_table && php artisan make:migration create_tickets_table && php artisan make:migration create_comments_table && php artisan make:migration attachments_table
