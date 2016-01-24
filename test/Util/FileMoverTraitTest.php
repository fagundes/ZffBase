<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */
namespace ZffTest\Base\Util;

use PHPUnit_Framework_TestCase;
use Zff\Base\Util\File;
use ZffTest\Base\Util\Assets\ConfigurableClass;
use ZffTest\Base\Util\Assets\FileMoverClass;

/**
 * Class ConfiguratorTraitTest
 * @package ZffTest\Base\Util
 */
class FileMoverTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var FileMoverClass
     */
    protected $fileMover;
    /**
     * @var array
     */
    protected $randomFileHandler;
    /**
     * @var array
     */
    protected $randomFilePath;

    public function setUp()
    {

        $this->randomFileHandler[] = tmpfile();
        $this->randomFileHandler[] = tmpfile();
        $this->randomFileHandler[] = tmpfile();
        $this->randomFileHandler[] = tmpfile();

        $this->randomFilePath[] = stream_get_meta_data($this->randomFileHandler[0])['uri'];
        $this->randomFilePath[] = stream_get_meta_data($this->randomFileHandler[1])['uri'];
        $this->randomFilePath[] = stream_get_meta_data($this->randomFileHandler[2])['uri'];
        $this->randomFilePath[] = stream_get_meta_data($this->randomFileHandler[3])['uri'];

        fwrite($this->randomFileHandler[0], 'file one content');
        fwrite($this->randomFileHandler[1], 'file two content');
        fwrite($this->randomFileHandler[2], 'file three content');
        fwrite($this->randomFileHandler[3], 'file four content');

        $this->fileMover = new FileMoverClass();
        $this->fileMover->setFilepathOneInfo([
            'name'     => 'empty.txt',
            'tmp_name' => $this->randomFilePath[0],
            'type'     => 'text / plain',
            'size'     => 0,
            'error'    => 0
        ]);

        $this->fileMover->setFilepathTwoInfo([
            'name'     => 'empty.txt',
            'tmp_name' => $this->randomFilePath[1],
            'type'     => 'text / plain',
            'size'     => 0,
            'error'    => 0
        ]);

        if (!file_exists('test/data/upload/otherplace')) {
            mkdir('test/data/upload/otherplace', 0777, true);
        }
    }

    public function tearDown()
    {
        File::rmdirRecursive('test/data');
    }

    public function testMoveFile()
    {
        $this->assertTrue(file_exists($this->randomFilePath[0]));
        $this->assertTrue(file_exists($this->randomFilePath[1]));
        $expectedFilenameOne = basename($this->randomFilePath[0]);
        $expectedFilenameTwo = basename($this->randomFilePath[1]);

        $this->fileMover->moveAllFiles();

        $this->assertAttributeEquals('test/data/upload/' . $expectedFilenameOne, 'filepathOne', $this->fileMover);
        $this->assertAttributeEquals('test/data/upload/otherplace/' . $expectedFilenameTwo, 'filepathTwo', $this->fileMover);
    }

    public function testRemoveFile()
    {
        $this->assertTrue(!file_exists($this->fileMover->getFilepathOne()));
        $this->assertTrue(!file_exists($this->fileMover->getFilepathTwo()));

        $this->fileMover->moveAllFiles();

        $this->assertTrue(file_exists($this->fileMover->getFilepathOne()));
        $this->assertTrue(file_exists($this->fileMover->getFilepathTwo()));

        $this->fileMover->removeAllFiles();

        $this->assertTrue(!file_exists($this->fileMover->getFilepathOne()));
        $this->assertTrue(!file_exists($this->fileMover->getFilepathTwo()));
    }

    public function testUpdateFile()
    {
        $this->assertTrue(!file_exists($this->fileMover->getFilepathOne()));
        $this->assertTrue(!file_exists($this->fileMover->getFilepathTwo()));

        $this->fileMover->moveAllFiles();

        $this->assertTrue(file_exists($fileOneOld = $this->fileMover->getFilepathOne()));
        $this->assertTrue(file_exists($fileTwoOld = $this->fileMover->getFilepathTwo()));

        //setup new files
        $this->fileMover->setFilepathOneInfo([
            'name'     => 'empty.txt',
            'tmp_name' => $this->randomFilePath[2],
            'type'     => 'text / plain',
            'size'     => 0,
            'error'    => 0
        ]);

        $this->fileMover->setFilepathTwoInfo([
            'name'     => 'empty.txt',
            'tmp_name' => $this->randomFilePath[3],
            'type'     => 'text / plain',
            'size'     => 0,
            'error'    => 0
        ]);


        $this->fileMover->updateAllFiles();

        //old and new files aren't the same
        $this->assertNotEquals($this->fileMover->getFilepathOne(), $fileOneOld);
        $this->assertNotEquals($this->fileMover->getFilepathTwo(), $fileTwoOld);

        //removed old files
        $this->assertTrue(!file_exists($fileOneOld));
        $this->assertTrue(!file_exists($fileTwoOld));

        //moved new files
        $this->assertTrue(file_exists($this->fileMover->getFilepathOne()));
        $this->assertTrue(file_exists($this->fileMover->getFilepathTwo()));
    }
}
