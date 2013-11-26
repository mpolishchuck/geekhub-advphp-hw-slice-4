GeekHub Homework 7
========================

Steps to deploy:

1. Clone repository to your local machine
2. Execute 'composer install' at the root directory
3. Point DocumentRoot of your web server to the 'web' directory
4. Do not forget to execute 'app/console assetic:dump' to install assets (this step is optional on the dev environment)
5. Do not forget to deploy fixtures by executing 'app/console doctrine:fixtures:load'
6. Configure mailer (optionally)
