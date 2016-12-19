<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use BackupManager\Config\Config;
use BackupManager\Filesystems;
use BackupManager\Databases;
use BackupManager\Compressors;
use BackupManager\Manager;
use BackupManager\Filesystems\Destination;

class Backup extends CI_Controller {
    private $manager;

	function __construct()
	{
		parent::__construct();

        $filesystems = new Filesystems\FilesystemProvider(Config::fromPhpFile(__DIR__.'/../config/storage.php'));
        $filesystems->add(new Filesystems\Awss3Filesystem);
        $filesystems->add(new Filesystems\GcsFilesystem);
        $filesystems->add(new Filesystems\DropboxFilesystem);
        $filesystems->add(new Filesystems\FtpFilesystem);
        $filesystems->add(new Filesystems\LocalFilesystem);
        $filesystems->add(new Filesystems\RackspaceFilesystem);
        $filesystems->add(new Filesystems\SftpFilesystem);

        $databases = new Databases\DatabaseProvider(Config::fromPhpFile(__DIR__.'/../config/database.php'));
        $databases->add(new Databases\MysqlDatabase);
        $databases->add(new Databases\PostgresqlDatabase);

        $compressors = new Compressors\CompressorProvider;
        $compressors->add(new Compressors\GzipCompressor);
        $compressors->add(new Compressors\NullCompressor);

        $this->manager = new Manager($filesystems, $databases, $compressors);
	}

    public function index()
    {
        $this->manager->makeBackup()
        ->run('development', [
            new Destination('local', 'backup-'.date('Y-m-d-H-i-s').'.sql'),
            //new Destination('s3', 'test/dump.sql')
        ], 'gzip');
    }

    public function backup()
    {

    }

    public function restore()
    {

    }

}