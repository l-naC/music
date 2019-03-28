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
            <?= $this->Html->link('Liste des artistes', ['controller' => 'artists', 'action' => 'index'], [ 'class' => ($this->templatePath == 'Artists' && $this->template == 'index') ? 'active' : '']) ?>
            <?php if(($auth->user()) && ($auth->user('status')) == 'admin') { ?>
            <?= $this->Html->link('Ajouter un artiste', ['controller' => 'artists', 'action' => 'add'], [ 'class' => ($this->templatePath == 'Artists' && $this->template == 'add') ? 'active' : '']) ?>
            <?= $this->Html->link('Requete faites', ['controller' => 'requests', 'action' => 'index'], [ 'class' => ($this->templatePath == 'Requests' && $this->template == 'index') ? 'active' : '']) ?>
            <?php }elseif (($auth->user()) && ($auth->user('status')) != 'admin') { ?>
                <?= $this->Html->link('Requete à un admin', ['controller' => 'requests', 'action' => 'add'], [ 'class' => ($this->templatePath == 'Requests' && $this->template == 'add') ? 'active' : '']) ?>
            <?php } ?>
            <?php if(!($auth->user())) { ?>
                <?= $this->Html->link('Créer un compte', ['controller' => 'users', 'action' => 'add'], [ 'class' => ($this->templatePath == 'Users' && $this->template == 'add') ? 'active' : '']) ?>
                <?= $this->Html->link('Se connecter', ['controller' => 'users', 'action' => 'login'], [ 'class' => ($this->templatePath == 'Users' && $this->template == 'login') ? 'active' : '']) ?>
            <?php } else { ?>
                <?= $this->Html->link('Liste des utilisateurs', ['controller' => 'users', 'action' => 'index'], [ 'class' => ($this->templatePath == 'Users' && $this->template == 'index') ? 'active' : '']) ?>
                <?= $this->Html->link('Profil', ['controller' => 'users', 'action' => 'view', $auth->user('id'),$auth->user('id')], [ 'class' => ($this->templatePath == 'Users' && $this->template == 'logout') ? 'active' : '']) ?>
                <?= $this->Html->link('Se deconnecter', ['controller' => 'users', 'action' => 'logout'], [ 'class' => ($this->templatePath == 'Users' && $this->template == 'logout') ? 'active' : '']) ?>
            <?php } ?>
        </nav>
    </header>
    <main>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </main>
</body>
</html>
