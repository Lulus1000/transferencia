<?php
declare(strict_types=1);

namespace App\Controller;
use App\Model\Entity\Transferencia;


class UsuariosController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Transferencias');
    }

    public function index()
    {
        $usuarios = $this->paginate($this->Usuarios);

        $this->set(compact('usuarios'));
    }


    public function view($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('usuario'));
    }


    public function add()
    {
        $usuario = $this->Usuarios->newEmptyEntity();
        if ($this->request->is('post')) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('Usuário salvo!'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Algo está errado,tente novamente ou você ja possui cadastro no sistema'));
        }
        $this->set(compact('usuario'));
    }

    public function transferencia()
    {
        $transferencia = $this->Transferencias->newEmptyEntity();
        if ($this->request->is('post')) {
            $transferencia = $this->Transferencias->patchEntity($transferencia, $this->request->getData());
            $remetente = $this->Usuarios->get($transferencia->remetente);

            if ($remetente->tipo_usuario == 2) {
                $this->Flash->error(('Usuários do tipo logista não podem fazer transferencias!'));
                return $this->redirect(['action' => 'index']);
            }

            if ($remetente->saldo < $transferencia->valor) {
                $this->Flash->error(('Saldo insuficiente para a transferencia!'));
                return $this->redirect(['action' => 'index']);
            }

            if ($this->Transferencias->save($transferencia)) {
                $destinatario = $this->Usuarios->get($transferencia->destinatario);
                $destinatario->saldo = $destinatario->saldo + $transferencia->valor;

                $remetente->saldo = $remetente->saldo - $transferencia->valor;

                if ($this->Usuarios->save($destinatario) && $this->Usuarios->save($remetente)) {
                    $this->Flash->success(('Transferido com sucesso !'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(('Erro de transferênica usuario não finalizou transação'));
                }
            }

            $this->Flash->error(('Tente de novo!'));
        }

        $this->set(compact('transferencia'));
    }

    public function edit($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('The usuario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The usuario could not be saved. Please, try again.'));
        }
        $this->set(compact('usuario'));
    }


    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usuario = $this->Usuarios->get($id);
        if ($this->Usuarios->delete($usuario)) {
            $this->Flash->success(__('Usuário Removido'));
        } else {
            $this->Flash->error(__('Este usuario está em uso,não pode ser removido));
        }

        return $this->redirect(['action' => 'index']);
    }
}
