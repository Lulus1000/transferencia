<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TransferenciasFixture
 */
class TransferenciasFixture extends TestFixture
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
                'remetente' => 1,
                'destinatario' => 1,
                'valor' => 1.5,
                'data_hora' => '2023-02-03',
            ],
        ];
        parent::init();
    }
}
