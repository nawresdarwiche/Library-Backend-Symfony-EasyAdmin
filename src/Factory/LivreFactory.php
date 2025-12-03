<?php

namespace App\Factory;

use App\Entity\Livre;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Livre>
 */
final class LivreFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Livre::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'dateEdition' => self::faker()->text(255),
            'isbn' => self::faker()->text(50),
            'nbExemplaires' => self::faker()->randomNumber(),
            'nbPages' => self::faker()->randomNumber(),
            'prix' => self::faker()->randomFloat(),
            'titre' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Livre $livre): void {})
        ;
    }
}
