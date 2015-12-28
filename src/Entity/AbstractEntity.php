<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Base\Entity;

use Zff\Base\Util\Configurator;
use Zend\Filter\File\Rename;

/**
 * Abstract Entity
 *
 * @package ZffBase
 * @subpackage ZffBase_Model
 */
class AbstractEntity
{

    const UPLOAD_DIRECTORY = 'data/upload';

    /**
     * @var Rename
     */
    private static $rename_filter;

    public function __construct($data = [])
    {
        Configurator::configure($this, $data);
    }

    public function exchangeArray($data)
    {
        Configurator::configure($this, $data);
    }

    /**
     * @return Rename
     */
    protected function getFileRenameFilter()
    {
        if (!self::$rename_filter) {
            self::$rename_filter = new Rename([]);
        }
        return self::$rename_filter;
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
