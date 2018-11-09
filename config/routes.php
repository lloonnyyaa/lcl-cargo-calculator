<?php

return [
    '/api/get-messages/([0-9]+)' => ['class' => app\controllers\ApiController::class, 'method' => 'get'],
    '/api/sended-message/([0-9]+)' => ['class' => app\controllers\ApiController::class, 'method' => 'sended'],
    '/api/get-messages' => ['class' => app\controllers\ApiController::class, 'method' => 'getAll'],
    '/api/unsended-messages' => ['class' => app\controllers\ApiController::class, 'method' => 'unsended'],
    '/api/add-client/([0-9]+)/([0-9]+)' => ['class' => app\controllers\ApiController::class, 'method' => 'addClient'],
    '/api/delete-client/([0-9]+)' => ['class' => app\controllers\ApiController::class, 'method' => 'deleteClient'],
    
    '/calc' => ['class' => app\controllers\SiteController::class, 'method' => 'calc'],
    '/code' => ['class' => app\controllers\SiteController::class, 'method' => 'code'],
    '/' => ['class' => app\controllers\SiteController::class, 'method' => 'index'],
];