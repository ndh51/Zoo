<?php

namespace App\Factory;

use App\Entity\PassageEvenement;
use App\Repository\PassageEvenementRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<PassageEvenement>
 *
 * @method        PassageEvenement|Proxy                     create(array|callable $attributes = [])
 * @method static PassageEvenement|Proxy                     createOne(array $attributes = [])
 * @method static PassageEvenement|Proxy                     find(object|array|mixed $criteria)
 * @method static PassageEvenement|Proxy                     findOrCreate(array $attributes)
 * @method static PassageEvenement|Proxy                     first(string $sortedField = 'id')
 * @method static PassageEvenement|Proxy                     last(string $sortedField = 'id')
 * @method static PassageEvenement|Proxy                     random(array $attributes = [])
 * @method static PassageEvenement|Proxy                     randomOrCreate(array $attributes = [])
 * @method static PassageEvenementRepository|RepositoryProxy repository()
 * @method static PassageEvenement[]|Proxy[]                 all()
 * @method static PassageEvenement[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static PassageEvenement[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static PassageEvenement[]|Proxy[]                 findBy(array $attributes)
 * @method static PassageEvenement[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static PassageEvenement[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class PassageEvenementFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'Evenement' => EvenementFactory::random(),
            'hDebEvenement' => self::faker()->time('H:i'),
            'datePassage' => self::faker()->dateTime(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(PassageEvenement $passageEvenement): void {})
        ;
    }

    protected static function getClass(): string
    {
        return PassageEvenement::class;
    }
}
