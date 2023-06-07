<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User as UserEntity;

class User extends BaseController
{
    protected $user;
    protected $pembimbing;

    public function __construct() {
        $this->user         = new \App\Models\UserModel();
        $this->pembimbing   = new \App\Models\PembimbingModel();
    }

    public function store()
    {
        $user = new UserEntity([
            "email" => $this->request->getPost("email"),
            "username" => $this->request->getPost("username"),
            "password" => $this->request->getPost("username"),
            "active" => 1,
        ]);

        $user_detail = [
            "nama"  => $this->request->getPost("nama"),
            "no_hp" => $this->request->getPost("hp"),
            "email" => $this->request->getPost("email"),
        ];

        if($this->user->withGroup('pembimbing')->save($user)) {
            $user_detail['user_id'] = $this->user->getInsertID();

            if ($this->pembimbing->save($user_detail)){
                return $this->response->setJSON([
                    'status'    => 200,
                    'success'   => true,
                    'message'   => 'User pembimbing berhasil ditambahkan',
                ]);
            } else {
                return $this->response->setJSON([
                    'status'    => 500,
                    'success'   => false,
                    'message'   => implode(", ", $this->pembimbing->errors())
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
    
    public function update()
    {
        $old_email = $this->request->getPost("old_email");
        $user = [];

        $uid = $this->request->getPost("item");
        $pid = $this->pembimbing->select('id')->where('user_id', $uid)->first();

        $user_detail = [
            "nama"  => $this->request->getPost("nama"),
            "no_hp" => $this->request->getPost("hp"),
        ];

        if ($this->request->getPost("email") != $old_email) {
            $user['email'] = $this->request->getPost("email");
            $user_detail['email'] = $this->request->getPost("email");
        }

        if(!empty($user)){
            $user['id'] = $uid;
            $user = new UserEntity($user);
            
            if ($this->user->save($user)) {
                if ($this->pembimbing->update($pid->id, $user_detail)) {
                    return $this->response->setJSON([
                        'status'    => 200,
                        'success'   => true,
                        'message'   => 'User pembimbing berhasil diubah',
                    ]);
                } else {
                    return $this->response->setJSON([
                        'status'    => 500,
                        'success'   => false,
                        'message'   => implode(", ", $this->pembimbing->errors())
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
            if ($this->pembimbing->update($pid->id, $user_detail)) {
                return $this->response->setJSON([
                    'status'    => 200,
                    'success'   => true,
                    'message'   => 'User pembimbing berhasil diubah',
                ]);
            } else {
                return $this->response->setJSON([
                    'status'    => 500,
                    'success'   => false,
                    'message'   => implode(", ", $this->pembimbing->errors())
                ]);
            }
        }
    }

    public function profile_update()
    {
        $data = $this->request->getPost();
        $data['id'] = user()->id;

        if (!$this->validate([
            'nama' => 'required|min_length[3]|alpha_numeric_punct',
            'no_hp' => 'required|numeric|min_length[10]',
            'email' => 'required|valid_email',
        ])) {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => implode(", ", $this->validator->getErrors())
            ]);
        }

        $user = new UserEntity($data);

        $data_pembimbing = $data;
        $data_pembimbing['id'] = getPidByUid(user()->id);

        if ($this->user->save($user) && $this->pembimbing->save($data_pembimbing)) {
            return $this->response->setJSON([
                'status'    => 200,
                'success'   => true,
                'message'   => 'Profile berhasil diubah',
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 500,
                'success'   => false,
                'message'   => implode(", ", $this->user->errors())
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

    public function reset_pass()
    {
        $users = new \App\Models\UserModel();

        $rules = [
            'email'        => 'required|valid_email',
            'password'     => 'required|strong_password',
            'pass_confirm' => 'required|matches[password]',
        ];

        
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = $users->where('email', $this->request->getPost('email'))
            ->where('reset_hash', $this->request->getPost('token'))
            ->first();

        if (null === $user) {
            return redirect()->back()->with('error', lang('Auth.forgotNoUser'));
        }

        
        // Success! Save the new password, and cleanup the reset hash.
        $user->password         = $this->request->getPost('password');
        $user->reset_hash       = null;
        $user->reset_at         = date('Y-m-d H:i:s');
        $user->reset_expires    = null;
        $user->force_pass_reset = false;
        $users->save($user);

        return redirect()->back()->with('message', "Your password has been successfully changed");
    }
}
