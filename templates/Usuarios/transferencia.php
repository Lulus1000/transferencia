<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transferencias $usuario
 */
?>
<head>
<style>
    .box {
    width: 49%;
    height: 200px;
    float: left;
    text-align: center;
    }
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
<div class="row">
    <div class="box" style="float: left;">
        <?= $this->Form->create($transferencia) ?>
        <fieldset>
            <legend><?= __('TRANSFERENCIA') ?></legend>
            <?php
                echo $this->Form->control('remetente');
                echo $this->Form->control('destinatario');
                echo $this->Form->control('valor');
            ?>
        </fieldset>
        <?= $this->Form->button(__('ENVIAR'),['class' => 'button']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
