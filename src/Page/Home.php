<?php

namespace App\Page;


class Home extends AbstractPage
{
    public function render(): string
    {
        $events = \CRest::call('event.get');
        $placementList = \CRest::call('placement.get', []);

        $html = '<div class="container-flex">';
        // Placement list (слева)
        $html .= '<div class="list-block">';
        $html .= '<div class="list-title">Placement list</div>';
        $html .= '<form method="GET" action="?page=placement" style="margin-bottom: 10px;">
            <button type="submit" class="item-add">Добавить</button>
        </form>';

        foreach ($placementList['result'] as $placement) {
            $html .= '<div class="item-card">';
            $html .= '<form method="POST" action="?page=placement" style="display:inline;">
            <input type="hidden" name="unbind" value="Y">
            <input type="hidden" name="placement" value="' . htmlspecialchars($placement['placement']) . '">
            <button type="submit" class="item-remove" title="Удалить встройку" onclick="return confirm(\'Удалить встройку?\')">&times;</button>
        </form>';
            $html .= '<span class="item-label">Title:</span> <span class="item-value">' . htmlspecialchars($placement['title']) . '</span><br>';
            $html .= '<span class="item-label">Description:</span> <span class="item-value">' . htmlspecialchars($placement['description']) . '</span><br>';
            $html .= '<span class="item-label">Placement:</span> <span class="item-value">' . htmlspecialchars($placement['placement']) . '</span><br>';
            $html .= '<span class="item-label">Handler:</span> <span class="item-value">' . htmlspecialchars($placement['handler']) . '</span><br>';
            $html .= '</div>';
        }
        $html .= '</div>';

        // Event list (справа)
        $html .= '<div class="list-block">';
        $html .= '<div class="list-title">Event list</div>';
        $html .= '<form method="GET" action="?page=event" style="margin-bottom: 10px;">
        <button type="submit" class="item-add">Добавить</button>
    </form>';
        foreach ($events['result'] as $event) {
            $html .= '<div class="item-card">';
            $html .= '<form method="POST" action="?page=event" style="display:inline;">
            <input type="hidden" name="unbind" value="Y">
            <input type="hidden" name="event" value="' . htmlspecialchars($event['event']) . '">
            <input type="hidden" name="handler" value="' . htmlspecialchars($event['handler']) . '">
            <input type="hidden" name="auth_type" value="' . ((int)$event['auth_type']) . '">
            <input type="hidden" name="event_type" value="' . ($event['offline'] ? 'offline' : 'online') . '">
            <button type="submit" class="item-remove" title="Удалить событие" onclick="return confirm(\'Удалить событие?\')">&times;</button>
        </form>';
            $html .= '<span class="item-label">Event:</span> <span class="item-value">' . htmlspecialchars($event['event']) . '</span><br>';
            $html .= '<span class="item-label">Handler:</span> <span class="item-value">' . htmlspecialchars($event['handler']) . '</span><br>';
            $html .= '<span class="item-label">auth_type:</span> <span class="item-value">' . $event['auth_type'] . '</span><br>';
            $html .= '<span class="item-label">Is offline:</span> <span class="item-value">' . ($event['offline'] ? 'yes' : 'no') . '</span><br>';
            $html .= '</div>';
        }
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    public function getId(): string
    {
        return 'home';
    }
}