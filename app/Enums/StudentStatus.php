<?php

namespace App\Enums;

enum StudentStatus : string
{
    case WAITING = 'WAITING';
    case IN_PROGRESS = 'IN_PROGRESS';
    case APPLIED = 'APPLIED';
    case MISSING_DOCUMENT = 'MISSING_DOCUMENT';
    case ACCEPTED = 'ACCEPTED';
    case PENDING_REGISTRATION = 'PENDING_REGISTRATION';
    case REJECTED = 'REJECTED';
    case SECOND_STEP = 'SECOND_STEP';
    case WILL_ATTEND_INTERVIEW = 'WILL_ATTEND_INTERVIEW';

    public function label(): string
    {
        return match ($this) {
            self::WAITING => 'Gözləyir',
            self::IN_PROGRESS => 'İcradadır',
            self::APPLIED => 'Müraciət olunub',
            self::MISSING_DOCUMENT => 'Əksik Sənəd',
            self::ACCEPTED => 'Qəbul',
            self::PENDING_REGISTRATION => 'Qeydiyyat gözləyir',
            self::REJECTED => 'İmtina',
            self::SECOND_STEP => 'İkinci Tur',
            self::WILL_ATTEND_INTERVIEW => 'Mülakata Girecek',
        };
    }

    public static function getStatus($status): string
    {
        return match ($status) {
            self::WAITING->value => 'Gözləyir',
            self::IN_PROGRESS->value => 'İcradadır',
            self::APPLIED->value => 'Müraciət olunub',
            self::MISSING_DOCUMENT->value => 'Əksik Sənəd',
            self::ACCEPTED->value => 'Qəbul',
            self::PENDING_REGISTRATION->value => 'Qeydiyyat gözləyir',
            self::REJECTED->value => 'İmtina',
            self::SECOND_STEP->value => 'İkinci Tur',
            self::WILL_ATTEND_INTERVIEW->value => 'Mülakata Girecek',
        };
    }
//    public static function getStatus(string $status): string
//    {
//        return match ($status) {
//            self::WAITING->value => 'Gözləyir',
//            self::IN_PROGRESS->value => 'İcradadır',
//            self::APPLIED->value => 'Müraciət olunub',
//            self::MISSING_DOCUMENT->value => 'Əksik Sənəd',
//            self::ACCEPTED->value => 'Qəbul',
//            self::PENDING_REGISTRATION->value => 'Qeydiyyat gözləyir',
//            self::REJECTED->value => 'İmtina',
//            self::SECOND_STEP->value => 'İkinci Tur',
//            self::WILL_ATTEND_INTERVIEW->value => 'Mülakata Girecek',
//            default => 'Unknown',
//        };
//    }


//$status = StudentStatus::WAITING;
//echo $status->value; // Outputs: Gözleyir
//
//echo $status->label(); // Outputs: Waiting
}
