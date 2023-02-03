<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsuariosTable extends Table
{
  
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('usuarios');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('nome_completo')
            ->maxLength('nome_completo', 100)
            ->requirePresence('nome_completo', 'create')
            ->notEmptyString('nome_completo');

        $validator
            ->scalar('cpf')
            ->maxLength('cpf', 20)
            ->requirePresence('cpf', 'create')
            ->notEmptyString('cpf')
            ->add('cpf', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('senha')
            ->maxLength('senha', 100)
            ->requirePresence('senha', 'create')
            ->notEmptyString('senha');

        $validator
            ->decimal('saldo')
            ->notEmptyString('saldo');

        return $validator;
    }


    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['cpf', 'email']), ['errorField' => 'cpf']);
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);

        return $rules;
    }
}
