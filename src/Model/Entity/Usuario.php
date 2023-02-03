<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Usuario extends Entity
{
 
    protected $_accessible = [
        'nome_completo' => true,
        'cpf' => true,
        'email' => true,
        'senha' => true,
        'saldo' => true,
    ];
}
