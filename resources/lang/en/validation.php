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

    'accepted' => 'El :attribute no se acepta.',
    'accepted_if' => 'El :attribute se acepta solo si :other es :value.',
    'active_url' => 'El :attribute no es un URL válido.',
    'after' => 'El :attribute debe ser un día después de :date.',
    'after_or_equal' => 'El :attribute debe ser un día despúes o igual a :date.',
    'alpha' => 'El :attribute solo debe contener letras.',
    'alpha_dash' => 'El :attribute solo debe contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El :attribute solo debe contener letras y números.',
    'array' => 'El :attribute debe ser una cadena ASCI.',
    'before' => 'El :attribute debe ser un día antes de :date.',
    'before_or_equal' => 'El :attribute debe ser un día antes o igual a :date.',
    'between' => [
        'numeric' => 'El :attribute debe estar entre :min y :max.',
        'file' => 'El :attribute debe estar entre :min y :max kilobytes.',
        'string' => 'El :attribute debe estar entre :min y :max caracteres.',
        'array' => 'El :attribute debe estar entre :min y :max valores.',
    ],
    'boolean' => 'El :attribute debe ser verdadero o falso (0 o 1).',
    'confirmed' => 'Las contraseñas no coinciden.',
    'current_password' => 'La contraseña es incorrecta.',
    'date' => 'El :attribute no es una fecha válida.',
    'date_equals' => 'El :attribute debe conincidir con :date.',
    'date_format' => 'El :attribute no contiene el formato :format.',
    'different' => 'El :attribute y :other deben ser diferentes.',
    'digits' => 'El :attribute debe tener :digits dígitos.',
    'digits_between' => 'El :attribute debe estar entre :min y :max dígitos.',
    'dimensions' => 'El :attribute tiene dimensiones inválidas.',
    'distinct' => 'El :attribute tiene duplicidad.',
    'email' => 'El :attribute no es un email válido.',
    'ends_with' => 'El :attribute debe terminar con uno de los siguientes: :values.',
    'exists' => 'El seleccionado :attribute es inválido.',
    'file' => 'El :attribute debe ser un archivo.',
    'filled' => 'El :attribute es inválido.',
    'gt' => [
        'numeric' => 'El :attribute debe ser mayor que :value.',
        'file' => 'El :attribute debe ser mayor que :value kilobytes.',
        'string' => 'El :attribute debe ser mayor que :value characters.',
        'array' => 'El :attribute debe tener más de :value valores.',
    ],
    'gte' => [
        'numeric' => 'El :attribute debe ser igual o mayor a :value.',
        'file' => 'El :attribute debe ser igual o mayor a :value kilobytes.',
        'string' => 'El :attribute debe ser igual o mayor a :value caracteres.',
        'array' => 'El :attribute debe tener :value valores o más.',
    ],
    'image' => 'El :attribute debe ser una imagen válida.',
    'in' => 'El seleccionado :attribute es inválido.',
    'in_array' => 'El :attribute no existe en :other.',
    'integer' => 'El :attribute debe ser un valor entero.',
    'ip' => 'El :attribute debe ser una dirección de IP válida.',
    'ipv4' => 'El :attribute debe ser una dirección de IPv4 válida.',
    'ipv6' => 'El :attribute debe ser una dirección de IPv6 válida.',
    'json' => 'El :attribute debe ser una dirección de formato JSON válido.',
    'lt' => [
        'numeric' => 'El :attribute debe ser menor que :value.',
        'file' => 'El :attribute debe ser igual o menor que :value kilobytes.',
        'string' => 'El :attribute debe ser menor que :value characters.',
        'array' => 'El :attribute debe ser menor que :value valores.',
    ],
    'lte' => [
        'numeric' => 'El :attribute debe ser igual o menor que :value.',
        'file' => 'El :attribute debe ser igual o menor que :value kilobytes.',
        'string' => 'El :attribute debe ser igual o menor que :value characters.',
        'array' => 'El :attribute no debe tener más valores que :value.',
    ],
    'max' => [
        'numeric' => 'El :attribute no debe ser mayor que :max.',
        'file' => 'El :attribute no debe ser mayor que :max kilobytes.',
        'string' => 'El :attribute no debe ser mayor que :max caracteres.',
        'array' => 'El :attribute no debe tener más valores que :max.',
    ],
    'mimes' => 'El :attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => 'El :attribute debe ser un archio de tipo: :values.',
    'min' => [
        'numeric' => 'El :attribute debe ser por lo menos :min.',
        'file' => 'El :attribute debe ser por lo menos :min kilobytes.',
        'string' => 'El :attribute debe ser por lo menos :min caracteres.',
        'array' => 'El :attribute debe tener por lo menos :min valores.',
    ],
    'multiple_of' => 'El :attribute debe ser múltiplo de :value.',
    'not_in' => 'El seleccionado :attribute es inválido.',
    'not_regex' => 'El :attribute formato es inválido.',
    'numeric' => 'El :attribute debe ser un número.',
    'password' => 'El password es incorrecto.',
    'present' => 'El :attribute debe estar presente.',
    'regex' => 'El :attribute formato es inválido.',
    'required' => 'El :attribute campo es requerido.',
    'required_if' => 'El :attribute campo es requerido cuando :other es :value.',
    'required_unless' => 'El :attribute campo es requerido a menos que :other está en :values.',
    'required_with' => 'El :attribute campo es requerido cuando :values está presente.',
    'required_with_all' => 'El :attribute campo es requerido cuando :values están presentes.',
    'required_without' => 'El :attribute campo es requerido cuando :values no está presente.',
    'required_without_all' => 'El :attribute campo es requerido cuando :values están presentes.',
    'prohibited' => 'El :attribute campo está prohibido',
    'prohibited_if' => 'El :attribute campo está prohibido cuando :other es :value.',
    'prohibited_unless' => 'El :attribute campo está prohibido a menos que :other esté en :values.',
    'prohibits' => 'El :attribute prohíbe :other de estar presente.',
    'same' => 'El :attribute y :other deben coincidir.',
    'size' => [
        'numeric' => 'El :attribute debe ser de tamaño :size.',
        'file' => 'El :attribute debe ser de tamaño :size kilobytes.',
        'string' => 'El :attribute debe ser de tamaño :size caracteres.',
        'array' => 'El :attribute no debe contener el tamaño :size en valores.',
    ],
    'starts_with' => 'El :attribute debe empezar con uno de los siguientes following: :values.',
    'string' => 'El :attribute debe ser cadena ASCI.',
    'timezone' => 'El :attribute de ser un tiempo válido.',
    'unique' => 'El :attribute ya está en uso.',
    'uploaded' => 'El :attribute fallo al cargar.',
    'url' => 'El :attribute debe ser un URL válido.',
    'uuid' => 'El :attribute debe ser un UUID válido.',

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
            'rule-name' => 'custom-message',
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
