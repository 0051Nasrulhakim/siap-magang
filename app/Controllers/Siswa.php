<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User as UserEntity;

class Siswa extends BaseController
{
    protected $user;
    protected $siswa;
    protected $angkatan;
    protected $jurusan;
    protected $application;

    public function __construct()
    {
        $this->user = new \App\Models\UserModel();
        $this->siswa = new \App\Models\SiswaModel();
        $this->angkatan = new \App\Models\AngkatanModel();
        $this->jurusan = new \App\Models\JurusanModel();
        $this->application = new \App\Models\ApplicationModel();
    }

    public function index()
    {
        $dsiswa = $this->user
            ->select('users.id, users.username, users.email, siswa.nis, siswa.nama, siswa.kelas, siswa.no_hp, siswa.alamat, angkatan.tahun as angkatan')
            ->join('siswa', 'siswa.user_id = users.id', 'inner')
            ->join('angkatan', 'angkatan.id = siswa.angkatan', "inner")
            ->findAll();

        return view('siswa_add', [
            "title"         => "Magang | Manajemen Siswa",
            "page_title"    => "Manajemen Data Siswa",
            "segment"       => $this->request->getUri()->getSegments(),
            "breadcrumb"    => ['Manajemen', 'Siswa'],
            "angkatan"      => $this->angkatan->findAll(),
            "jurusan"       => $this->jurusan->findAll(),
            "siswa"         => $dsiswa
        ]);
    }

    public function resetPassword()
    {
        $rules = [
            'email' => [
                'label' => lang('Auth.emailAddress'),
                'rules' => 'required|valid_email',
            ],
            'password' => [
                'label' => lang('Auth.password'),
                'rules' => 'required|strong_password',
            ],
            'pass_confirm' => [
                'label' => lang('Auth.repeatPassword'),
                'rules' => 'required|matches[password]',
            ]
        ];

        // validate post data
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // get user by email
        $user = $this->user->where('email', $this->request->getPost('email'))->first();

        if (null === $user) {
            return redirect()->back()->with('error', lang('Auth.forgotNoUser'));
        }

        // generae token reset password
        $user = $user->generateResetHash();
        $this->user->save($user);

        $user = $this->user->where('email', $this->request->getPost('email'))
            ->where('reset_hash', $user->reset_hash)
            ->first();

        if (null === $user) {
            return redirect()->back()->with('error', lang('Auth.forgotNoUser'));
        }

        if (!empty($user->reset_expires) && time() > $user->reset_expires->getTimestamp()) {
            return redirect()->back()->withInput()->with('error', lang('Auth.resetTokenExpired'));
        }

        // Success! Save the new password, and cleanup the reset hash.
        $user->password         = $this->request->getPost('password');
        $user->reset_hash       = null;
        $user->reset_at         = date('Y-m-d H:i:s');
        $user->reset_expires    = null;
        $user->force_pass_reset = false;
        $this->user->save($user);

        return redirect()->to('/profile#password')->with('success', lang('Auth.resetSuccess'));
    }

    public function ceknis()
    {
        $nis = $this->request->getPost("nis");
        $cek = $this->siswa->where("nis", $nis);
        if ($cek->countAllResults() > 0) {
            return $this->response->setJSON([
                'assigned' => true
            ]);
        } else {
            return $this->response->setJSON([
                'assigned' => false
            ]);
        }
    }

