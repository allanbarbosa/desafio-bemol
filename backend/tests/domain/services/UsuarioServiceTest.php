<?php
declare(strict_types=1);

namespace Tests\domain\services;

use App\Models\UsuarioModel;
use App\Repositories\UsuarioRepositorio;
use App\Services\UsuarioServico;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Prophecy\PhpUnit\ProphecyTrait;
use Tests\TestCase;

class UsuarioServiceTest extends TestCase
{
    use ProphecyTrait;

    protected $service;
    protected $repository;

    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->prophesize(UsuarioRepositorio::class);
        $this->service = new UsuarioServico($this->repository->reveal());
    }

    public function test_create_a_usuario()
    {
        $input = $this->factoryData();
        $hash = '21e312323';

        Hash::shouldReceive('make')->once()->with($input['password'])->andReturn($hash);

        $repositoryData = $this->repositoryFactory($input, $hash);

        $usuario = new UsuarioModel($repositoryData);

        $this->repository->save($repositoryData)->willReturn($usuario)->shouldBeCalled();

        $resposta = $this->service->save($input);

        $input['firstAccess'] = $usuario->usua_first_access;
        $input['emailVerifiedAt'] = $usuario->usua_email_verified_at;
        unset($input['password']);

        $this->prophet->checkPredictions();
        $this->assertIsArray($resposta);
        $this->assertEquals($input, $resposta);
    }

    protected function repositoryFactory($input, $hashPassword): array
    {
        return [
            'usua_login' => $input['login'],
            'usua_password' => $hashPassword,
            'cliente_id' => $input['clienteId']
        ];
    }

    protected function factoryData()
    {
        $faker = Factory::create('pt_BR');

        return [
            'login' => $faker->email,
            'password' => $faker->password(),
            'clienteId' => 1
        ];
    }
}
