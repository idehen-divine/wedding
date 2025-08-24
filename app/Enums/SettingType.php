<?php

namespace App\Enums;

enum SettingType: string
{
    case TEXT = 'text';
    case TEXTAREA = 'textarea';
    case DATE = 'date';
    case TIME = 'time';
    case URL = 'url';
    case BOOLEAN = 'boolean';
    case AUDIO = 'audio';
}
