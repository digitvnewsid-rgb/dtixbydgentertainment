<?php

namespace App\Enums;

enum ScanStatus: string
{
    case Success = 'success';
    case Failed = 'failed';
}
