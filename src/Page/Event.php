<?php

namespace App\Page;

use App\View\ErrorAlert;
use App\View\SuccessAlert;

class Event extends AbstractPage
{
    public function render(): string
    {
        $alerts = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = null;
            if (isset($_REQUEST['unbind']) && $_REQUEST['unbind'] === 'Y') {
                $result = \CRest::call('event.unbind', [
                    'event' => $_REQUEST['event'],
                    'handler' => $_REQUEST['handler'],
                    'auth_type' => $_REQUEST['auth_type'],
                    'event_type' => $_REQUEST['event_type'],
                ]);
            } elseif (isset($_REQUEST['bind']) && $_REQUEST['bind'] === 'Y') {
                $result = \CRest::call(
                    'event.bind',
                    [
                        'event' => $_REQUEST['event'],
                        'handler' => $_REQUEST['handler'],
                        'auth_type' => (int)$_REQUEST['auth_type'],
                        'auth_connector' => empty($_REQUEST['auth_connector']) ? null : $_REQUEST['auth_connector'],
                    ]
                );
                $_SESSION['result'] = $result;
            }

            if (isset($result['error'])) {
                $alerts = (new ErrorAlert('['.$result['error'].'] ' . $result['error_description'] ))->render();
            }
            elseif (isset($result['result']) && $result['result'] === true) {
                $alerts = (new SuccessAlert('Добавление события прошло успешно.'))->render();
            }
        }

        return $alerts.'
            <form method="POST" class="placement-form">
                <input type="hidden" name="bind" value="Y">
                <div class="form-group">
                    <label for="event">Event</label>
                    <input type="text" id="event" name="event" value="">
                </div>
                <div class="form-group">
                    <label for="handler">Handler</label>
                    <input type="text" id="handler" name="handler" value="http://app.local/index.php?page=event_handler">
                </div>
                <div class="form-group">
                    <label for="auth_type">Идентификатор пользователя (под которым авторизуется обработчик события)</label>
                    <input type="text" id="auth_type" name="auth_type" value="1">
                </div>
                <div class="form-group">
                    <label for="auth_connector">Ключ источника (для офлайн-событий)</label>
                    <input type="text" id="auth_connector" name="auth_connector" value="">
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        ';
    }

    public function getId(): string
    {
        return 'event';
    }
}