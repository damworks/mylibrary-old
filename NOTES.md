```bash
## commands
$ docker compose exec php-fpm php bin/console cache:clear
$ bin/docker console cache:clear

$ docker compose exec php-fpm composer show

## DATAHUB
## https://docs.pimcore.com/platform/Datahub/Installation_and_Upgrade/

$ docker compose exec php-fpm composer require pimcore/data-hub

$ bin/docker console pimcore:bundle:list
  pimcore:bundle:install    Installs a bundle
  pimcore:bundle:list       Lists all pimcore bundles and their enabled/installed state
  pimcore:bundle:uninstall  Uninstalls a bundle

$ bin/docker console pimcore:bundle:install PimcoreDataHubBundle







```