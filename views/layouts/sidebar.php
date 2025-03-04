<?php

use app\components\Session;
use app\models\Menu;
use app\widgets\UplonMenu;
use app\models\RolePermissions;

$id_role = Yii::$app->user->identity->role->id;
$roleName = Yii::$app->user->identity->role->name;

$allMenu = Menu::getListMenu($asArray=false, $id_role);

// Generate the menu array
$newMenu = Menu::buildMenu($allMenu);

$menuRoleName =  ['label' => $roleName,'header' => true];
array_unshift($newMenu, $menuRoleName);

$menuLogout = ['label' => 'Logout', 'icon'=>'ti-shift-right', 'url' => ['/site/logout'], 'template'=>'<a class="nav-link {active}" data-method="post" href="{url}" {target}>{icon} {label}</a>'];
array_push($newMenu, $menuLogout);

// echo '<pre>'; var_dump($newMenu); echo '</pre>';

// $dashboard = ['label' => 'Dashboard', 'icon' => 'ti-dashboard', 'url' => ['/dashboard/index']];
// $report = ['label' => 'Report', 'icon' => 'ti-file', 'items' => [
            
//                 ['label' => 'Shopee', 'items' => [
//                         ['label' => 'Summary', 'url' =>['/shopee/index-summary']],
//                         ['label' => 'Tabel', 'url' =>['/shopee/index-serverside']],
//                         ['label' => 'Tabel Income', 'url' =>['/shopee-income/index-serverside']]
//                     ],
//                 ], 
                
//                 ['label' => 'Tiktok', 'items' => [
//                         ['label' => 'Summary', 'url' =>['/tiktok/index-summary']],
//                         ['label' => 'Tabel', 'url' =>['/tiktok/index-serverside']],
//                         ['label' => 'Tabel Income', 'url' =>['/tiktok-income/index-serverside']]
//                     ],
//                 ],

//                 ['label' => 'Tokopedia', 'items' => [
//                         ['label' => 'Summary', 'url' =>['/tokopedia/index-summary']],
//                         ['label' => 'Tabel', 'url' =>['/tokopedia/index-serverside']],
//                         ['label' => 'Tabel Keuangan', 'url' =>['/tokopedia-keuangan/index-serverside']]
//                     ],
//                 ],

//                 ['label' => 'Lazada', 'items' => [
//                         ['label' => 'Summary', 'url' =>['/lazada/index-summary']],
//                         ['label' => 'Tabel', 'url' =>['/lazada/index-serverside']],
//                         ['label' => 'Tabel Income', 'url' =>['/lazada-income/index-serverside']]
//                     ],
//                 ],

//                 ['label' => 'Offline', 'items' => [
//                         ['label' => 'Summary', 'url' =>['/offline-report/index-summary']],
//                         ['label' => 'Tabel', 'url' =>['/offline-report/index-serverside']],
//                     ],
//                 ],
                
//             ]
//         ];
// $fileUnggah = ['label' => 'File Unggah', 'icon' => 'ti-file', 'url' => ['/file-source/index']];
// $offline = ['label' => 'Offline', 'icon' => 'ti-receipt', 'url' => ['/offline/index']];
// $setting = ['label' => 'Setting', 'icon' => 'ti-settings', 'items' => [
//             ['label' => 'User', 'url' =>['/user']],
//             ['label' => 'Role', 'url' =>['/role']],
//         ]];

// $sequenceMenu = [
//     ['type' => 'header', 'value' => '#', 'data' => ['label' => $roleName,'header' => true]],
//     ['type' => 'key', 'value' => 'Dashboard', 'data' => $dashboard], 
//     ['type' => 'key', 'value' => 'Report', 'data' => $report],
//     ['type' => 'header', 'value' => '#', 'data' => ['label' => 'Input','header' => true]],
//     ['type' => 'key', 'value' => 'File Unggah', 'data' => $fileUnggah],
//     ['type' => 'key', 'value' => 'Offline', 'data' => $offline],
//     ['type' => 'header', 'value' => '#', 'data' => ['label' => 'Pengaturan','header' => true]],
//     ['type' => 'key', 'value' => 'Setting', 'data' => $setting],
//     ['type' => 'header', 'value' => '#', 'data' => ['label' => 'Logout', 'icon'=>'ti-shift-right', 'url' => ['/site/logout'], 'template'=>'<a class="nav-link {active}" data-method="post" href="{url}" {target}>{icon} {label}</a>']]
// ];

// $allUserRoleMenu = RolePermissions::getAllRolePermission(Yii::$app->user->identity->id_role);

// $itemsAdmin = [];

// foreach ($sequenceMenu as $menu) {
//     if ($menu['type'] == 'header') {
//         $itemsAdmin[] = $menu['data'];
//         continue;
//     } else {
//         $value = $menu['value'];
//         foreach (@$allUserRoleMenu as $rolePermissions) {
//             $permissions = json_decode($rolePermissions->permission);
//             if (@$rolePermissions->roleMenu->name == $value && in_array('read', $permissions)) {
//                 $itemsAdmin[] = $menu['data'];
//                 continue;
//             }
//         }
//     }
// }

// if (Session::isAdmin() === false) {
//     $itemsAdmin = [];
// }

// $items = [
//     ['label' => 'Logout', 'icon'=>'ti-shift-right', 'url' => ['/site/logout'], 'template'=>'<a class="nav-link {active}" data-method="post" href="{url}" {target}>{icon} {label}</a>'],
// ];

// foreach ($itemsAdmin as $item) {
//     array_push($items, $item);
// }


// $menuItem = [];

// echo '======================================';
// echo '<pre>'; var_dump($itemsAdmin); echo '</pre>'; die()

?>


