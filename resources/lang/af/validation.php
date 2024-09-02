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

    'accepted' => 'Die :attribute moet aanvaar word.',
    'accepted_if' => 'Die :attribute moet aanvaar word wanneer :other is :value.',
    'active_url' => 'Die :attribute is nie n geldige URL nie.',
    'after' => 'Die :attribute moet n datum wees na :date.',
    'after_or_equal' => 'Die :attribute moet n datum wees na of gelyk aan :date.',
    'alpha' => 'Die :attribute mag slegs letters bevat.',
    'alpha_dash' => 'Die :attribute mag slegs letters, syfers, strepies en onderstrepe bevat.',
    'alpha_num' => 'Die :attribute mag slegs letters en syfers bevat.',
    'array' => 'Die :attribute moet n versameling wees.',
    'before' => 'Die :attribute moet n datum wees voor :date.',
    'before_or_equal' => 'Die :attribute moet n datum wees voor of gelyk aan :date.',

    'between' => [
        'array' => 'Die :attribute moet tussen :min en :max items hê.',
        'file' => 'Die :attribute moet tussen :min en :max kilobyte wees.',
        'numeric' => 'Die :attribute moet tussen :min en :max wees.',
        'string' => 'Die :attribute moet tussen :min en :max karakters wees.',
    ],

    'boolean' => 'Die :attribute veld moet waar of vals wees.',
    'confirmed' => 'Die :attribute bevestiging stem nie ooreen nie.',
    'current_password' => 'Die wagwoord is ongeldig.',
    'date' => 'Die :attribute is nie n geldige datum nie.',
    'date_equals' => 'Die :attribute moet n datum gelyk aan :date wees.',
    'date_format' => 'Die :attribute stem nie ooreen met die formaat :format nie.',
    'declined' => 'Die :attribute moet afgekeur word.',
    'declined_if' => 'Die :attribute moet afgekeur word wanneer :other is :value.',
    'different' => 'Die :attribute en :other moet verskillend wees.',
    'digits' => 'Die :attribute moet :digits syfers wees.',
    'digits_between' => 'Die :attribute moet tussen :min en :max syfers wees.',
    'dimensions' => 'Die :attribute het ongeldige beeldafmetings.',
    'distinct' => 'Die :attribute veld het n dupliseer waarde.',
    'doesnt_end_with' => 'Die :attribute mag nie eindig met een van die volgende: :values nie.',
    'doesnt_start_with' => 'Die :attribute mag nie begin met een van die volgende: :values nie.',
    'email' => 'Die :attribute moet n geldige e-posadres wees.',
    'ends_with' => 'Die :attribute moet eindig met een van die volgende: :values.',
    'enum' => 'Die gekose :attribute is ongeldig.',
    'exists' => 'Die gekose :attribute is ongeldig.',
    'file' => 'Die :attribute moet n lêer wees.',
    'filled' => 'Die :attribute veld moet n waarde hê.',
    
    'gt' => [
        'array' => 'Die :attribute moet meer as :value items hê.',
        'file' => 'Die :attribute moet groter wees as :value kilogrepe.',
        'numeric' => 'Die :attribute moet groter wees as :value.',
        'string' => 'Die :attribute moet groter wees as :value karakters.',
    ],
    'gte' => [
        'array' => 'Die :attribute moet :value items of meer hê.',
        'file' => 'Die :attribute moet groter wees as of gelyk aan :value kilogrepe.',
        'numeric' => 'Die :attribute moet groter wees as of gelyk aan :value.',
        'string' => 'Die :attribute moet groter wees as of gelyk aan :value karakters.',
    ],

    'image' => 'Die :attribute moet \'n beeld wees.',
    'in' => 'Die geselekteerde :attribute is ongeldig.',
    'in_array' => 'Die :attribute veld bestaan nie in :other nie.',
    'integer' => 'Die :attribute moet \'n heelgetal wees.',
    'ip' => 'Die :attribute moet \'n geldige IP-adres wees.',
    'ipv4' => 'Die :attribute moet \'n geldige IPv4-adres wees.',
    'ipv6' => 'Die :attribute moet \'n geldige IPv6-adres wees.',
    'json' => 'Die :attribute moet \'n geldige JSON-string wees.',
    'lt' => [
        'array' => 'Die :attribute moet minder as :value items hê.',
        'file' => 'Die :attribute moet minder as :value kilogrepe wees.',
        'numeric' => 'Die :attribute moet minder as :value wees.',
        'string' => 'Die :attribute moet minder as :value karakters wees.',
    ],
    
    'lte' => [
        'array' => 'Die :attribute mag nie meer as :value items hê nie.',
        'file' => 'Die :attribute moet minder as of gelyk aan :value kilogrepe wees.',
        'numeric' => 'Die :attribute moet minder as of gelyk aan :value wees.',
        'string' => 'Die :attribute moet minder as of gelyk aan :value karakters wees.',
    ],
    'mac_address' => 'Die :attribute moet \'n geldige MAC-adres wees.',
    'max' => [
        'array' => 'Die :attribute mag nie meer as :max items hê nie.',
        'file' => 'Die :attribute mag nie groter as :max kilogrepe wees nie.',
        'numeric' => 'Die :attribute mag nie groter as :max wees nie.',
        'string' => 'Die :attribute mag nie groter as :max karakters wees nie.',
    ],
    'max_digits' => 'Die :attribute mag nie meer as :max syfers hê nie.',
    'mimes' => 'Die :attribute moet \'n lêer van tipe wees: :values.',
    'mimetypes' => 'Die :attribute moet \'n lêer van tipe wees: :values.',
    'min' => [
        'array' => 'Die :attribute moet ten minste :min items hê.',
        'file' => 'Die :attribute moet ten minste :min kilogrepe wees.',
        'numeric' => 'Die :attribute moet ten minste :min wees.',
        'string' => 'Die :attribute moet ten minste :min karakters wees.',
    ],
    
    'min_digits' => 'Die :attribute moet ten minste :min syfers hê.',
    'multiple_of' => 'Die :attribute moet \'n veelvoud van :value wees.',
    'not_in' => 'Die gekiesde :attribute is ongeldig.',
    'not_regex' => 'Die :attribute formaat is ongeldig.',
    'numeric' => 'Die :attribute moet \'n nommer wees.',
    'password' => [
        'letters' => 'Die :attribute moet ten minste een letter bevat.',
        'mixed' => 'Die :attribute moet ten minste een hoofletter en een kleinletter bevat.',
        'numbers' => 'Die :attribute moet ten minste een nommer bevat.',
        'symbols' => 'Die :attribute moet ten minste een simbool bevat.',
        'uncompromised' => 'Die gegewe :attribute het in \'n dataverlies verskyn. Kies asseblief \'n ander :attribute.',
    ],
    'present' => 'Die :attribute veld moet teenwoordig wees.',
    'prohibited' => 'Die :attribute veld is verbode.',
    'prohibited_if' => 'Die :attribute veld is verbode wanneer :other is :value.',
    'prohibited_unless' => 'Die :attribute veld is verbode tensy :other is in :values.',
    'prohibits' => 'Die :attribute veld verbied :other om teenwoordig te wees.',
    'regex' => 'Die :attribute formaat is ongeldig.',
    'required' => 'Die :attribute veld is verpligtend.',
    'required_array_keys' => 'Die :attribute veld moet inskrywings bevat vir: :values.',
    'required_if' => 'Die :attribute veld is verpligtend wanneer :other is :value.',
    'required_unless' => 'Die :attribute veld is verpligtend tensy :other is in :values.',
    'required_with' => 'Die :attribute veld is verpligtend wanneer :values teenwoordig is.',
    'required_with_all' => 'Die :attribute veld is verpligtend wanneer :values teenwoordig is.',
    'required_without' => 'Die :attribute veld is verpligtend wanneer :values nie teenwoordig is nie.',
    'required_without_all' => 'Die :attribute veld is verpligtend wanneer geen van :values teenwoordig is nie.',
    'same' => 'Die :attribute en :other moet ooreenstem.',
    'size' => [
        'array' => 'Die :attribute moet :size items bevat.',
        'file' => 'Die :attribute moet :size kilogrepe wees.',
        'numeric' => 'Die :attribute moet :size wees.',
        'string' => 'Die :attribute moet :size karakters wees.',
    ],
    'starts_with' => 'Die :attribute moet begin met een van die volgende: :values.',
    'string' => 'Die :attribute moet \'n string wees.',
    'timezone' => 'Die :attribute moet \'n geldige tydsone wees.',
    'unique' => 'Die :attribute is reeds geneem.',
    'uploaded' => 'Die :attribute kon nie opgelaai word nie.',
    'url' => 'Die :attribute moet \'n geldige URL wees.',
    'uuid' => 'Die :attribute moet \'n geldige UUID wees.',
    
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

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'pasgemaakte-boodskap',
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

    'attributes' => [],

];
