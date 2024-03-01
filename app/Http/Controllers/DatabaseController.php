<?php

namespace App\Http\Controllers;

use App\Models\Database;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Spatie\Backup\Tasks\Backup\BackupJob;


use Alert;

class DatabaseController extends Controller
{
    public function DBView()
    {
        return view('dashboard.admin.database.index', [
            'dbs' => Database::orderBy('tgl_pencadangan')->get()
        ]);
    }

    // public function exportDB(Request $request)
    // {
    //     try {
    //         $timestamp = now();
    //         $fileName = 'backup_' . $timestamp->format('Ymd_His') . '.gz';
    //         $filePath = storage_path('app/db/' . $fileName);

    //         // // Use mysqldump command to export the database
    //         // exec('mysqldump -u ' . env('DB_USERNAME') . ' -p' . env('DB_PASSWORD') . ' ' . env('DB_DATABASE') . ' > ' . $filePath);

    //         if (! Storage::exists('backup')) {
    //             Storage::makeDirectory('backup');
    //         }

    //         $filename = "backup-".date("d-m-Y-H-i-s").".sql";
    //         $mysqlPath = "C:\\xampp/mysql/bin/mysqldump";

    //         $command = "$mysqlPath --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  > " . storage_path() . "/" . $filename."  2>&1";

    //         $returnVar = NULL;
    //         $output  = NULL;

    //         exec($command, $output, $returnVar);

    //         // Check if the file was created
    //         // if (!file_exists($filePath)) {
    //         //     throw new \Exception("Failed to create SQL dump file");
    //         // }

    //         // Save the export history into the databases table
    //         DB::table('databases')->insert([
    //             'tgl_pencadangan' => $timestamp,
    //             'tgl_digunakan' => $timestamp,
    //             'nama' => $fileName,
    //             'path' => $filePath,
    //             'ukuran' => filesize($filePath),
    //             'created_at' => $timestamp,
    //             'updated_at' => $timestamp,
    //         ]);

    //         // Return success response
    //         return response()->download($filePath)->deleteFileAfterSend(true);
    //     } catch (\Exception $e) {
    //         // Log the error
    //         Log::error('Failed to export database: ' . $e->getMessage());

    //         // Return error response
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    public function exportDB(Request $request)
    {
        try {
            // Start the backup process
            BackupJob::dispatch('default');

            // Return success response
            return response()->json(['message' => 'Database backup created successfully'], 200);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to export database: ' . $e->getMessage());

            // Return error response
            return response()->json(['error' => 'Database backup failed'], 500);
        }
    }

    public function importDB(Request $request)
    {
        // Validate the uploaded file
        // $request->validate([
        //     'file' => 'required|mimes:sql|max:2048'
        // ]);

        // Read the uploaded SQL file
        $path = $request->file('file')->store('sql_files');
        $fileDetails = [
            'tgl_pencadangan' => now(),
            'tgl_digunakan' => now(),
            'nama' => $request->file('file')->getClientOriginalName(),
            'path' => $path,
            'ukuran' => $request->file('file')->getSize(),
        ];
    //     // Save the file details to the database
    //     $sqlFile = Database::create($fileDetails);

    //    // Disable foreign key checks
    //     DB::statement('SET FOREIGN_KEY_CHECKS=0');

    //     // Drop the databases table if it exists
    //     DB::statement('DROP TABLE IF EXISTS `databases`');

    //     // Enable foreign key checks
    //     DB::statement('SET FOREIGN_KEY_CHECKS=1');

    //     // Execute SQL queries to import data into the database
    //     $sql = file_get_contents($request->file('file')->path());
    //     DB::unprepared($sql);

        Alert::success('Sukses!', 'Database berhasil diimpor!');
        return redirect()->route('database.index');
    }
}
