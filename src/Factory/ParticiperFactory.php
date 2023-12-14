<?php

namespace App\Factory;

use App\Entity\Participer;
use App\Repository\ParticiperRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Participer>
 *
 * @method        Participer|Proxy                     create(array|callable $attributes = [])
 * @method static Participer|Proxy                     createOne(array $attributes = [])
 * @method static Participer|Proxy                     find(object|array|mixed $criteria)
 * @method static Participer|Proxy                     findOrCreate(array $attributes)
 * @method static Participer|Proxy                     first(string $sortedField = 'id')
 * @method static Participer|Proxy                     last(string $sortedField = 'id')
 * @method static Participer|Proxy                     random(array $attributes = [])
 * @method static Participer|Proxy                     randomOrCreate(array $attributes = [])
 * @method static ParticiperRepository|RepositoryProxy repository()
 * @method static Participer[]|Proxy[]                 all()
 * @method static Participer[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Participer[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Participer[]|Proxy[]                 findBy(array $attributes)
 * @method static Participer[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Participer[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class ParticiperFactory extends ModelFactory
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
            'evenement' => null,
            'animal' => null,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Participer $participer): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Participer::class;
    }
}
