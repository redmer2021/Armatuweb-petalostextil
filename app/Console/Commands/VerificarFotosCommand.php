<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VerificarFotosCommand extends Command
{
    /**
     * El nombre del comando para ejecutarlo.
     */
    protected $signature = 'fotos:verificar {--path= : Carpeta donde buscar las imágenes}';

    /**
     * Descripción del comando.
     */
    protected $description = 'Verifica si las imágenes en una carpeta existen en la tabla tb_fotos (campo nomFoto)';

    /**
     * Lógica del comando.
     */
    public function handle()
    {
        // Ruta de la carpeta de imágenes (por defecto public/imgs/img_productos)
        $path = $this->option('path') ?? public_path('imgs/img_productos');

        if (!File::exists($path)) {
            $this->error("❌ La carpeta no existe: $path");
            return Command::FAILURE;
        }

        $this->info("🔍 Verificando archivos en: $path");

        // Obtener nombres de archivo
        $archivos = array_diff(scandir($path), ['.', '..']);

        // Obtener los nombres que ya están en la base
        $nombresBD = DB::table('tb_fotos')->pluck('nomFoto')->toArray();

        // Comparar
        $noRegistrados = array_diff($archivos, $nombresBD);
        $registrados = array_intersect($archivos, $nombresBD);

        // Mostrar resultados
        $this->info("✅ Archivos encontrados en la base: " . count($registrados));
        $this->info("❌ Archivos no registrados en la base: " . count($noRegistrados));

        if (!empty($noRegistrados)) {
            $this->warn("\nListado de archivos no registrados:");
            foreach ($noRegistrados as $archivo) {
                $this->line(" - $archivo");
            }
        }

        if (!empty($registrados)) {
            $this->warn("\nListado de archivos registrados:");
            foreach ($registrados as $archivo) {
                $this->line(" - $archivo");
            }
        }

        return Command::SUCCESS;


    }
}