    public function store()
    {
        $nis = $this->request->getPost("nis");
        $siswa_user = new UserEntity([
            "email" => $this->request->getPost("email"),
            "username" => $nis,
            "password" => $nis,
            "active" => 1
        ]);

        $siswa_detail = [
            "nis" => $this->request->getPost("nis"),
            "nama" => $this->request->getPost("nama"),
            "kelas" => $this->request->getPost("kelas"),
            "angkatan" => $this->request->getPost("angkatan"),
            "no_hp" => $this->request->getPost("hp"),
            "alamat" => $this->request->getPost("alamat")
        ];

        if ($this->user->withGroup('siswa')->save($siswa_user)) {
            $siswa_detail["user_id"] = $this->user->getInsertID();
            $siswa = new UserEntity($siswa_detail);

            if ($this->siswa->save($siswa)) {
                return $this->response->setJSON([
                    'status'    => 200,
                    'success'   => true,
                    'message'   => 'Siswa berhasil ditambahkan',
                    'data'      => $siswa
                ]);
            } else {
                return $this->response->setJSON([
                    'status'    => 500,
                    'success'   => false,
                    'message'   => implode(", ", $this->siswa->errors())
                ]);
            }
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => implode(", ", $this->user->errors())
            ]);
        }
    }

    public function save_excel()
    {
        $data_excel = $this->request->getFile('excel');
        $ext = $data_excel->getClientExtension();

        if ($ext == "xlsx") {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        } else if ($ext == "xls") {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => 'Format file tidak didukung'
            ]);
        }

        $spreadsheet = $reader->load($data_excel);
        $data = $spreadsheet->getActiveSheet()->toArray();

        foreach ($data as $x => $row) {
            if ($x == 0) continue;
            $angkatan = explode("/", $row[4]);
            $angkatan_fix = $this->angkatan->where("tahun", $angkatan[0])->findAll();

            if (count($angkatan) == 2) {
                $user_data = new UserEntity([
                    'email'     => $row[2],
                    'username'  => $row[0],
                    'password'  => $row[0],
                    'active'    => 1
                ]);

                $this->user->withGroup('siswa')->save($user_data);

                $siswa_data = [
                    'user_id' => $this->user->getInsertID(),
                    'nis' => $row[0],
                    'nama' => $row[1],
                    'kelas' => $row[3],
                    'angkatan' => $angkatan_fix[($angkatan[1] - 1)]->id,
                    'no_hp' => $row[5],
                    'alamat' => $row[6],
                ];

                $this->siswa->save($siswa_data);
            } else {
                return $this->response->setJSON([
                    'status'    => 500,
                    'success'   => false,
                    'message'   => 'Format tahun angkatan salah'
                ]);
            }
        }

        return $this->response->setJSON([
            'status'    => 200,
            'success'   => true,
            'message'   => 'Siswa berhasil ditambahkan'
        ]);
    }

    public function update()
    {
        $siswa_user = [];
        $old_email = $this->request->getPost("old_email");

        $siswa_detail = [
            "nis" => $this->request->getPost("nis"),
            "nama" => $this->request->getPost("nama"),
            "kelas" => $this->request->getPost("kelas"),
            "angkatan" => $this->request->getPost("angkatan"),
            "no_hp" => $this->request->getPost("hp"),
            "alamat" => $this->request->getPost("alamat")
        ];

        if ($this->request->getPost("email") != $old_email) {
            $siswa_user["email"] = $this->request->getPost("email");
        }

        if (!empty($siswa_user)) {
            $siswa_user = new UserEntity($siswa_user);
            if ($this->user->update($this->request->getPost("items"), $siswa_user)) {
                $id = $this->siswa->where("nis", $this->request->getPost("nis"))->first()->id;

                if ($this->siswa->update($id, $siswa_detail)) {
                    return $this->response->setJSON([
                        'status'    => 200,
                        'success'   => true,
                        'message'   => 'Siswa berhasil diperbarui',
                        'data'      => $siswa_detail
                    ]);
                } else {
                    return $this->response->setJSON([
                        'status'    => 500,
                        'success'   => false,
                        'message'   => implode(", ", $this->siswa->errors())
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'status'    => 500,
                    'success'   => false,
                    'message'   => implode(", ", $this->user->errors())
                ]);
            }
        } else {
            $id = $this->siswa->where("nis", $this->request->getPost("nis"))->first()->id;
            
            if ($this->siswa->update($id, $siswa_detail)) {
                return $this->response->setJSON([
                    'status'    => 200,
                    'success'   => true,
                    'message'   => 'Siswa berhasil diperbarui',
                    'data'      => $siswa_detail
                ]);
            } else {
                return $this->response->setJSON([
                    'status'    => 500,
                    'success'   => false,
                    'message'   => implode(", ", $this->siswa->errors())
                ]);
            }
        }
    }

    public function profile_update()
    {
        $data = $this->request->getPost();
        $data['id'] = getSidByUid(user()->id);

        // validate
        if (!$this->validate([
            'email' => ['rules' => 'required|valid_email'],
            'nama' => ['rules' => 'required|alpha_numeric_punct'],
            'kelas' => ['rules' => 'required|alpha_numeric_punct'],
            'no_hp' => ['rules' => 'required|numeric'],
            'alamat' => ['rules' => 'required|alpha_numeric_punct'],
        ])) {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => implode(", ", $this->validator->getErrors())
            ]);
        }

        $siswa_data = [
            'email' => $data['email'],
            'id' => user()->id,
        ];

        if (isset($data['username'])) {
            $siswa_data['username'] = $data['username'];
        }

        if ($this->siswa->save($data) && $this->user->save($siswa_data)) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Profil berhasil diperbarui',
                'data'      => $data
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => implode(", ", $this->siswa->errors())
            ]);
        }
    }

    public function destroy($id)
    {
        if ($this->user->delete($id)) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Siswa berhasil dihapus'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => 'Siswa gagal dihapus'
            ]);
        }
    }

    public function upload_laporan()
    {
        $file = $this->request->getFile('laporan');
        $filename = $file->getRandomName();
        
        $data = [
            'id' => getSidByUid(user_id()),
            'laporan' => $filename,
        ];
        
        $application = $this->application->where('id_siswa', getSidByUid(user_id()))->first();
        
        if ($this->siswa->save($data)) {
            $file->move('assets/laporan', $filename);
            $this->application->update($application->id, ['status' => 'selesai']);

            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Laporan berhasil diupload'
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => implode(", ", $this->siswa->errors())
            ]);
        }
    }
}
