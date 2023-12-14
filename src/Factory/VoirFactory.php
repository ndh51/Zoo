<?php

namespace App\Factory;

use App\Entity\Voir;
use App\Repository\VoirRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Voir>
 *
 * @method        Voir|Proxy create(array|callable $attributes = [])
 * @method static Voir|Proxy createOne(array $attributes = [])
 * @method static Voir|Proxy find(object|array|mixed $criteria)
 * @method static Voir|Proxy findOrCreate(array $attributes)
 * @method static Voir|Proxy first(string $sortedField = 'id')
 * @method static Voir|Proxy last(string $sortedField = 'id')
 * @method static Voir|Proxy random(array $attributes = [])
 * @method static Voir|Proxy randomOrCreate(array $attributes = [])
 * @method static VoirRepository|RepositoryProxy repository()
 * @method static Voir[]|Proxy[] all()
 * @method static Voir[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Voir[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Voir[]|Proxy[] findBy(array $attributes)
 * @method static Voir[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Voir[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class VoirFactory extends ModelFactory
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
            'idAnimal' => AnimalFactory::random(),
            'idTicket' => TicketFactory::random(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Voir $voir): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Voir::class;
    }
}
