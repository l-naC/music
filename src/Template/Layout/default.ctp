<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Gestionnaire de music';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?> - 
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('reset.css') ?>
    <?= $this->Html->css('main.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
     <header>
        <h1><?= $this->Html->link('Artists !', ['controller' => 'artists', 'action' => 'index']) ?></h1>
        <nav>
            <?= $this->Html->link('Liste des artist', ['controller' => 'artists', 'action' => 'index'], [ 'class' => ($this->templatePath == 'Artists' && $this->template == 'index') ? 'active' : '']) ?>
            <?= $this->Html->link('Ajouter un artist', ['controller' => 'artists', 'action' => 'add'], [ 'class' => ($this->templatePath == 'Artists' && $this->template == 'add') ? 'active' : '']) ?>
        </nav>
    </header>
    <main>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </main>
</body>
</html>
