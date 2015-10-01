<?php
namespace ZffBase\Util;

/**
 * File
 *
 * TODO fazer alguns testes nos parametros antes de usa-lo
 *
 * @package ZffBase
 * @subpackage ZffBase_Util
 */
class File {

  /**
   * Recursive Modes
   */

  const LEAVES_ONLY = 0;
  const SELF_FIRST = 1;
  const CHILD_FIRST = 2;
  const CATCH_GET_CHILD = 16;

  public static function rmdirRecursive($dir) {
      static::walkDirRecursive($dir, function($file) {
          if ('.' === $file->getBasename() || '..' === $file->getBasename()) {
              return true;
          }
          if ($file->isDir()) {
              return rmdir($file->getPathname());
          }
          return unlink($file->getPathname());
      });
  }

  protected static function walkDirRecursive($dir, $callable, $mode = self::CHILD_FIRST) {
      $it  = new \RecursiveDirectoryIterator($dir);
      $iit = new \RecursiveIteratorIterator($it, self::CHILD_FIRST);
      foreach ($iit as $file) {
          $callable($file);
      }
      $callable(new \SplFileInfo($dir));
  }

  public static function includeFile($path, $filename, $include = true, $disposition = 'inline') {
      $path = $path . DS . $filename;
      if (!file_exists($path)) {
          throw new \NotFoundException(sprintf('Arquivo "%s" não encontrado', $path));
      }
      if (!$include) {
          $ctype = mime_content_type($path);

          header("Content-Type: $ctype");
          header("Content-Length: " . filesize($path));
          header("Content-Disposition: $disposition; filename=\"$filename\"");
      }
      ob_clean();
      flush();
      set_time_limit(0);
      readfile($path);
      exit(0);
  }

}
