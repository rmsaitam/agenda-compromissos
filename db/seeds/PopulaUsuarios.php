<?php


use Phinx\Seed\AbstractSeed;

class PopulaUsuarios extends AbstractSeed
{
    public function run()
    {
        $usuarios = array(
                array(
                    "nome" => "Bjorn",
                    "sobrenome" => "Cyril",
                    "email" => "bjorn.cyril@example.com",
                    "senha" => password_hash("secret", PASSWORD_DEFAULT)
                ),
                array(
                    "nome" => "Aline",
                    "sobrenome" => "Silva",
                    "email" => "aline.silva@example.com",
                    "senha" => password_hash("secret", PASSWORD_DEFAULT)
                    ),
                );

        $user = $this->table("usuarios");
        $user->insert($usuarios)
        ->save();
    }
}
