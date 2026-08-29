# Sistemazione del package MeasurementUnits

Questo documento può essere dato direttamente a Cursor come contesto operativo.

Prompt consigliato:

> Leggi interamente `CURSOR_TASK.md`, esamina il codice indicato e implementa le correzioni in ordine. Preserva le modifiche già presenti nel working tree, aggiungi o aggiorna i test per ogni comportamento corretto e alla fine esegui tutta la suite. Non fare commit e non modificare file estranei al task. Se una scelta di dominio non è deducibile dal codice, fermati e spiegami le alternative prima di implementarla.

## Stato iniziale da preservare

Il working tree contiene già modifiche non committate in:

- `src/BaseMeasurementUnitHelpers/Day.php`
- `src/BaseMeasurementUnitHelpers/Year.php`
- `tests/Unit/YearTest.php`

Queste modifiche correggono le differenze temporali negative e parte della simmetria di `Year::remove()`. I test relativi passano: vanno integrate e non sovrascritte.

Prima di lavorare eseguire:

```bash
git status --short
git diff -- src/BaseMeasurementUnitHelpers/Day.php src/BaseMeasurementUnitHelpers/Year.php tests/Unit/YearTest.php
```

## Risultato diagnostico

La suite attuale esegue 90 test e produce 13 fallimenti:

- 12 fallimenti causati dalla validazione errata dei valori numerici piatti;
- 1 fallimento perché l'helper `Hour` esiste ma manca dalla configurazione.

Gli altri problemi elencati sotto non sono ancora coperti adeguatamente dai test.

## 1. Correggere la validazione delle unità numeriche

File: `src/BaseMeasurementUnitHelpers/Traits/MeasurementUnitFlatMethodsTrait.php`

In `validateInputs()` viene controllato due volte `$amount`. Il secondo controllo deve validare `$value`.

Comportamento richiesto:

- `$value` e `$amount` devono essere numerici;
- stringhe numeriche come `'10'` e `'5'` devono continuare a essere accettate;
- valori come `'dieci'`, `null`, array e oggetti devono produrre un'eccezione applicativa comprensibile prima dell'operazione aritmetica;
- non deve emergere un `TypeError` nativo da `$value + $amount`.

I test già presenti in `tests/Unit/FlatMeasurementUnitTest.php` devono diventare verdi. Aggiungere casi per `remove()` se necessario, perché usa la stessa validazione.

## 2. Registrare correttamente l'helper Hour

File principali:

- `src/BaseMeasurementUnitHelpers/Hour.php`
- `config/measurementunits.php`
- `src/Helpers/BaseMeasurementUnitCreatorHelper.php`
- `tests/Feature/BaseMeasurementUnitHelpersRegistryTest.php`

`Hour` esiste, ha traduzioni e compare nell'elenco costruito dai file presenti su disco, ma non è dichiarato in `measurementunits.helpers`.

Azioni richieste:

- importare `Hour` nel file di configurazione;
- aggiungerlo alla mappa `helpers`;
- verificare che possa essere creato tramite `BaseMeasurementUnitCreatorHelper`;
- mantenere verde il test che confronta helper su disco e helper configurati.

Rendere inoltre il factory difensivo: una chiave helper assente o una classe non valida deve generare un'eccezione esplicita con il nome richiesto, non un errore opaco provocato da `new null`.

## 3. Rendere coerenti base unit e coefficiente

File principali:

- `src/Models/MeasurementUnit.php`
- `src/Http/Controllers/Providers/Fieldsets/MeasurementUnitCreateStoreFieldsetsParameters.php`
- `src/Http/Controllers/Providers/Fieldsets/MeasurementUnitEditUpdateFieldsetsParameters.php`
- `database/migrations/2023_08_09_121432_add_proportion_fields_to_measurement_units_table.php`

Problemi:

- `base_measurement_unit` è nullable, ma `getBaseMeasurementUnitHelper()` dichiara `string`;
- `proportion_toward_base_measurement_unit` è nullable, ma `getProportionCoefficien()` dichiara `float`;
- la validazione accetta il coefficiente `0`, mentre `getFromBaseUnitValue()` divide per tale valore;
- un helper sconosciuto arriva al factory senza un messaggio utile.

Scelta di dominio raccomandata:

