<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsuariosFixture
 */
class UsuariosFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'nome_completo' => 'Lorem ipsum dolor sit amet',
                'cpf' => 'Lorem ipsum dolor ',
                'email' => 'Lorem ipsum dolor sit amet',
                'senha' => 'Lorem ipsum dolor sit amet',
                'saldo' => 1.5,
            ],
        ];
        parent::init();
    }
}
