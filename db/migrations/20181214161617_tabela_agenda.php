<?php


use Phinx\Migration\AbstractMigration;

class TabelaAgenda extends AbstractMigration
{
    public function up()
    {
        if(!$this->hasTable('agenda')) {
            $table = $this->table('agenda');
            $table 
                ->addColumn('nome', 'string', ['limit' => 255])
                ->addColumn('cor', 'string', ['limit' => 10])
                ->addColumn('data_hora_inicial', 'datetime')
                ->addColumn('data_hora_final', 'datetime')
                ->addColumn('id_usuario', 'integer', ['comment' => 'FK usuarios'])
                ->addForeignKey('id_usuario', 'usuarios', 'id', ['delete' => 'RESTRICT','update' => 'RESTRICT'])
                ->save();
        }
    }
    public function down()
    {
        if($this->hasTable('agenda')) {
            $this->dropTable('agenda');
        }
    }
}
