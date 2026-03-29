<?php

namespace IlBronza\MeasurementUnits\Http\Middleware;

use IlBronza\CRUD\Middleware\CRUDBasePackageMiddlewareRolesPermissions;

/**
 * Resolves allowed roles for MeasurementUnits routes from config (measurementunits.defaultRoles / measurementunits.routeRoles).
 */
class MeasurementUnitsMiddlewareRolesPermissions extends CRUDBasePackageMiddlewareRolesPermissions
{
    protected string $configPackageName = 'measurementunits';
}
