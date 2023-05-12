<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted" => "De :attribute moet geaccepteerd worden.",
    "accepted_if" => "De :attribute moet geaccepteerd worden wanneer :other gelijk is aan :value.",
    "active_url" => "De :attribute is geen geldige URL.",
    "after" => "De :attribute moet een datum na :date zijn.",
    "after_or_equal" => "De :attribute moet een datum na of gelijk aan :date zijn.",
    "alpha" => "De :attribute mag alleen letters bevatten.",
    "alpha_dash" => "De :attribute mag alleen letters, cijfers, streepjes en underscores bevatten.",
    "alpha_num" => "De :attribute mag alleen letters en cijfers bevatten.",
    "array" => "De :attribute moet een array zijn.",
    "before" => "De :attribute moet een datum voor :date zijn.",
    "before_or_equal" => "De :attribute moet een datum voor of gelijk aan :date zijn.",
    "between" => [
        "array" => "De :attribute moet tussen de :min en :max items bevatten.",
        "file" => "De :attribute moet tussen de :min en :max kilobytes zijn.",
        "numeric" => "De :attribute moet tussen :min en :max zijn.",
        "string" => "De :attribute moet tussen :min en :max tekens bevatten.",
    ],
    "boolean" => "Het veld :attribute moet waar of onwaar zijn.",
    "confirmed" => "De :attribute bevestiging komt niet overeen.",
    "current_password" => "Het wachtwoord is incorrect.",
    "date" => "De :attribute is geen geldige datum.",
    "date_equals" => "De :attribute moet gelijk zijn aan :date.",
    "date_format" => "De :attribute komt niet overeen met het formaat :format.",
    "declined" => "De :attribute moet geweigerd worden.",
    "declined_if" => "De :attribute moet geweigerd worden wanneer :other gelijk is aan :value.",
    "different" => "De :attribute en :other moeten verschillend zijn.",
    "digits" => "De :attribute moet :digits cijfers bevatten.",
    "digits_between" => "De :attribute moet tussen de :min en :max cijfers bevatten.",
    "dimensions" => "De afbeelding heeft ongeldige afmetingen voor :attribute.",
    "distinct" => "Het veld :attribute heeft een dubbele waarde.",
    "doesnt_end_with" => "De :attribute mag niet eindigen met een van de volgende: :values.",
    "doesnt_start_with" => "De :attribute mag niet beginnen met een van de volgende: :values.",
    "email" => "De :attribute moet een geldig e-mailadres zijn.",
    "ends_with" => "De :attribute moet eindigen met een van de volgende: :values.",
    "enum" => "De geselecteerde :attribute is ongeldig.",
    "exists" => "De geselecteerde :attribute is ongeldig.",
    "file" => "De :attribute moet een bestand zijn.",
    "filled" => "Het veld :attribute moet een waarde hebben.",
    "gt" => [
        "array" => "Het veld :attribute moet meer dan :value items bevatten.",
        "file" => "Het bestand :attribute moet groter zijn dan :value kilobytes.",
        "numeric" => "Het veld :attribute moet groter zijn dan :value.",
        "string" => "Het veld :attribute moet meer dan :value tekens bevatten.",
    ],
    "gte" => [
        "array" => "Het veld :attribute moet :value items of meer bevatten.",
        "file" => "Het bestand :attribute moet minstens :value kilobytes groot zijn.",
        "numeric" => "Het veld :attribute moet groter dan of gelijk zijn aan :value.",
        "string" => "Het veld :attribute moet minstens :value tekens bevatten.",
    ],
    "image" => "Het veld :attribute moet een afbeelding zijn.",
    "in" => "De geselecteerde :attribute is ongeldig.",
    "in_array" => "Het veld :attribute bestaat niet in :other.",
    "integer" => "Het veld :attribute moet een geheel getal zijn.",
    "ip" => "Het veld :attribute moet een geldig IP-adres zijn.",
    "ipv4" => "Het veld :attribute moet een geldig IPv4-adres zijn.",
    "ipv6" => "Het veld :attribute moet een geldig IPv6-adres zijn.",
    "json" => "Het veld :attribute moet een geldige JSON-string zijn.",
    "lowercase" => "Het veld :attribute moet in kleine letters zijn.",
    "lt" => [
        "array" => "Het veld :attribute mag niet meer dan :value items bevatten.",
        "file" => "Het bestand :attribute moet kleiner zijn dan :value kilobytes.",
        "numeric" => "Het veld :attribute moet kleiner zijn dan :value.",
        "string" => "Het veld :attribute moet minder dan :value tekens bevatten.",
    ],
    "lte" => [
        "array" => "Het veld :attribute mag niet meer dan :value items bevatten.",
        "file" => "Het bestand :attribute moet kleiner of gelijk zijn aan :value kilobytes.",
        "numeric" => "Het veld :attribute moet kleiner dan of gelijk zijn aan :value.",
        "string" => "Het veld :attribute moet minder of gelijk zijn aan :value tekens.",
    ],
    "mac_address" => "Het veld :attribute moet een geldig MAC-adres zijn.",
    "max" => [
        "array" => "Het veld :attribute mag niet meer dan :max items bevatten.",
        "file" => "Het bestand :attribute mag niet groter zijn dan :max kilobytes.",
        "numeric" => "Het veld :attribute mag niet groter zijn dan :max.",
        "string" => "Het veld :attribute mag niet meer dan :max tekens bevatten.",
    ],
    "max_digits" => "Het veld :attribute mag niet meer dan :max cijfers bevatten.",
    "mimes" => "Het veld :attribute moet een bestand zijn van het type: :values.",
    "mimetypes" => "Het veld :attribute moet een bestand zijn van het type: :values.",
    "min" => [
        "array" => "Het :attribute moet ten minste :min items bevatten.",
        "file" => "Het :attribute moet ten minste :min kilobytes zijn.",
        "numeric" => "Het :attribute moet ten minste :min zijn.",
        "string" => "Het :attribute moet ten minste :min tekens bevatten.",
    ],
    "min_digits" => "Het :attribute moet ten minste :min cijfers bevatten.",
    "multiple_of" => "Het :attribute moet een veelvoud zijn van :value.",
    "not_in" => "Het geselecteerde :attribute is ongeldig.",
    "not_regex" => "Het formaat van :attribute is ongeldig.",
    "numeric" => "Het :attribute moet een nummer zijn.",
    "password" => [
        "letters" => "Het :attribute moet ten minste één letter bevatten.",
        "mixed" =>
        "Het :attribute moet ten minste één hoofdletter en één kleine letter bevatten.",
        "numbers" => "Het :attribute moet ten minste één nummer bevatten.",
        "symbols" => "Het :attribute moet ten minste één symbool bevatten.",
        "uncompromised" =>
        "Het gegeven :attribute is verschenen in een gegevenslek. Kies alstublieft een ander :attribute.",
    ],
    "present" => "Het :attribute veld moet aanwezig zijn.",
    "prohibited" => "Het :attribute veld is verboden.",
    "prohibited_if" =>
    "Het :attribute veld is verboden wanneer :other :value is.",
    "prohibited_unless" =>
    "Het :attribute veld is verboden tenzij :other in :values zit.",
    "prohibits" => "Het :attribute veld verbiedt :other om aanwezig te zijn.",
    "regex" => "Het formaat van :attribute is ongeldig.",
    "required" => "Het :attribute veld is verplicht.",
    "required_array_keys" =>
    "Het :attribute veld moet items bevatten voor: :values.",
    "required_if" => "Het :attribute veld is verplicht wanneer :other :value is.",
    "required_if_accepted" =>
    "Het :attribute veld is verplicht wanneer :other geaccepteerd is.",
    "required_unless" =>
    "Het :attribute veld is verplicht tenzij :other in :values zit.",
    "required_with" =>
    "Het :attribute veld is verplicht wanneer :values aanwezig zijn.",
    "required_with_all" =>
    "Het :attribute veld is verplicht wanneer :values aanwezig zijn.",
    "required_without" =>
    "Het :attribute veld is verplicht wanneer :values niet aanwezig zijn.",
    "required_without_all" =>
    "Het :attribute veld is verplicht wanneer geen van :values aanwezig zijn.",
    "same" => "Het :attribute en :other moeten overeenkomen.",
    "size" => [
        "array" => "Het :attribute moet :size items bevatten.",
        "file" => "Het :attribute moet :size kilobytes zijn.",
        "numeric" => "Het :attribute moet :size zijn.",
        "string" => "Het :attribute moet :size tekens bevatten.",
    ],

    "starts_with" =>
    "Het :attribute moet beginnen met een van de volgende: :values.",
    "string" => "Het :attribute moet een string zijn.",
    "timezone" => "Het :attribute moet een geldige tijdzone zijn.",
    "unique" => "Het :attribute is al in gebruik.",
    "uploaded" => "Het uploaden van :attribute is mislukt.",
    "uppercase" => "Het :attribute moet in hoofdletters zijn.",
    "url" => "Het :attribute moet een geldige URL zijn.",
    "uuid" => "Het :attribute moet een geldige UUID zijn.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    "custom" => [
        "attribute-name" => [
            "rule-name" => "custom-message",
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    "attributes" => [],
];
