<?php

namespace App\Factory;

use App\Entity\Visiteur;
use App\Repository\VisiteurRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Visiteur>
 *
 * @method        Visiteur|Proxy                     create(array|callable $attributes = [])
 * @method static Visiteur|Proxy                     createOne(array $attributes = [])
 * @method static Visiteur|Proxy                     find(object|array|mixed $criteria)
 * @method static Visiteur|Proxy                     findOrCreate(array $attributes)
 * @method static Visiteur|Proxy                     first(string $sortedField = 'id')
 * @method static Visiteur|Proxy                     last(string $sortedField = 'id')
 * @method static Visiteur|Proxy                     random(array $attributes = [])
 * @method static Visiteur|Proxy                     randomOrCreate(array $attributes = [])
 * @method static VisiteurRepository|RepositoryProxy repository()
 * @method static Visiteur[]|Proxy[]                 all()
 * @method static Visiteur[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Visiteur[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Visiteur[]|Proxy[]                 findBy(array $attributes)
 * @method static Visiteur[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Visiteur[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class VisiteurFactory extends ModelFactory
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
        $nom = self::faker()->lastName();
        $prenom = self::faker()->firstName();
        $email = $nom.$prenom.'@'.self::faker()->domainName();
        $telephone = self::faker()->phoneNumber();
        $adresse = self::faker()->streetAddress();
        $ville = self::faker()->city();
        $cp = self::faker()->postcode();

        return [
            'CPVisiteur' => $cp,
            'email' => $email,
            'nomVisiteur' => $nom,
            'password' => 'test',
            'prenomVisiteur' => $prenom,
            'adVisiteur' => $adresse,
            'villeVisiteur' => $ville,
            'telVisiteur' => $telephone,
            'roles' => ['ROLE_USER'],
        ];
    }


    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Visiteur $visiteur): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Visiteur::class;
    }
}
