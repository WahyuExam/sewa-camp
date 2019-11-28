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

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'not_regex'            => 'The :attribute format is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

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

        'nmSup' =>[
            'required'  => 'Nama Suplier Tidak Boleh Kosong',
        ],

        'noTelpSup' =>[
            'required'  => 'No Telp Suplier Tidak Boleh Kosong',
            'numeric'   => 'Hanya Boleh Diisi Angka',
        ],

        'alamatSup' => [
            'required'  => 'Alamat Suplier Tidak Boleh Kosong',
        ],

        'nmKar' =>[
            'required'  => 'Nama Karyawan Tidak Boleh Kosong',
        ],

        'noTelpKar' =>[
            'required'  => 'No Telp Karyawan Tidak Boleh Kosong',
            'numeric'   => 'Hanya Boleh Diisi Angka',
        ],

        'alamatKar' => [
            'required'  => 'Alamat Karyawan Tidak Boleh Kosong',
        ],

        'nmPel' =>[
            'required'  => 'Nama Pelanggan Tidak Boleh Kosong',
        ],

        'noTelpPel' =>[
            'required'  => 'No Telp Pelanggan Tidak Boleh Kosong',
            'numeric'   => 'Hanya Boleh Diisi Angka',
        ],

        'alamatPel' => [
            'required'  => 'Alamat Pelanggan Tidak Boleh Kosong',
        ],

        'email'     => [
            'required'  => 'Alamat Email Pelanggan Tidak Boleh Kosong',
            'email'     => 'Email Tidak Valid',
        ],

        'nmAlat'    => [
            'required'  => 'Nama Alat Tidak Boleh Kosong',
        ],

        'merkAlat'  => [
            'required'  => 'Merk Alat Tidak Boleh Kosong',
        ],

        'ketAlat'    => [
            'required'  => 'Keterangan Alat Tidak Boleh Kosong',
        ],

        'fotoAlat'  => [
            'required'  => 'Foto Alat Belum Dimasukkan',
        ],

        'fotoKaryawan'  => [
            'required'  => 'Foto Karyawan Belum Dimasukkan',
        ],

        'pengguna' => [
            'required'  => 'Pengguna Belum Diisi',
        ],

        'sandi'  => [
            'required'  => 'Kata Sandi Belum Diisi',
        ],

        'sandiLama'  => [
            'required'  => 'Kata Sandi Lama Belum Diisi',
        ], 

        'sandiBaru' => [
            'required'  => 'Kata Sandi Baru Belum Diisi',
        ],

        'pelanggan' => [
            'required'  => 'Pelanggan Belum Dipilih',
        ],

        'jaminan'   => [
            'required'  => 'Jaminan Belum Dipilih',
        ],

        'noJaminan' => [
            'required'  => 'No Jaminan Belum Diisi',
        ],

        'jmlPinjam' => [
            'required'  => 'Jumlah Pinjam Belum Dimasukkan',
            'numeric'   => 'Inputan Hanya Boleh Angka',
        ],

        'lamaPinjam' => [
            'required'  => 'Lama Pinjam Belum Dimasukkan',
            'numeric'   => 'Inputan Hanya Boleh Angka',
        ],

        'biayaSewa' => [
            'required'  => 'Biaya Sewa Belum Dimasukkan',
            'numeric'   => 'Inputan Hanya Boleh Angka',
        ],

        'stokAlat' => [
            'required'  => 'Stok Alat Belum Dimasukkan',
            'numeric'   => 'Inputan Hanya Boleh Angka',
        ],

        'gaji' => [
            'required' => 'Gaji Belum Dimasukkan',
            'numeric'  => 'Inputan Hanya Boleh Angka',
        ],

        'ket'   => [
            'required'  => 'Keterangan Operasional Belum Diisi',
        ],

        'biaya'  => [
            'required' => 'Biaya Operasional Belum Diisi',
            'numeric'  => 'Inputan Hanya Boleh Angka',
        ],

        'suplier'   => [
            'required'  => 'Suplier Belum Dipilih',
        ],

        'alat'  => [
            'required'  => 'Alat Belum Dimasukkan',
        ],

        'hargaBeli' => [
            'required'  => 'Harga Beli Belum Dimasukkan',
            'numeric'   => 'Inputan Hanya Boleh Angka',
        ],

        'jmlBeli' => [
            'required'  => 'Jumlah Beli Belum Dimasukkan',
            'numeric'   => 'Inputan Hanya Boleh Angka',
        ],

        'alatRusak' => [
            'required'  => 'Jumlah Beli Belum Dimasukkan',
            'numeric'   => 'Inputan Hanya Boleh Angka',
        ],

        'biayaAlatRusak' => [
            'required'  => 'Jumlah Beli Belum Dimasukkan',
            'numeric'   => 'Inputan Hanya Boleh Angka',
        ],

        'jmlRusak' => [
            'required'  => 'Jumlah Alat Rusak Belum Dimasukkan',
            'numeric'   => 'Inputan Hanya Boleh Angka',
        ],

        'ketAlatRusak' => [
            'required' => 'Keterangn Alat Rusak Belum Diisi',
        ],

        'bukti'  => [
            'required'  => 'Foto Bukti Pembayaran Belum Diupload',
        ],

        'tglBayar'  => [
            'required'  => 'Tanggal Tidak Boleh Kosong',
        ],

        'blnLaporan' => [
            'required'  => 'Bulan Tidak Boleh Kosong'
        ],

        'thnLaporan' => [
            'required'  => 'Tahun Tidak Boleh Kosong',
        ],

        'jnsLaporan' => [
            'required'  => 'Jenis Laporan Belum Dipilih',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
