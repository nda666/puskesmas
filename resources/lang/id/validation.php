<?php

return [

    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut ini berisi standar pesan kesalahan yang digunakan oleh
    | kelas validasi. Beberapa aturan mempunyai multi versi seperti aturan 'size'.
    | Jangan ragu untuk mengoptimalkan setiap pesan yang ada di sini.
    |
    */

    'accepted'             => 'Field :attribute harus diterima.',
    'active_url'           => 'Field :attribute bukan URL yang valid.',
    'after'                => 'Field :attribute harus tanggal setelah :date.',
    'alpha'                => 'Field :attribute hanya boleh berisi huruf.',
    'alpha_dash'           => 'Field :attribute hanya boleh berisi huruf, angka, dan strip.',
    'alpha_num'            => 'Field :attribute hanya boleh berisi huruf dan angka.',
    'array'                => 'Field :attribute harus berupa sebuah array.',
    'before'               => 'Field :attribute harus tanggal sebelum :date.',
    'between'              => [
        'numeric' => 'Field :attribute harus antara :min dan :max.',
        'file'    => 'Field :attribute harus antara :min dan :max kilobytes.',
        'string'  => 'Field :attribute harus antara :min dan :max karakter.',
        'array'   => 'Field :attribute harus antara :min dan :max item.',
    ],
    'boolean'              => 'Field :attribute harus berupa true atau false',
    'confirmed'            => 'Konfirmasi :attribute tidak cocok.',
    'date'                 => 'Field :attribute bukan tanggal yang valid.',
    'date_format'          => 'Field :attribute tidak cocok dengan format :format.',
    'different'            => 'Field :attribute dan :other harus berbeda.',
    'digits'               => 'Field :attribute harus berupa angka :digits.',
    'digits_between'       => 'Field :attribute harus antara angka :min dan :max.',
    'email'                => 'Field :attribute harus berupa alamat surel yang valid.',
    'exists'               => 'Field :attribute yang dipilih tidak valid.',
    'filled'               => 'Field :attribute harus di isi.',
    'image'                => 'Field :attribute harus berupa gambar.',
    'in'                   => 'Field :attribute yang dipilih tidak valid.',
    'integer'              => 'Field :attribute harus merupakan bilangan bulat.',
    'ip'                   => 'Field :attribute harus berupa alamat IP yang valid.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'Field :attribute seharusnya tidak lebih dari :max.',
        'file'    => 'Field :attribute seharusnya tidak lebih dari :max kilobytes.',
        'string'  => 'Field :attribute seharusnya tidak lebih dari :max karakter.',
        'array'   => 'Field :attribute seharusnya tidak lebih dari :max item.',
    ],
    'mimes'                => 'Field :attribute harus dokumen berjenis : :values.',
    'min'                  => [
        'numeric' => 'Field :attribute harus minimal :min.',
        'file'    => 'Field :attribute harus minimal :min kilobytes.',
        'string'  => 'Field :attribute harus minimal :min karakter.',
        'array'   => 'Field :attribute harus minimal :min item.',
    ],
    'not_in'               => 'Field :attribute yang dipilih tidak valid.',
    'numeric'              => 'Field :attribute harus berupa angka.',
    'regex'                => 'Format :attribute tidak valid.',
    'required'             => 'Field :attribute harus di isi.',
    'required_if'          => 'Field :attribute harus di isi bila :other adalah :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'Field :attribute harus di isi bila terdapat :values.',
    'required_with_all'    => 'Field :attribute harus di isi bila terdapat :values.',
    'required_without'     => 'Field :attribute harus di isi bila tidak terdapat :values.',
    'required_without_all' => 'Field :attribute harus di isi bila tidak terdapat ada :values.',
    'same'                 => 'Field :attribute dan :other harus sama.',
    'size'                 => [
        'numeric' => 'Field :attribute harus berukuran :size.',
        'file'    => 'Field :attribute harus berukuran :size kilobyte.',
        'string'  => 'Field :attribute harus berukuran :size karakter.',
        'array'   => 'Field :attribute harus mengandung :size item.',
    ],
    'string'               => 'Field :attribute harus berupa string.',
    'timezone'             => 'Field :attribute harus berupa zona waktu yang valid.',
    'unique'               => 'Field :attribute sudah ada sebelumnya.',
    'url'                  => 'Format :attribute tidak valid.',

    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi Kustom
    |---------------------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi kustom untuk atribut dengan menggunakan
    | konvensi "attribute.rule" dalam penamaan baris. Hal ini membuat cepat dalam
    | menentukan spesifik baris bahasa kustom untuk aturan atribut yang diberikan.
    |
    */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |---------------------------------------------------------------------------------------
    | Kustom Validasi Atribut
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk menukar atribut 'place-holders'
    | dengan sesuatu yang lebih bersahabat dengan pembaca seperti Alamat Surel daripada
    | "surel" saja. Ini benar-benar membantu kita membuat pesan sedikit bersih.
    |
    */

    'attributes'           => [
        //
    ],

];
