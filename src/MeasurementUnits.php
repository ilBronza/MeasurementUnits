<?php

namespace IlBronza\MeasurementUnits;

use IlBronza\CRUD\Providers\RouterProvider\IbRouter;
use IlBronza\CRUD\Providers\RouterProvider\RoutedObjectInterface;
use Illuminate\Support\Facades\File;

class MeasurementUnits implements RoutedObjectInterface
{
    public function manageMenuButtons()
    {
        if(! $menu = app('menu'))
            return;

        $settingsButton = $menu->provideButton([
                'text' => 'generals.settings',
                'name' => 'settings',
                'icon' => 'gear',
                'roles' => ['administrator']
            ]);

        $measurementUnitsManagerButton = $menu->createButton([
            'name' => 'measurementUnitsManager',
            'icon' => 'scale-unbalanced-flip',
            'text' => 'measurementUnits::measurementUnits.list',
        ]);

        $settingsButton->addChild($measurementUnitsManagerButton);

        $measurementUnitsManagerButton->addChild(
            $menu->createButton([
                'name' => 'measurementUnits.list',
                'icon' => 'list',
                'text' => 'measurementUnits::measurementUnits.list',
                'href' => IbRouter::route($this, 'measurementUnits.index')
            ])
        );
    }

    public function getBaseMeasurementUnitHelpersArray() : array
    {
        $result = [];

        foreach(File::files(__DIR__ . '/BaseMeasurementUnitHelpers') as $file)
        {
            if($file->getRelativePathname() == 'BaseMeasurementUnitHelper.php')
                continue;

            $measurementUnitClass = 'IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\\' . $file->getFilenameWithoutExtension();

            $measurementUnit = new $measurementUnitClass();

            $result[$file->getFilenameWithoutExtension()] = $measurementUnit->getSelectDescriptionString();
        }

        return $result;
    }

    public function getRoutePrefix() : ? string
    {
        return config('measurementUnits.routePrefix');
    }

    static function getController(string $target, string $controllerPrefix) : string
    {
        try
        {
            return config("measurementUnits.models.{$target}.controllers.{$controllerPrefix}");
        }
        catch(\Throwable $e)
        {
            dd([$e->getMessage(), 'dichiara ' . "measurementUnits.models.{$target}.controllers.{$controllerPrefix}"]);
        }
    }

}