<?php
namespace App\Enums;
enum BookCopyStatus: string { case AT_POINT = 'AT_POINT'; case WITH_READER = 'WITH_READER'; case LOST_OR_UNKNOWN = 'LOST_OR_UNKNOWN'; }
