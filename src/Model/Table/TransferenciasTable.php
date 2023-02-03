<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TransferenciasTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('transferencias');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('remetente')
            ->requirePresence('remetente', 'create')
            ->notEmptyString('remetente');

        $validator
            ->integer('destinatario')
            ->requirePresence('destinatario', 'create')
            ->notEmptyString('destinatario');

        $validator
            ->decimal('valor')
            ->requirePresence('valor', 'create')
            ->notEmptyString('valor');

        $validator
            ->date('data_hora')
            ->allowEmptyDate('data_hora');

        return $validator;
    }
}
