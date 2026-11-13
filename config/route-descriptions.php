<?php

$prefix = (string) config('measurementunits.routePrefix');

return [
    $prefix . 'measurementUnits.index' => 'Mostra l’elenco delle unità di misura.',
    $prefix . 'measurementUnits.create' => 'Mostra il modulo per creare un’unità di misura.',
    $prefix . 'measurementUnits.store' => 'Salva una nuova unità di misura.',
    $prefix . 'measurementUnits.show' => 'Mostra i dettagli dell’unità di misura.',
    $prefix . 'measurementUnits.edit' => 'Mostra il modulo di modifica dell’unità di misura.',
    $prefix . 'measurementUnits.update' => 'Salva le modifiche dell’unità di misura.',
    $prefix . 'measurementUnits.destroy' => 'Elimina un’unità di misura.',
];
