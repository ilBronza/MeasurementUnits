<?php

namespace IlBronza\MeasurementUnits;

use IlBronza\CRUD\Providers\RouterProvider\IbRouter;
use IlBronza\CRUD\Providers\RouterProvider\RoutedObjectInterface;

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
            'icon' => 'user-gear',
            'text' => 'measurementUnits::measurementUnits.list',
        ]);

        $settingsButton->addChild($measurementUnitsManagerButton);

        $measurementUnitsManagerButton->addChild(
            $menu->createButton([
                'name' => 'measurementUnits.list',
                'icon' => 'truck-moving',
                'text' => 'measurementUnits::measurementUnits.list',
                'href' => IbRouter::route($this, 'measurementUnits.index')
            ])
        );
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