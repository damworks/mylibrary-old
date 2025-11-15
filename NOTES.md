```bash

## install  
$ git checkout develop
$ docker compose up -d
$ docker compose exec php composer install  
  
# IMPORT db  
$ sudo docker compose cp database/initial-pimcore-dump.sql.gz db:/application  
  
$ docker exec -it bbf498c003c3 /bin/bash  
o  
$ docker compose exec -it db /bin/bash  
root@bbf498c003c3:/application# gunzip initial-pimcore-dump.sql.gz  
root@bbf498c003c3:/application# mysql -uroot -p pimcore < initial-pimcore-dump.sql  

$ docker compose exec php bin/console pimcore:bundle:list
$ docker compose exec php bin/console pimcore:bundle:install PimcoreDataHubBundle
                                                             PimcoreApplicationLoggerBundle
                                                             ElementsProcessManagerBundle

$ docker compose exec php bin/console pimcore:deployment:classes-rebuild --create-classes  
$ docker compose exec php bin/console doctrine:migrations:migrate  
  (se errori con bundle ElementsProcessManagerBundle fare uninstall e poi install di nuovo)
$ docker compose exec php bin/console assets:install --symlink --relative  
$ docker compose exec php bin/console cache:clear

## commands
$ docker compose exec php-fpm php bin/console cache:clear
$ bin/docker console cache:clear

$ docker compose exec php-fpm composer show

############### DATAHUB
## https://docs.pimcore.com/platform/Datahub/Installation_and_Upgrade/

$ docker compose exec php-fpm composer require pimcore/data-hub

$ bin/docker console pimcore:bundle:list
  pimcore:bundle:install    Installs a bundle
  pimcore:bundle:list       Lists all pimcore bundles and their enabled/installed state
  pimcore:bundle:uninstall  Uninstalls a bundle

$ bin/docker console pimcore:bundle:install PimcoreDataHubBundle
############### DATAHUB end

############### PROCESS MANAGER
## https://packagist.org/packages/elements/process-manager-bundle
$ bin/docker console pimcore:bundle:list
$ bin/docker sh php-fpm
 
 composer require elements/process-manager-bundle
 
add in config/bundles.php:
Elements\Bundle\ProcessManagerBundle\ElementsProcessManagerBundle::class => ['all' => true],
$ bin/docker console pimcore:bundle:install ElementsProcessManagerBundle
############### PROCESS MANAGER end



```