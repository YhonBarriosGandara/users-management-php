<?php

declare(strict_types=1);

final class WebRoutes
{
    /**
     * @return array<string, array<string, string>>
     */
    public static function routes(): array
    {
        return array(
            'home' => array(
                'method' => 'GET',
                'action' => 'home',
            ),
            'users.create' => array(
                'method' => 'GET',
                'action' => 'create',
            ),
            'users.store' => array(
                'method' => 'POST',
                'action' => 'store',
            ),
            'users.index' => array(
                'method' => 'GET',
                'action' => 'index',
            ),
            'users.show' => array(
                'method' => 'GET',
                'action' => 'show',
            ),
            'users.edit' => array(
                'method' => 'GET',
                'action' => 'edit',
            ),
            'users.update' => array(
                'method' => 'POST',
                'action' => 'update',
            ),
            'users.delete' => array(
                'method' => 'POST',
                'action' => 'delete',
            ),
            'fincas.index' => array(
                'method' => 'GET',
                'action' => 'fincas.index',
            ),
            'fincas.create' => array(
                'method' => 'GET',
                'action' => 'fincas.create',
            ),
            'fincas.store' => array(
                'method' => 'POST',
                'action' => 'fincas.store',
            ),
            'fincas.show' => array(
                'method' => 'GET',
                'action' => 'fincas.show',
            ),
            'fincas.edit' => array(
                'method' => 'GET',
                'action' => 'fincas.edit',
            ),
            'fincas.update' => array(
                'method' => 'POST',
                'action' => 'fincas.update',
            ),
            'fincas.delete' => array(
                'method' => 'POST',
                'action' => 'fincas.delete',
            ),
            'auth.login' => array(
                'method' => 'GET',
                'action' => 'login',
            ),
            'auth.authenticate' => array(
                'method' => 'POST',
                'action' => 'authenticate',
            ),
            'auth.logout' => array(
                'method' => 'GET',
                'action' => 'logout',
            ),
            'auth.forgot' => array(
                'method' => 'GET',
                'action' => 'forgot',
            ),
            'auth.forgot.send' => array(
                'method' => 'POST',
                'action' => 'forgot.send',
            ),
        );
    }
}