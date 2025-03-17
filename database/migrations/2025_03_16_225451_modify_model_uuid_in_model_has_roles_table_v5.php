<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ModifyModelUuidInModelHasRolesTableV5 extends Migration
{
    public function up()
    {
        // Ubah tipe data kolom model_uuid menjadi UUID
        DB::statement('ALTER TABLE model_has_roles MODIFY model_uuid CHAR(36) NOT NULL');

        // Tambahkan foreign key dengan cascade delete
        DB::statement('
            ALTER TABLE model_has_roles
            ADD CONSTRAINT fk_model_has_roles_users
            FOREIGN KEY (model_uuid)
            REFERENCES users(id)
            ON DELETE CASCADE
        ');
    }

    public function down()
    {
        // Hapus foreign key
        DB::statement('ALTER TABLE model_has_roles DROP FOREIGN KEY fk_model_has_roles_users');

        // Kembalikan tipe data kolom model_uuid ke VARCHAR (string)
        DB::statement('ALTER TABLE model_has_roles MODIFY model_uuid VARCHAR(255) NOT NULL');
    }
}