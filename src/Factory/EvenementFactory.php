<?php

namespace App\Factory;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Evenement>
 *
 * @method        Evenement|Proxy                     create(array|callable $attributes = [])
 * @method static Evenement|Proxy                     createOne(array $attributes = [])
 * @method static Evenement|Proxy                     find(object|array|mixed $criteria)
 * @method static Evenement|Proxy                     findOrCreate(array $attributes)
 * @method static Evenement|Proxy                     first(string $sortedField = 'id')
 * @method static Evenement|Proxy                     last(string $sortedField = 'id')
 * @method static Evenement|Proxy                     random(array $attributes = [])
 * @method static Evenement|Proxy                     randomOrCreate(array $attributes = [])
 * @method static EvenementRepository|RepositoryProxy repository()
 * @method static Evenement[]|Proxy[]                 all()
 * @method static Evenement[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Evenement[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Evenement[]|Proxy[]                 findBy(array $attributes)
 * @method static Evenement[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Evenement[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class EvenementFactory extends ModelFactory
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
            'dateDebEvent' => self::faker()->text(30),
            'dateFinEvent' => self::faker()->text(30),
            'descEvent' => self::faker()->text(30),
            'nbPlaceMaxEvent' => self::faker()->randomNumber(),
            'nomEvent' => self::faker()->text(30),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Evenement $evenement): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Evenement::class;
    }
}
