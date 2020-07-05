<?php

//FileSystem.php
// 文件系统类: 把文件操作相关的代码 放在一起, 方便后期使用

class FileSystem
{
    //读取文件大小
    public static function filesize($filename)
    {
        $bytes = filesize($filename); //读取大小, 单位是byte
        $n     = 0;
        while ($bytes >= 1024) {
            $bytes /= 1024;
            //$n 记录进位的次数, 每次除以1024就代表进一位
            $n++;
        }
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        return round($bytes, 2) . $units[$n];
    }

    //复制目录
    public static function copyDir($src, $dst)
    {
        if (is_dir($src)) {
            mkdir($dst);
            $handle = opendir($src);
            while (($name = readdir($handle)) !== false) {
                if ($name != '.' && $name != '..') {
                    //获取遍历出来的子文件的实际路径
                    $newSrc = $src . '/' . $name;
                    $newDst = $dst . '/' . $name;
                    self::copyDir($newSrc, $newDst);
                }
            }
            closedir($handle);
        }
        if (is_file($src)) {
            copy($src, $dst);
        }
    }

    //查看所有内容
    public static function readAllDir()
    {
        # code...
    }

    //删除目录
    public static function removeDir()
    {
        # code...
    }

    //...
}

//类的另一种用途: 归纳!!
//把具有相同功能的函数 存放在一个类中, 这样在未来用到的时候方便查找!
//一般称为 工具类
