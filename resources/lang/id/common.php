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
    // Application Name
    'application_name' => 'SIM SDM TRANAS',
    'app_sub_name' => 'BPSDM Kementrian Perhubungan',
    'app_sub_name_short' => 'BPSDM Perhubungan',

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
    'feeder_success' => 'Feeder :object berhasil diunggah.',
    'feeder_failed' => 'Feeder :object gagal diunggah. Silakan kontak administrator web.',
    'self_delete_failed' => 'Tidak dapat menghapus diri sendiri.',
    'confirm_delete' => 'Apakah Anda yakin?',
    'please_choose' => 'Silakan pilih :object',
    'invalid_option' => 'Pilihan :object tidak valid.',

    // table
    'view' => 'lihat',
    'add' => 'tambah',
    'edit' => 'ubah',
    'delete' => 'hapus',
    'action' => 'aksi',
    'no_data' => 'Tidak ada data.',
    'import' => 'import',
    'done' => 'sudah',
    'not_yet' => 'belum',

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
    'id_dikti' => 'id dikti',
    'code' => 'kode',
    'type' => 'tipe',
    'short_name' => 'nama pendek',
    'letter_of_est' => 'SK pendirian',
    'date_of_est' => 'tanggal SK pendirian',
    'letter_of_opr' => 'SK operasional',
    'date_of_opr' => 'tanggal SK operasional',
    'moda' => 'moda',
    'address' => 'alamat',
    'description' => 'deskripsi',
    'phone_number' => 'telepon',
    'fax' => 'faksimile',
    'website' => 'website',
    'ownership_status' => 'status milik',
    'under_supervision' => 'pembina',
    'education_type' => 'bentuk pendidikan',
    'accreditation' => 'akreditasi',
    'logo' => 'logo',

    //manage program
    'program_information' => 'informasi program studi',
    'study_program' => 'program studi',
    'degree' => 'jenjang',
    'vision' => 'visi',
    'mission' => 'misi',
    'est_date' => 'tanggal berdiri',
    'passing_grade_credits' => 'sks lulus',

    //manage student
    'student' => 'siswa',
    'student_information' => 'informasi siswa',
    'choose_program' => 'pilih program studi',
    'invalid_program' => 'Program studi yang Anda pilih tidak valid.',
    'nim' => 'nim',
    'period' => 'periode masuk',
    'curriculum' => 'tahun kurikulum',
    'date_of_birth' => 'tanggal lahir',
    'class' => 'kelas',
    'ipk' => 'ipk',
    'graduation_year' => 'tahun lulus',
    'mobile_phone_number' => 'handphone',
    'religion' => 'agama',
    'mother_name' => 'ibu kandung',
    'foreign_citizen' => 'wna',
    'social_protection_card' => 'penerima kps',
    'occupation_type' => 'jenis tinggal',
    'start_semester' => 'semester mulai',
    'current_semester' => 'semester tempuh',
    'student_credits' => 'sks',
    'certificate_number' => 'no ijazah',
    'enrollment_type' => 'jenis daftar',
    'graduation_type' => 'jenis keluar',
    'student_feeder' => 'unggah feeder data siswa',

    //manage teacher
    'teacher_information' => 'informasi dosen',
    'teacher' => 'dosen',
    'nip' => 'nip',
    'front_degree' => 'gelar depan',
    'back_degree' => 'gelar belakang',
    'identity_number' => 'no KTP',
    'nidn' => 'nidn',
    'teacher_feeder' => 'unggah feeder data dosen',

    //manage pegawai
    'employee_code' => 'NIK',
    'employee_information' => 'informasi pegawai',
    'employee' => 'pegawai',
    'choose_school' => 'pilih sekolah',
    'invalid_school' => 'Sekolah yang Anda pilih tidak valid.',
    'school' => 'sekolah',
    'gender' => 'jenis kelamin',
    'place_of_birth' => 'tempat lahir',
    'nationality' => 'kewarganegaraan',
    'graduate' => 'lulus',

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

    // manage feeder
    'feeder' => 'feeder',
    'upload' => 'unggah file',
    'choose_file' => 'pilih file',

    // manage lisensi
    'license' => 'lisensi',
    'chapter' => 'BAB',
    'parent' => 'induk',

    //manage short course
    'short_course' => 'diklat',
    'short_course_data' => 'data diklat',
    'short_course_information' => 'informasi diklat',
    'short_course_participant' => 'peserta diklat',
    'start_date' => 'tanggal mulai',
    'end_date' => 'tanggal selesai',
    'total_target_student' => 'target jumlah siswa',
    'total_realization_student' => 'realisasi jumlah siswa',
    'open_sk' => 'sk buka',
    'close_sk' => 'sk tutup',
    'generation' => 'angkatan',
    'year' => 'tahun',
    'short_course_time' => 'lama diklat',
    'place' => 'tempat',
    'background' => 'latar belakang',
    'competence_certificat' => 'sertifikat kompetensi',
    'training_certificat' => 'sertifikat pelatihan',
    'district' => 'kabupaten',

    //manage certificate
    'certificate' => 'sertifikat',
    'validity_period' => 'masa berlaku',
    'employee_certificate' => 'sertifikat pegawai',
    'choose_certificate' => 'pilih sertifikat',
    'invalid_certificate' => 'Sertifikat yang Anda pilih tidak valid.',
    'certificate_feeder' => 'unggah feeder data sertifikat pegawai',

    //manage job title
    'job_title' => 'jabatan',

    //manage recruitment
    'recruitment' => 'penawaran siswa',
    'detailed_search' => 'pencarian detail',
    'find_student' => 'cari taruna',
    'search_result' => 'hasil pencarian',
    'choose_job_title' => 'pilih jabatan',
    'age_range' => 'rentang usia',
    'school_accreditation' => 'akreditasi sekolah',
    'program_filter' => 'filter program studi dengan kompetensi yang dicari',
    'minimum_age' => 'usia minimal 21 tahun',
    'minimum_ipk' => 'IPK minimal pelamar adalah 2.5',
    'all_gender' => 'semua jenis kelamin',
    'all_accreditation' => 'semua akreditasi',
    'find_taruna' => 'cari taruna',
    'list_candidate' => 'daftar penawaran kandidat',
    'position_offered' => 'jabatan yang ditawarkan',

    // manage competency
    'competency' => 'kompetensi',
    'competency_unit' => 'kompetensi unit',
    'unit' => 'unit',
    'competency_main_purpose' => 'kompetensi tujuan utama',
    'main_purpose' => 'tujuan utama',
    'competency_main_function' => 'kompetensi fungsi utama',
    'main_function' => 'fungsi utama',
    'competency_key_function' => 'kompetensi fungsi kunci',
    'key_function' => 'fungsi kunci',

    // job function
    'job_function' => 'fungsi pekerjaan',
];
