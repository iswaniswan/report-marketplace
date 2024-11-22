<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Query;
use yii\db\Expression;

/**
 * This is the model class for table "Menu".
 *
 * @property int $id
 * @property int|null $id_parent
 * @property string $route Route or controller name (e.g., dashboard, user)
 * @property string $name text name
 * @property string|null $alias text alias
 * @property string $created_at Creation Timestamp
 * @property string $updated_at Last Update Timestamp
 * @property string $icon icon
 * @property string $url url
 * @property string $n_order n_order
 * @property RolePermission|null $rolePermission
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_parent'], 'integer'],
            [['name'], 'required'],
            [['created_at', 'updated_at', 'route'], 'safe'],
            [['name', 'route', 'alias', 'icon', 'url', 'n_order'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_parent' => 'Id Parent',
            'name' => 'Name',
            'route' => 'Route',
            'alias' => 'Alias',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'icon' => 'Icon',
            'url' => 'URL',
            'n_order' => 'Order'
        ];
    }

    public function beforeSave($model)
    {
        if ($this->route == null || $this->route == '') {
            $this->route = strtolower($this->name);
            $this->route = str_replace(" ", "-", $this->route);
        }

        if ($this->id_parent == null) {
            $this->id_parent = 0;
        }

        if ($this->n_order == null) {
            $this->n_order = static::findNextMenuOrder($this->id_parent);
        }
        // Call the parent implementation which will continue the save process
        return parent::beforeSave($model);
    }

    public function getParent()
    {
        return $this->hasOne(Menu::class, ['id' => 'id_parent']);
    }

    public static function getListMenu($asArray=false, $id_role=null)
    {
        $query = static::find()->where([
            'status' => 1
        ])->orderBy(['n_order' => SORT_ASC]);

        if ($id_role != null) {

            $query = (new Query())
                ->select(['m.*'])
                ->from(['rp' => 'role_permissions'])
                ->innerJoin(['m' => 'menu'], 'rp.id_menu = m.id')
                ->where([
                    'and',
                    new Expression("rp.permission LIKE '%read%'"),
                    ['rp.id_role' => $id_role], 
                    ['m.status' => 1]
                ])->orderBy(['m.n_order' => SORT_ASC]);
        }

        if ($asArray) {
            return ArrayHelper::map($query->all(), 'id', 'name');
        }

        return $query->all();
    }

    public static function isCan($id_menu=null, $id_access=null, $permission=null)
    {
        $is_can = false;

        if ($id_menu != null and $id_access != null and $permission != null) {
            $accessDetail = AccessDetail::find()->where([
                'id_access' => $id_access,
                'id_menu' => $id_menu
            ])->one();

            if ($accessDetail != null and $accessDetail->{'is_'.strtolower($permission)} == 1) {
                $is_can = true;
            }
        }

        return $is_can;
    }

    public function getBadgeStatus()
    {
        $text = $this->status == '1' ? 'Active' : 'Inactive';

        $html = <<<HTML
                <span class="badge badge-light-dark">$text</span>
        HTML;

        if ($this->status == '1') {
            $html = <<<HTML
                    <span class="badge badge-light-success">$text</span>
            HTML;
        }

        return $html;
    }

    public function getLevel($menu=null, $level=0)
    {   
        if ($menu == null) {
            $parent = $this->getParent()->one();
        } else {
            $parent = $menu->getParent()->one();
        }

        if ($parent == null) {
            return $level;
        }
        
        $level += 1;
        return $this->getLevel($parent, $level);        
    }

    public static function getAllParentMenu()
    {
        return static::find()->where([
            'id_parent' => 0
        ])->all();
    }

    public static function getAllMenu($root=false)
    {        
        $query = static::find();

        if ($root) {
            $query->where([
                'id_parent' => 0
            ]);
        }

        return $query->orderBy(['n_order' => SORT_ASC])
                ->all();
    }

    // public static function getAllUserRole($id_role)
    // {
    //     return static::find()->where([
    //         'id_role' => $id_role
    //     ])->all();
    // }


    public function getRolePermission($id_role=null)
    {
        if ($id_role != null) {
            return RolePermissions::findOne(['id_role' => $id_role, 'id_menu' => $this->id]);
        }
    }

    // public static function getAllRoleMenu($id_role, $root=false)
    // {
    //     $query =  static::find()->where([
    //         'id_role' => $id_role
    //     ]);
        
    //     if ($root) {
    //         $query->andWhere([
    //             'id_parent' => 0
    //         ]);
    //     }
        
    //     return $query->all();
    // }


    // public static function buildMenu($data, $parentId=0)
    // {
    //     $menu = [];
    //     foreach ($data as $row) {
    //         if ($row['id_parent'] == $parentId) {
    //             $item = [

    //             ]
    //         }
    //     }
    // }

    public static function findNextMenuOrder($id_parent=0)
    {
        $query = static::find()->where([
            'id_parent' => $id_parent
        ]);
        $result = $query->select('n_order');

        $array = [];
        foreach ($result->all() as $menu) {
            $array[] = $menu->n_order;
        }

        $numbers = array_map('intval', $array);

        // Sort the array
        sort($numbers);

        // Find the next number
        $nextNumber = null;
        for ($i = 0; $i < count($numbers) - 1; $i++) {
            if ($numbers[$i + 1] !== $numbers[$i] + 1) {
                // Found a gap
                $nextNumber = $numbers[$i] + 1;
                break;
            }
        }

        // If no gaps, the next number is the largest + 1
        if ($nextNumber === null) {
            $nextNumber = end($numbers) + 1;
        }

        // Output the result
        return $nextNumber;
    }


    public static function buildMenu($data, $parentId = 0)
    {
        $data = (array) $data;

        $menu = [];
        foreach ($data as $row) {
            if ($row['id_parent'] == $parentId) {
                $item = [
                    'label' => $row['name']
                ];

                if ($row['icon'] != null) {
                    $item['icon'] = $row['icon'];
                }

                // Recursively add child items
                $children = static::buildMenu($data, $row['id']);
                if (!empty($children)) {
                    $item['items'] = $children;
                } else {
                    $item['url'] = [$row['url']];
                }
                $menu[] = $item;
            }
        }
        return $menu;
    }

}
