<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Spatie\DbDumper\Databases\MySql;

class ExportController extends Controller
{
    public function download()
    {
        MySql::create()
            ->setHost(config('database.connections.mysql.host'))
            ->setDbName(config('database.connections.mysql.database'))
            ->setUserName(config('database.connections.mysql.username'))
            ->setPassword(config('database.connections.mysql.password'))
            ->dumpToFile(storage_path('dump.sql'));

        return response()->download(storage_path('dump.sql'));
    }
}
