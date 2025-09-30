<?php

// override core en language system validation or define your own en language validation message
return [
  'custom' => [
    'harga' => [
        'numeric' => 'Harga harus berupa angka'
    ],
    'foto' => [
        'uploaded' => 'Foto produk wajib diunggah',
        'mime_in' => 'Foto produk harus berformat jpg, jpeg, atau png',
        'max_size' => 'Ukuran maksimum foto produk adalah 1MB'
    ],
    'thumbnail' => [
        'uploaded' => 'Thumbnail wajib diunggah',
        'mime_in' => 'Thumbnail harus berformat jpg, jpeg, atau png',
        'max_size' => 'Ukuran maksimum thumbnail adalah 1MB'
    ]
]
];
