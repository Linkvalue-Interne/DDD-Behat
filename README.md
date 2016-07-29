# Behat Skeleton

Ceci est un example pour l'implémentation d'un skeleton Majora avec un bootstrap pour les tests Behat.

Pour faire fonctionner les tests behat, il vous faudra configurer le fichier behat.yml à la racine de votre projet de la manière suivante :

```yml
imports:
    - app/config/parameters.yml

default:
    autoload:
        '': %paths.base%/src
    extensions:
        Behat\Symfony2Extension: ~ # Using the Symfony Extension
    suites:
        dal_domain: # Name your suite as you wish.
            type: symfony_bundle
            bundle: LvExampleDalBundle # Your generated bundle
            paths:
                - %paths.base%/src/Lv/Example/Bundle/ApiBundle/Features # Path to your generated features
            contexts:
                - Lv\Example\Bundle\ApiBundle\Features\Context\EntityContext: # Class of your generated entity context
                    domain: '@lv.entity.domain' # Domain service of your generated entity (majora_vendor.majora_entity.domain)
                    loader: '@Lv.entity.loader' # Loader service of your generated entity (majora_vendor.majora_entity.domain)
                    em: '@doctrine.orm.entity_manager' # Doctrine entity manager
```

Libre à vous ensuite de compléter ces tests avec vos règles métiers.
