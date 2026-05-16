<?php

namespace App\Constants\HR;

/**
 * Class AttendanceConstant
 *
 * Central constants for Attendance HR.
 * Can be used for configuration, table names, or CRUD references.
 */
class AttendanceConstant
{
    /**
     * Example: reference to Attendance model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\HR\\Attendance';

    /**
     * Example: table name of Attendance
     *
     * @var string
     */
    public const TABLE = 'Attendance_TABLE';

    /**
     * Example: default items per page for Attendance listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const STATUS_PRESENT = 1;

    public const STATUS_ABSENT = 2;

    public const STATUS_LEAVE = 3;

    public const STATUS_HALF_DAY = 4;

    public const LEAVE_ANNUAL = 1;

    public const LEAVE_SICK = 2;

    public const LEAVE_MATERNITY = 3;

    public function getStatuses(): array
    {
        return [
            self::STATUS_PRESENT => 'Present',
            self::STATUS_ABSENT => 'Absent',
            self::STATUS_LEAVE => 'Leave',
            self::STATUS_HALF_DAY => 'Half Day',
        ];
    }

    public function getLeaveTypes(): array
    {
        return [
            self::LEAVE_ANNUAL => 'Annual Leave',
            self::LEAVE_SICK => 'Sick Leave',
            self::LEAVE_MATERNITY => 'Maternity',
        ];
    }
}
