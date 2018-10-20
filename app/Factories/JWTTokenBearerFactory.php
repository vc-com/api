<?php

namespace VoceCrianca\Factories;

use Illuminate\Http\Request;
use VoceCrianca\Repositories\User\UserRepositoryInterface;
use JWTAuth;
use JWTFactory;

/**
 * Class JWTTokenBearerFactory
 * @package App\Factories
 */
class JWTTokenBearerFactory {

    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function generate(Request $request)
    {

        $user = $this->repository->whereFirst(['email' => $request->email]);

        $factory = JWTFactory::customClaims([
            'sub' => $user
        ]);

        $payload = $factory->make();

        return (string) JWTAuth::encode($payload);

    }

}
