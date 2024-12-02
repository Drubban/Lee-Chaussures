<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Procedimiento para insertar
        DB::unprepared('
        CREATE PROCEDURE sp_ins_cli_yair(
            IN p_name VARCHAR(30),
            IN p_lastName VARCHAR(30),
            IN p_password VARCHAR(255),
            IN p_email VARCHAR(50),
            IN p_phone VARCHAR(20),
            IN p_location VARCHAR(100),
            IN p_about_me VARCHAR(255),
            IN p_status VARCHAR(50),
            IN p_userType VARCHAR(50)
        )
        BEGIN
            INSERT INTO users (`name`, `lastName`, `email`, `password`, `phone`, `location`, `about_me`, `status`, `userType`) 
            VALUES (p_name, p_lastName, p_email, p_password, p_phone, p_location, p_about_me, p_status, p_userType);
        END;
        ');


        // Procedimiento para actualizar
        DB::unprepared('
            CREATE PROCEDURE sp_up_cli_yair(
                IN p_id INT,
                IN p_name VARCHAR(30),
                IN p_lastName VARCHAR(30),
                IN p_password VARCHAR(255),
                IN p_email VARCHAR(50),
                IN p_phone VARCHAR(20),
                IN p_location VARCHAR(100),
                IN p_about_me VARCHAR(255),
                IN p_status VARCHAR(50)
            )
            BEGIN
                UPDATE users 
                SET 
                    `name` = p_name,
                    `lastName` = p_lastName,
                    `email` = p_email,
                    `password` = p_password,
                    `phone` = p_phone,
                    `location` = p_location,
                    `about_me` = p_about_me,
                    `status` = p_status
                WHERE `id` = p_id;
            END;
        ');

        // Procedimiento para eliminar
        DB::unprepared('
            CREATE PROCEDURE sp_del_cli_yair(
                IN p_id INT
            )
            BEGIN
                DELETE FROM users WHERE `id` = p_id;
            END;
        ');

        // Procedimiento para obtener registros
        DB::unprepared('
            CREATE PROCEDURE sp_get_cli_yair()
            BEGIN
                SELECT * FROM users;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar procedimientos
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_ins_cli_yair');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_up_cli_yair');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_del_cli_yair');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_get_cli_yair');
    }
};
