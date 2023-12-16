<?php

namespace App\Factory;

use App\Entity\ReservationEvenement;
use App\Repository\ReservationEvenementRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ReservationEvenement>
 *
 * @method        ReservationEvenement|Proxy create(array|callable $attributes = [])
 * @method static ReservationEvenement|Proxy createOne(array $attributes = [])
 * @method static ReservationEvenement|Proxy find(object|array|mixed $criteria)
 * @method static ReservationEvenement|Proxy findOrCreate(array $attributes)
 * @method static ReservationEvenement|Proxy first(string $sortedField = 'id')
 * @method static ReservationEvenement|Proxy last(string $sortedField = 'id')
 * @method static ReservationEvenement|Proxy random(array $attributes = [])
 * @method static ReservationEvenement|Proxy randomOrCreate(array $attributes = [])
 * @method static ReservationEvenementRepository|RepositoryProxy repository()
 * @method static ReservationEvenement[]|Proxy[] all()
 * @method static ReservationEvenement[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ReservationEvenement[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static ReservationEvenement[]|Proxy[] findBy(array $attributes)
 * @method static ReservationEvenement[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ReservationEvenement[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ReservationEvenementFactory extends ModelFactory
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
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ReservationEvenement $reservationEvenement): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ReservationEvenement::class;
    }
}
