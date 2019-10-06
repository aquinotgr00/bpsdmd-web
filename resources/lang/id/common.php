<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Wording
    |--------------------------------------------------------------------------
    |
    | Translasi umum i18n
    |
    */

    // menus
    'dashboard' => 'beranda',
    'update_profile' => 'ubah profil',
    'sign_out' => 'keluar',

    // crud
    'profile_success' => 'Profil berhasil diubah.',
    'profile_failed' => 'Gagal mengubah profil. Silakan kontak administrator web.',
    'create_success' => ':object berhasil ditambahkan.',
    'create_failed' => ':object gagal ditambahkan. Silakan kontak administrator web.',
    'update_success' => ':object berhasil diubah.',
    'update_failed' => ':object gagal diubah. Silakan kontak administrator web.',
    'delete_success' => ':object berhasil dihapus.',
    'delete_failed' => ':object gagal dihapus. Silakan kontak administrator web.',
    'self_delete_failed' => 'Tidak dapat menghapus diri sendiri.',

    // table
    'view' => 'lihat',
    'add' => 'tambah',
    'edit' => 'ubah',
    'delete' => 'hapus',
    'action' => 'aksi',
    'no_data' => 'Tidak ada data.',

    // manage user
    'user_information' => 'informasi pengguna',
    'user_management' => 'manajemen pengguna',
    'user' => 'pengguna',
    'name' => 'nama',
    'email' => 'alamat email',
    'email_used' => 'Email sudah dipakai. Silakan gunakan alamat email lainnya.',
    'authority' => 'otoritas',
    'status' => 'status',
    'active' => 'aktif',
    'inactive' => 'tidak aktif',
    'profile' => 'profil',
    'institute' => 'instansi',
    'invalid_institute' => 'Instansi yang Anda pilih tidak valid.',
    'wrong_password' => 'Password lama Anda salah.',
    'password' => 'kata kunci',
    'old_password' => 'kata kunci lama',
    'confirm_password' => 'konfirmasi kata kunci',
    'password_leave_blank' => 'Kosongkan password, password lama dan konfirmasi password jika tidak ingin diganti.',
    'choose_institute' => 'pilih instansi',
    'photo' => 'foto',
    'allowed_photo' => 'File yang boleh diupload berformat: jpg, png atau bmp.',
    'max_photo' => 'Ukuran maksimal file :max.',
    'language' => 'bahasa',
    'locale_en' => 'english',
    'locale_id' => 'bahasa',

    //manage org
    'institute_information' => 'informasi instansi',
    'code' => 'kode',
    'type' => 'tipe',
    'short_name' => 'nama pendek',
    'moda' => 'moda',
    'address' => 'alamat',
    'logo' => 'logo',

    //manage program
    'study_program' => 'program studi',
    'degree' => 'jenjang',

    //manage student
    'student' => 'siswa',
    'student_information' => 'informasi siswa',
    'choose_program' => 'pilih program studi',
    'invalid_program' => 'Program studi yang Anda pilih tidak valid.',
    'period' => 'periode masuk',
    'curriculum' => 'tahun kurikulum',
    'date_of_birth' => 'tanggal lahir',
    'class' => 'kelas',
    'ipk' => 'ipk',

    //manage teacher
    'teacher_information' => 'informasi dosen',
    'teacher' => 'dosen',
    'nip' => 'nip',
    'front_degree' => 'gelar depan',
    'back_degree' => 'gelar belakang',
    'identity_number' => 'no ktp',
    'nidn' => 'nidn',
    'teacher_feeder' => 'unggah data feeder',

    //manage pegawai
    'employee_information' => 'informasi pegawai',
    'employee' => 'pegawai',
    'choose_school' => 'pilih sekolah',
    'invalid_school' => 'Sekolah yang Anda pilih tidak valid.',
    'school' => 'sekolah',
    'gender' => 'jenis kelamin',
    'place_of_birth' => 'tempat lahir',
    'nationality' => 'kewarganegaraan',

    // LOGIN
    'login_header' => 'Masuk ke akun anda.',
    'wrong_account' => 'Email/Password salah.',
    'login_button' => 'Login',

    // REGISTER
    'invalid_email_domain' => 'Hanya diperbolehkan menggunakan email resmi dengan domain @kai.com atau @pelni.com',
    'activate_account' => 'Silahkan cek email anda untuk aktivasi.',
    'activate_success' => 'Akun anda sudah teraktivasi, silahkan login.',
    'register_button' => 'Daftar',
    'form' => [
      'org' => 'Jenis Organisasi',
      'org_address' => 'Alamat Lengkap Organisasi',
    ],
    'help_block' => [
      'org' => 'Jenis perusahaan Anda.',
      'org_address' => 'Alamat lengkap perusahaan Anda.',
      'name' => 'Nama lengkap Anda.',
      'email' => 'Email Anda. Harap menggunakan email resmi penanggung jawab ber-akhir-an @pelni.com atau @kai.com',
      'photo' => 'Foto Anda.',
      'toc' => 'Dengan ini saya menyatakan bahwa data yang saya isikan adalah benar.',
      'email_activation' => 'Setelah Anda mengirim formulir ini, kami akan mengirimkan email aktivasi akun Anda ke alamat email Anda.',
    ],

    // EMAIL VERIFICATION
    'email_verification_warning' => 'PENTING!! Jangan beritahukan informasi dibawah kepada siapapun.',
    'email_verification_info' => 'Berikut adalah data yang kamu gunakan untuk verifikasi akun mu',
    'email_verification_header' => 'Kamu harus mengubah password bawaan untuk memverifikasi akun mu.',
    'email_verification_link' => 'Silahkan verifikasi akun mu, <a href=":url">disini</a>',

    //manage feeder
    'feeder' => 'feeder',
    'upload' => 'unggah file',
    'choose_file' => 'pilih file',
];
