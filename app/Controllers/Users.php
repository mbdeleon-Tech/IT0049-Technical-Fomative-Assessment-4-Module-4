<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index(): string
    {
        $users = (new UserModel())->select('id, username, full_name, avatar, created_at')->orderBy('id', 'ASC')->findAll();

        return view('users/index', [
            'title' => 'User Accounts',
            'activePage' => 'users',
            'users' => $users,
        ]);
    }

    public function new(): string
    {
        return view('users/form', [
            'title' => 'New User',
            'activePage' => 'users',
            'user' => null,
            'errors' => session('errors') ?? [],
        ]);
    }

    public function create()
    {
        $rules = [
            'username' => 'required|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|max_length[100]',
            'password' => 'required|min_length[8]|max_length[255]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('formInput', $this->request->getPost())->with('errors', $this->validator->getErrors());
        }

        (new UserModel())->insert([
            'username' => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'password' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('users'))->with('success', 'User created successfully.');
    }

    public function edit(int $id): string
    {
        $user = (new UserModel())->select('id, username, full_name, avatar, created_at')->find($id);
        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found.');
        }

        return view('users/form', [
            'title' => 'Edit User',
            'activePage' => 'users',
            'user' => $user,
            'usernameValue' => $user['username'],
            'errors' => session('errors') ?? [],
        ]);
    }

    public function update(int $id)
    {
        $model = new UserModel();
        $user = $model->select('id, username, full_name, avatar, created_at')->find($id);
        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found.');
        }

        $rules = [
            'username' => "required|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|max_length[100]',
            'password' => 'permit_empty|min_length[8]|max_length[255]',
        ];
        if ((string) $this->request->getPost('password') !== '') {
            $rules['password_confirm'] = 'required|matches[password]';
        }

        $avatar = $this->request->getFile('avatar');
        if ($avatar && $avatar->getError() !== UPLOAD_ERR_NO_FILE) {
            $rules['avatar'] = 'uploaded[avatar]|max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('formInput', $this->request->getPost())->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ];
        if ((string) $this->request->getPost('password') !== '') {
            $data['password'] = password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        if ($avatar && $avatar->isValid() && ! $avatar->hasMoved()) {
            $uploadPath = FCPATH . 'uploads';
            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $filename = $avatar->getRandomName();
            $temporary = WRITEPATH . 'uploads/' . $filename;
            $avatar->move(WRITEPATH . 'uploads', $filename);
            service('image')->withFile($temporary)->fit(160, 160, 'center')->save($uploadPath . '/' . $filename, 85);
            @unlink($temporary);
            $data['avatar'] = $filename;
        }

        $model->update($id, $data);

        return redirect()->to(site_url('users'))->with('success', 'User updated successfully.');
    }
}
