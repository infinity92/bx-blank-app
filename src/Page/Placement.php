<?php

namespace App\Page;

use App\View\ErrorAlert;
use App\View\SuccessAlert;

class Placement extends AbstractPage
{
    public function render(): string
    {
        $alerts = '';
        if ($this->request->isPostMethod()) {
            $result = null;
            if ($this->request->post('unbind', 'N') === 'Y') {
                $result = \CRest::call('placement.unbind', ['PLACEMENT' => $_REQUEST['placement']]);
            } elseif ($this->request->post('bind', 'N') === 'Y') {
                $result = \CRest::call(
                    'placement.bind',
                    [
                        'PLACEMENT' => $this->request->post('placement'),
                        'HANDLER' => $_REQUEST['handler'],
                        'LANG_ALL' => [
                            'en' => [
                                'TITLE' => $_REQUEST['en_title'],
                                'DESCRIPTION' => $_REQUEST['en_title'],
                            ],
                            'ru' => [
                                'TITLE' => $_REQUEST['ru_title'],
                                'DESCRIPTION' => $_REQUEST['ru_description'],
                            ],
                        ],
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
                    <label for="placement">Placement</label>
                    <input type="text" id="placement" name="placement" value="">
                </div>
                <div class="form-group">
                    <label for="handler">Handler</label>
                    <input type="text" id="handler" name="handler" value="http://app.local/index.php">
                </div>
                <div class="form-group">
                    <label for="ru_title">Заголовок (RU)</label>
                    <input type="text" id="ru_title" name="ru_title" value="Тестовая встройка">
                </div>
                <div class="form-group">
                    <label for="ru_description">Описание (RU)</label>
                    <input type="text" id="ru_description" name="ru_description" value="Встройка из тестового приложения для тестирования встроек">
                </div>
                <div class="form-group">
                    <label for="en_title">Заголовок (EN)</label>
                    <input type="text" id="en_title" name="en_title" value="Test placement">
                </div>
                <div class="form-group">
                    <label for="en_description">Описание (EN)</label>
                    <input type="text" id="en_description" name="en_description" value="Placement for testing placement from test app">
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        ';
    }

    public function getId(): string
    {
        return 'placement';
    }
}