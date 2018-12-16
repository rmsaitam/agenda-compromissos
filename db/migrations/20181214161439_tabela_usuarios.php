<?php


use Phinx\Migration\AbstractMigration;

class TabelaUsuarios extends AbstractMigration
{
    public function up()
    {
        if(!$this->hasTable('usuarios')) {
            $table = $this->table('usuarios');
            $table 
                ->addColumn('nome', 'string', ['limit' => 255])
                ->addColumn('sobrenome', 'string', ['limit' => 255])
                ->addColumn('email', 'string', ['limit' => 255])
                ->addColumn('senha', 'string', ['limit' => 255])
                ->addColumn('status', 'integer', ['default' => 1], ['comment' => 'ativo/inativo'])
                ->save();
        }
    }
    public function down()
    {
        if($this->hasTable('usuarios')) {
            $this->dropTable('usuarios');
        }
    }
}
