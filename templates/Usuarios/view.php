<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Visualizar Cadastro do Usuário') ?></h4>
            <?= $this->Html->link(__('Voltar'), ['action' => 'index']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="usuarios view content">
            <h3><?= h($usuario->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($usuario->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nome Completo') ?></th>
                    <td><?= h($usuario->nome_completo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cpf') ?></th>
                    <td><?= h($usuario->cpf) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($usuario->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Senha') ?></th>
                    <td><?= h($usuario->senha) ?></td>
                </tr>
             
                <tr>
                    <th><?= __('Saldo') ?></th>
                    <td><?= $this->Number->format($usuario->saldo) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
