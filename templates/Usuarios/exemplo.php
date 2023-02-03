<?php>

  class Usuario extends AppModel {
    
    public $validate = array(
        'nomeCompleto' => array(
            'rule' => 'notBlank',
            'message' => 'Nome completo é obrigatório'
        ),
        'cpf' => array(
            'rule' => 'isUnique',
            'message' => 'CPF já está em uso'
        ),
        'email' => array(
            'rule' => 'isUnique',
            'message' => 'E-mail já está em uso'
        ),
        'senha' => array(
            'rule' => 'notBlank',
            'message' => 'Senha é obrigatória'
        ),
    );
  
    public function transferir($origemId, $destinoId, $valor) {
        // INICIO DA TRANSACAO
        $this->begin();

        $origem = $this->findById($origemId);
        $destino = $this->findById($destinoId);
        // Verificar se o usuário de origem tem saldo suficiente
        if ($origem['Usuario']['saldo'] < $valor) {
            $this->rollback();
            return 'Saldo insuficiente';
        }
        $usuarioDestino = $this->Usuarios->get($destinoId);
        
        if ($usuarioDestino->tipo == 'lojista') {
            // Realiza a transferência
            // Consultar o serviço autorizador externo
            $autorizacao = file_get_contents('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');

            if ($autorizacao !== 'autorizado') {
                $this->rollback();
                return 'Transferência não autorizada';
            }

            // Atualizar os saldos
            $origem['Usuario']['saldo'] -= $valor;
            $destino['Usuario']['saldo'] += $valor;
            $this->save($origem);
            $this->save($destino);
            $notificacao = file_get_contents('http://o4d9z.mocklab.io/notify');

            if (!$notificacao) {
                $this->rollback();
                return 'Falha ao enviar notificação';
            }
            $this->commit();
            return 'Transferência realizada com sucesso';
            } else {
                $this->Flash->error(__('Usuários do tipo lojista só podem receber transferências.'));
                return $this->redirect(['action' => 'index']);
            }
        }
  }
  