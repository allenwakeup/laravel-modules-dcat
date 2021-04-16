<?php 
return [
    'labels' => [
        'Module' => '系統模块',
        'module' => '系統模块',
        'name' => '模块',
        'alias'  => '别名',
        'description'  => '简述',
        'priority'  => '优先级',
        'version'  => '版本号',
        'path' => '安装位置',
        'type' => '类型',
        'sort'  => '序号',
        'status'  => '运行状态',
    ],
    'fields' => [
        'name' => '模块',
        'alias'  => '别名',
        'description'  => '简述',
        'priority'  => '优先级',
        'version'  => '版本号',
        'path' => '安装位置',
        'type' => '类型',
        'sort'  => '序号',
        'status'  => '运行状态',
    ],
    'options' => [
        'type' => [
            0 => '内建集成',
            1 => '外部集成'
        ],
        'status' => [
            0 => '禁用',
            1 => '启用'
        ]
    ],
];
