<?php

namespace PHPHub\Events;

abstract class Event
{
    // Eloquent 事件
    const CREATING = 'creating';
    const CREATED = 'created';
    const UPDATING = 'updating';
    const UPDATED = 'updated';
    const SAVING = 'saving';
    const SAVED = 'saved';
}
