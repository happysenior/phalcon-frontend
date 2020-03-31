<?php

class SessionController extends ControllerBase
{

    public function indexAction()
    {
    }

    private function _registerSession($user)
    {
        $this->session->set('id', $user->id);
        $this->session->set('name', $user->name);
        $this->session->set('role', $user->role);
    }

    public function startAction()
    {
        if ($this->request->isPost()) {
            $login = $this->request->getPost('user');
            $password = $this->request->getPost('password');
            $user = User::findFirst([
                "login = :user: AND password = :password:",
                'bind' => ['user' => $login, 'password' => sha1($password)]
            ]);
            
            

            if ($user != false and $user->status == 1) {
                $this->_registerSession($user);
                $this->flash->success('Welcome ' . $user->name);
                return $this->dispatcher->forward(
                    [
                        "controller" => "index",
                        "action" => "index",
                    ]
                );
            } 
            else {
                if($user != false and $user->status == 0) {
                    $this->flash->error("User doesn't exist");
                }
            }                     
        }
        else {
            return $this->dispatcher->forward(
                [
                    "controller" => "user",
                    "action" => "index",
                ]
            );
        }        
    }

    public function changeAction()
    {
        if ($this->request->isPost()) {
            $password = $this->request->getPost('old-password');
            $new_password = $this->request->getPost('new-password');
            $name = $this->session->get('name');
            $password = User::findFirst([
                "name = :user: AND password = :password:",
                'bind' => ['user' => $name, 'password' => sha1($password)]
            ]);
            if ($password != false) {
                if($new_password == $this->request->getPost('new-password-repeat')) {
                    $password->password = sha1($new_password);
                    $password->save();
                    $this->flash->success('Password changed');
                    return $this->dispatcher->forward(
                        [
                            "controller" => "index",
                            "action" => "index",
                        ]
                    );
                }
                else {
                    $this->flash->error('Wrong password');
                }
            }
            else {
                $this->flash->error('Wrong password');
            }
        }

    }
}
