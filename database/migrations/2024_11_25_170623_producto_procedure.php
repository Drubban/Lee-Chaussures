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
        // Procedimiento para insertar producto
        DB::unprepared('
            CREATE PROCEDURE sp_ins_prod_yair(
                IN p_nombre VARCHAR(255),
                IN p_descripcion VARCHAR(255),
                IN p_talla DOUBLE,
                IN p_precio DOUBLE,
                IN p_stock INT,
                IN p_url TEXT
            )
            BEGIN
                INSERT INTO producto (nombre, descripcion, talla, precio, stock, url, created_at, updated_at)
                VALUES (p_nombre, p_descripcion, p_talla, p_precio, p_stock, p_url, NOW(), NOW());
            END;
        ');

        // Procedimiento para actualizar producto
        DB::unprepared('
            CREATE PROCEDURE sp_upd_prod_yair(
                IN p_id BIGINT,
                IN p_nombre VARCHAR(255),
                IN p_descripcion VARCHAR(255),
                IN p_talla DOUBLE,
                IN p_precio DOUBLE,
                IN p_stock INT,
                IN p_url TEXT
            )
            BEGIN
                UPDATE producto
                SET
                    nombre = p_nombre,
                    descripcion = p_descripcion,
                    talla = p_talla,
                    precio = p_precio,
                    stock = p_stock,
                    url = p_url,
                    updated_at = NOW()
                WHERE id = p_id;
            END;
        ');

        // Procedimiento para eliminar producto
        DB::unprepared('
            CREATE PROCEDURE sp_del_prod_yair(
                IN p_id BIGINT
            )
            BEGIN
                DELETE FROM producto WHERE id = p_id;
            END;
        ');

        // Procedimiento para obtener todos los productos
        DB::unprepared('
            CREATE PROCEDURE sp_get_prod_yair()
            BEGIN
                SELECT * FROM producto;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_ins_producto');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_upd_producto');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_del_producto');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_get_productos');
    }
};
