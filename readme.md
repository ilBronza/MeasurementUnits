# MeasurementUnits

## Aggiornamento configurazione helper

Le configurazioni pubblicate prima della rinomina del namespace possono ancora
contenere riferimenti a `IlBronza\MeasurementUnits\BaseMeasurementUnits`.
Il namespace non esiste più: aggiornare gli import in
`config/measurementunits.php` a
`IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers` (per esempio
`Day::class`). Le configurazioni pubblicate non vengono aggiornate
automaticamente dal pacchetto.
 
