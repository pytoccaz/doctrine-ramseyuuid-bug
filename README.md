# Identity through foreign Entities Bug (when identifiers are of type RamseyUuid)

Please jump between tags :

 - `ok` no-bug case
 - `bug` bug case 

## sqlite schema update

Before testing a case you have to reset the schema.

``` bash
vendor/bin/doctrine orm:schema-tool:drop --force
vendor/bin/doctrine orm:schema-tool:update --force
```

## run test

```bash
composer test
```

## Bug case description


We have 2 entities:

```php 
// Book.php
/**
 * @ORM\Entity 
 * @ORM\Table(name="book")
 */
class Book
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    protected $id;
```

```php
// Author.php
/**
 * @ORM\Entity 
 * @ORM\Table(name="author")
 */
class Author
{  
 
    /**
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Book", inversedBy="author")
     * @ORM\JoinColumn(name="book")  
     */
    protected $book;

```

1. `Book` is identified by `$id` of type *Ramsey Uuid*
2.  `Author` is identified by `$book` of type `Book` (hence Book is the foreign entity).    

This is a classical [Identity through foreign Entities](https://www.doctrine-project.org/projects/doctrine-orm/en/2.10/tutorials/composite-primary-keys.html#identity-through-foreign-entities) design pattern.


Note `@ORM\JoinColumn(name="book")` in `Author` class.
When `Author` `book` identifier is mapped with the same named `book` table column, doctrine hydrator breaks with the following error message when refreshing `Book` enties:

```
PHP Fatal error:  Uncaught ReflectionException: Given object is not an instance of the class this property was declared in in /home/olivier/work/projet/tests/doctrine/doctrine2-tutorial/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/ClassMetadataInfo.php:791
Stack trace:
#0 /home/olivier/work/projet/tests/doctrine/doctrine2-tutorial/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/ClassMetadataInfo.php(791): ReflectionProperty->getValue()
#1 /home/olivier/work/projet/tests/doctrine/doctrine2-tutorial/vendor/doctrine/orm/lib/Doctrine/ORM/Utility/IdentifierFlattener.php(66): Doctrine\ORM\Mapping\ClassMetadataInfo->getIdentifierValues()
#2 /home/olivier/work/projet/tests/doctrine/doctrine2-tutorial/vendor/doctrine/orm/lib/Doctrine/ORM/UnitOfWork.php(2654): Doctrine\ORM\Utility\IdentifierFlattener->flattenIdentifier()
#3 /home/olivier/work/projet/tests/doctrine/doctrine2-tutorial/vendor/doctrine/orm/lib/Doctrine/ORM/Internal/Hydration/ObjectHydrator.php(255): Doctrine\ORM\UnitOfWork->createEntity()
#4 /home/olivier/work/projet/tests/doctrine/doctrine2-tutorial/vendor/doctrine/orm/lib/Doctrine/ORM/Internal/Hydration/ObjectHydrator.php(422): Doctrine\ORM\Internal\Hydration\ObjectHydrator->getEntity()
#5 /home/olivier/work/projet/tests/doctrine/doctrine2-tutorial/vendor/doctrine/orm/lib/Doctrine/ORM/Internal/Hydration/ObjectHydrator.php(143): Doctrine\ORM\Internal\Hydration\ObjectHydrator->hydrateRowData()
#6 /home/olivier/work/projet/tests/doctrine/doctrine2-tutorial/vendor/doctrine/orm/lib/Doctrine/ORM/Internal/Hydration/AbstractHydrator.php(268): Doctrine\ORM\Internal\Hydration\ObjectHydrator->hydrateAllData()
#7 /home/olivier/work/projet/tests/doctrine/doctrine2-tutorial/vendor/doctrine/orm/lib/Doctrine/ORM/Persisters/Entity/BasicEntityPersister.php(808): Doctrine\ORM\Internal\Hydration\AbstractHydrator->hydrateAll()
#8 /home/olivier/work/projet/tests/doctrine/doctrine2-tutorial/vendor/doctrine/orm/lib/Doctrine/ORM/UnitOfWork.php(2207): Doctrine\ORM\Persisters\Entity\BasicEntityPersister->refresh()
#9 /home/olivier/work/projet/tests/doctrine/doctrine2-tutorial/vendor/doctrine/orm/lib/Doctrine/ORM/UnitOfWork.php(2179): Doctrine\ORM\UnitOfWork->doRefresh()
#10 /home/olivier/work/projet/tests/doctrine/doctrine2-tutorial/vendor/doctrine/orm/lib/Doctrine/ORM/EntityManager.php(687): Doctrine\ORM\UnitOfWork->refresh()
#11 /home/olivier/work/projet/tests/doctrine/doctrine2-tutorial/create_book.php(23): Doctrine\ORM\EntityManager->refresh()
#12 {main}
  thrown in /home/olivier/work/projet/tests/doctrine/doctrine2-tutorial/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/ClassMetadataInfo.php on line 791
```

If you change JoinColumn name attribute with a name != "book" then it works fine. 

If you use an auto-incremented interger Id it works. 


