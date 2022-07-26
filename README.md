# Symfony-Project
Для удобной работе в PHPStorm:
1. Настроить PHP-CLI
2. Настроить Server для Debug
3. Настроить Test Frameworks для PHPUnit. Path Mapping - также указать папку vendor для нормальной работы фикстур.
(в настройках выбрать подключать к существующему контейнеру или пересобрать контейнер с php-fpm) 

Fixtures: 
Запускать фикстуры в тестовом окружении
`php bin/console doctrine:fixtures:load --env=test`
