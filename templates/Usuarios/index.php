<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Usuario> $usuarios
 */
?>
<head>
<style>
    .button {
        background-color: #00C087;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        text-align: center;
    }
</style>
</head>
<div class="usuarios index content">
    <?= $this->Html->link(__('TRANSFERENCIA'), ['action' => 'transferencia'], ['class' => 'button float-right']) ?>
    <h3><?= __('BEM-VINDO') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('nome_completo') ?></th>
                    <th><?= $this->Paginator->sort('cpf') ?></th>
                    <th><?= $this->Paginator->sort('cadastro') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= h($usuario->nome_completo) ?></td>
                    <td><?= h($usuario->cpf) ?></td>
                    <td>
                        <?= $this->Html->link(__('VER EXTRATO'), ['action' => 'view',$usuario->id ], ['class' => 'button']) ?>
                    </td>
                <tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>  
</div>