<div class="left-side-menu">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <?= UplonMenu::widget([
                'items' => $newMenu
            ]) ?>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>


<?php /*
 <div class="left-side-menu">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="index.html">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="calendar.html">
                        <i class="mdi mdi-calendar-month"></i>
                        <span> Calendar </span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span> Layouts </span>
                        <span class="badge badge-danger badge-pill float-right">New</span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="layouts-dark-sidebar.html">Dark Sidebar</a></li>
                        <li><a href="layouts-small-sidebar.html">Small Sidebar</a></li>
                        <li><a href="layouts-sidebar-collapsed.html">Sidebar Collapsed</a></li>
                        <li><a href="layouts-unsticky.html">Unsticky Layout</a></li>
                        <li><a href="layouts-boxed.html">Boxed Layout</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-google-pages"></i>
                        <span> Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="pages-starter.html">Starter Page</a></li>
                        <li><a href="pages-login.html">Login</a></li>
                        <li><a href="pages-register.html">Register</a></li>
                        <li><a href="pages-recoverpw.html">Recover Password</a></li>
                        <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                        <li><a href="pages-404.html">Error 404</a></li>
                        <li><a href="pages-500.html">Error 500</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-content-copy"></i>
                        <span> Extra Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="pages-timeline.html">Timeline</a></li>
                        <li><a href="pages-invoice.html">Invoice</a></li>
                        <li><a href="pages-pricing.html">Pricing</a></li>
                        <li><a href="pages-gallery.html">Gallery</a></li>
                        <li><a href="pages-maintenance.html">Maintenance</a></li>
                        <li><a href="pages-comingsoon.html">Coming Soon</a></li>
                    </ul>
                </li>
                <li class="menu-title mt-2">Components</li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-format-underline"></i>
                        <span> User Interface </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="ui-buttons.html">Buttons</a></li>
                        <li><a href="ui-cards.html">Cards</a></li>
                        <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                        <li><a href="ui-checkbox-radio.html">Checkboxs-Radios</a></li>
                        <li><a href="ui-navs.html">Navs</a></li>
                        <li><a href="ui-progress.html">Progress</a></li>
                        <li><a href="ui-modals.html">Modals</a></li>
                        <li><a href="ui-notification.html">Notification</a></li>
                        <li><a href="ui-alerts.html">Alerts</a></li>
                        <li><a href="ui-carousel.html">Carousel</a></li>
                        <li><a href="ui-bootstrap.html">Bootstrap UI</a></li>
                        <li><a href="ui-typography.html">Typography</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-package-variant-closed"></i>
                        <span> Components </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="components-grid.html">Grid</a></li>
                        <li><a href="components-range-sliders.html">Range sliders</a></li>
                        <li><a href="components-sweet-alert.html">Sweet Alerts</a></li>
                        <li><a href="components-ratings.html">Ratings</a></li>
                        <li><a href="components-treeview.html">Treeview</a></li>
                        <li><a href="components-tour.html">Tour</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-puzzle-outline"></i>
                        <span> Widgets </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="widgets-tiles.html">Tile Box</a></li>
                        <li><a href="widgets-charts.html">Chart Widgets</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-black-mesa"></i>
                        <span> Icons </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="icons-materialdesign.html">Material Design</a></li>
                        <li><a href="icons-ionicons.html">Ion Icons</a></li>
                        <li><a href="icons-fontawesome.html">Font awesome</a></li>
                        <li><a href="icons-themify.html">Themify Icons</a></li>
                        <li><a href="icons-simple-line.html">Simple line Icons</a></li>
                        <li><a href="icons-weather.html">Weather Icons</a></li>
                        <li><a href="icons-pe7.html">PE7 Icons</a></li>
                        <li><a href="icons-typicons.html">Typicons</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-file-document-box-check-outline"></i>
                        <span class="badge badge-warning badge-pill float-right">8</span>
                        <span> Forms </span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="form-elements.html">General Elements</a></li>
                        <li><a href="form-advanced.html">Advanced Form</a></li>
                        <li><a href="form-validation.html">Form Validation</a></li>
                        <li><a href="form-pickers.html">Form Pickers</a></li>
                        <li><a href="form-wizard.html">Form Wizard</a></li>
                        <li><a href="form-mask.html">Form Masks</a></li>
                        <li><a href="form-uploads.html">Multiple File Upload</a></li>
                        <li><a href="form-xeditable.html">X-editable</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-table-settings"></i>
                        <span> Tables </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="tables-basic.html">Basic Tables</a></li>
                        <li><a href="tables-datatable.html">Data Tables</a></li>
                        <li><a href="tables-responsive.html">Responsive Table</a></li>
                        <li><a href="tables-tablesaw.html">Tablesaw</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-poll"></i>
                        <span> Charts </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="charts-flot.html">Flot Charts</a></li>
                        <li><a href="charts-morris.html">Morris Charts</a></li>
                        <li><a href="charts-chartjs.html">Chartjs</a></li>
                        <li><a href="charts-peity.html">Peity Charts</a></li>
                        <li><a href="charts-chartist.html">Chartist Charts</a></li>
                        <li><a href="charts-c3.html">C3 Charts</a></li>
                        <li><a href="charts-sparkline.html">Sparkline Charts</a></li>
                        <li><a href="charts-knob.html">Jquery Knob</a></li>
                    </ul>
                </li>
                <li class="menu-title mt-2">More</li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="mdi mdi-share-variant"></i>
                        <span> Multi Level </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level nav" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);">Level 1.1</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" aria-expanded="false">Level 1.2
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li>
                                    <a href="javascript: void(0);">Level 2.1</a>
                                </li>
                                <li>
                                    <a href="javascript: void(0);">Level 2.2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
*/ ?>