- per i nuovi inserimenti e aggiornamenti, base unit e coefficiente devono essere valorizzati insieme;
- il coefficiente deve essere strettamente maggiore di zero (`gt:0`);
- il modello deve comunque gestire in modo esplicito eventuali record legacy con valori nulli, tramite un default semanticamente corretto oppure un'eccezione di dominio chiara;
- non nascondere silenziosamente dati invalidi.

Prima di scegliere tra default e eccezione per i record legacy, cercare gli utilizzi del modello negli altri package. Se dal codice non emerge una semantica univoca, chiedere conferma.

Aggiungere test per:

- coefficiente `1` (conversione identità);
- coefficiente valido diverso da `1`;
- coefficiente `0`;
- coefficiente nullo/record legacy;
- helper nullo o sconosciuto.

## 4. Completare il rollback della migrazione

File: `database/migrations/2023_08_09_121432_add_proportion_fields_to_measurement_units_table.php`

Il metodo `down()` è vuoto. Deve rimuovere entrambe le colonne introdotte da `up()`:

- `base_measurement_unit`
- `proportion_toward_base_measurement_unit`

Se l'infrastruttura di test lo permette, aggiungere un test che esegua migration e rollback. Non modificare la vecchia migrazione in modo incompatibile con installazioni esistenti oltre al completamento del suo `down()`.

## 5. Definire il comportamento degli importi negativi in Year

File principali:

- `src/BaseMeasurementUnitHelpers/Year.php`
- `tests/Unit/YearTest.php`

Attualmente `-1.5` viene trattato come `-2` anni: `floor(-1.5)` restituisce `-2` e la parte frazionaria negativa viene ignorata.

Comportamento raccomandato:

- supportare importi negativi in maniera simmetrica, oppure rifiutarli esplicitamente con validazione;
- non lasciare il comportamento accidentale attuale;
- mantenere `add()` e `remove()` inversi per quanto consentito dalle regole di calendario;
- non mutare l'istanza Carbon ricevuta;
- documentare nei test come vengono convertite le frazioni di anno (`floor(365 * frazione assoluta)`).

Test minimi:

- `add(data, -1.5)`;
- `remove(data, -1.5)`;
- proprietà di andata/ritorno con valori positivi e negativi;
- almeno un caso vicino a un anno bisestile.

## 6. Dichiarare le dipendenze Composer reali

File: `composer.json`

La sezione `require` è vuota, ma il package usa almeno Laravel/Illuminate, Carbon e diversi package IlBronza (`CRUD`, `Form`, `Datatables`, ed eventuali altri risultanti dalla scansione degli import).

Azioni richieste:

- ricavare nomi Composer e vincoli compatibili dai package fratelli e dalle applicazioni che consumano MeasurementUnits;
- dichiarare PHP e tutte le dipendenze runtime dirette;
- evitare vincoli inventati o eccessivamente larghi;
- verificare che `composer validate --no-check-publish` passi;
- se possibile, verificare un'installazione pulita senza affidarsi all'autoload automatico di tutti i package fratelli.

Nota: `orchestra/testbench` resta una dipendenza di sviluppo.

## 7. Verifica finale

Nel workspace IlBronza la suite può essere eseguita con:

```bash
python3 ../.ibtest/bin/ibtest.py MeasurementUnits
```

Il wrapper condiviso potrebbe non propagare correttamente l'exit code di PHPUnit: controllare il testo finale e assicurarsi che contenga un risultato positivo e nessuna sezione `FAILURES!`.

Eseguire inoltre:

```bash
find src tests config database routes -name '*.php' -print0 | xargs -0 -n1 php -l
composer validate --no-check-publish
git diff --check
git status --short
```

Le due deprecazioni attualmente mostrate da PHPUnit provengono da `orchestra/testbench-core` su PHP 8.5 e non dal codice di questo package.

## Criteri di completamento

- tutta la suite è verde;
- nessuna modifica preesistente è stata persa;
- `Hour` è selezionabile e istanziabile tramite il factory;
- input numerici invalidi producono eccezioni controllate;
- nessuna divisione per zero o violazione dei return type è possibile;
- migration e rollback sono simmetrici;
- il comportamento degli importi negativi è esplicito e testato;
- Composer dichiara le dipendenze runtime effettive;
- nessun commit viene creato automaticamente.
