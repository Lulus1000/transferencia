<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Transferencia extends Entity
{
  
    protected $_accessible = [
        'remetente' => true,
        'destinatario' => true,
        'valor' => true,
        'data_hora' => true,
    ];
}
