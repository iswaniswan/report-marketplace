<?php


namespace app\utils;


class Permission
{

//    const CREATE = 'create';
//    const READ = 'read';
//    const UPDATE = 'update';
//    const DELETE = 'delete';
//    const APPROVE = 'approve';
//    const PRINT = 'print';
//    const DOWNLOAD = 'download';

    const CREATE = 1;
    const READ = 2;
    const UPDATE = 3;
    const DELETE = 4;
    const APPROVE = 5;
    const PRINT = 6;
    const DOWNLOAD = 7;

    // Static property
    public static $staticProperty = 'static property value';

    // Static method
    public static function getList()
    {
        return [
            'CREATE' => static::CREATE,
            'READ' => static::READ,
            'UPDATE' => static::UPDATE,
            'DELETE' => static::DELETE,
            'APPROVE' => static::APPROVE,
            'PRINT' => static::PRINT,
            'DOWNLOAD' => static::DOWNLOAD,
        ];
    }

    public static function get($id)
    {
        $_array = [
            static::CREATE => 'CREATE',
            static::READ => 'READ',
            static::UPDATE => 'UPDATE',
            static::DELETE => 'DELETE',
            static::APPROVE => 'APPROVE',
            static::PRINT => 'PRINT',
            static::DOWNLOAD => 'DOWNLOAD',
        ];

        return $_array[$id] ?? null;
    }

}