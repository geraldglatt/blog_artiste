# site Artiste

creche_sucePouce est un site internet présentant des images/actualités

### Pré-requis

* PHP 8.1
* Composer
* Symfony cli
* Docker
* nodejs et npm

### Lancer l'environement de dévelopement

composer install
npm install
npm run build
symfony server:start

## Lancer des tests
’’’bash
php bin/phpunit --testdox
’’’

## Ajouter des données de tests
’’’bash
symfony console doctrine:fixtures:load ou symfony console d:f:l
’’’

## Production
### Envoie des mails de contact

Les mails de prise de contact sont stockés en BDD, pour les envoyer à l'artiste par mail , il faut mettre un cron sur :

’’’bash
symfony console app:send-contact
’’’