<?php

namespace App\Enums;

enum SettingGroup: string
{
    case GENERAL = 'general';
    case CEREMONY = 'ceremony';
    case RECEPTION = 'reception';
    case SOCIAL = 'social';
    case CONTACT = 'contact';
    case MUSIC = 'music';
}
