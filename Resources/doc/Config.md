## Configure the TadckaRoutingBundle

```yml
tadcka_routing:
    db_driver: orm
    class:
        model:
            route: Tadcka\Bundle\AcmeBundle\Entity\Route
    chain_router:
        enabled: true
```