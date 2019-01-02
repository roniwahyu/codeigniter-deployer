<?php
/**
 * Part of CodeIgniter Deployer by Kenji Suzuki
 * for my Codeigniter VueJS Starter
 *
 * @author     Syahroni Wahyu Iriananda <https://github.com/roniwahyu>
 * @license    MIT License
 * @copyright  2019 Syahroni Wahyu Iriananda
 * @link       https://github.com/roniwahyu/codeigniter-deployer
 */

$installer = new Installer();
$installer->install();

class Installer
{
    public static function install()
    {
        self::recursiveCopy('vendor/roniwahyu/codeigniter-deployer/deploy', 'deploy');
    }

    private static function copy($src, $dst)
    {
        $success = copy($src, $dst);
        if ($success) {
            echo 'copied: ' . $dst . PHP_EOL;
        }
    }

    /**
     * Recursive Copy
     *
     * @param string $src
     * @param string $dst
     */
    private static function recursiveCopy($src, $dst)
    {
        @mkdir($dst, 0755);
        
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($src, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach ($iterator as $file) {
            if ($file->isDir()) {
                @mkdir($dst . '/' . $iterator->getSubPathName());
            } else {
                $success = copy($file, $dst . '/' . $iterator->getSubPathName());
                if ($success) {
                    echo 'copied: ' . $dst . '/' . $iterator->getSubPathName() . PHP_EOL;
                }
            }
        }
    }
}
