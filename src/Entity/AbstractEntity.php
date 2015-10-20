<?php

namespace Zff\Base\Entity;

use Zff\Base\Util\Configurator;
use \Zend\Filter\File\Rename;

/**
 * Abstract Entity
 *
 * @package Zff\Base
 * @subpackage Zff\Base_Model
 */
class AbstractEntity
{

    const UPLOAD_DIRECTORY = 'data/upload';

    private static $rename_filter;

    /**
     * @return Rename
     */
    protected function getFileRenameFilter()
    {
        if (!self::$rename_filter) {
            self::$rename_filter = new Rename(array());
        }
        return self::$rename_filter;
    }

    public function exchangeArray($data)
    {
        Configurator::configure($this, $data);
    }

    public function __construct($data = array())
    {
        Configurator::configure($this, $data);
    }

    protected function moveFile(&$oldFilePath, $newFileSourceInfo, $newFileDestPath = self::UPLOAD_DIRECTORY)
    {
        if (is_array($newFileSourceInfo)) {
            $this->getFileRenameFilter()->setFile(['target' => $newFileDestPath]);
            $oldFilePath = $this->getFileRenameFilter()->filter($newFileSourceInfo['tmp_name']);
        }
    }

    protected function removeFile($filePath)
    {
        return unlink($filePath);
    }

    protected function updateFile(&$oldFilePath, $newFileSourceInfo, $newFileDestPath = self::UPLOAD_DIRECTORY)
    {
        if (is_array($newFileSourceInfo)) {
            $this->removeFile($oldFilePath);
            $this->moveFile($oldFilePath, $newFileSourceInfo, $newFileDestPath);
        }
    }

}
