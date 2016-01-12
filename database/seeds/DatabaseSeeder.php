<?php
use App\User;

use App\Layer;
use App\Role;
use App\RoleUser;
use App\Bookmark;
use App\Widget;
use App\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        
        Eloquent::unguard();
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		$this->call('UserTableSeeder');
	    $this->call('LayerTableSeeder');
        $this->call('UserLevelTableSeeder');
        $this->call('RoleUserTableSeeder');
        $this->call('RoleLayerTableSeeder');
        $this->call('BookmarkTableSeeder');
      
        //DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
       
        DB::table('Users')->delete();

        //DB::statement("TRUNCATE TABLE role_user");
        //DB::statement("TRUNCATE TABLE Users");
        $user =  array(
            array('name' => 'Muhamad Anjar', 
                'username' => 'admin',
                'email'=> 'arvanria@gmail.com',
                'password' => Hash::make('rth2015') ,
                'leveluser' => '1'
            ),
            array(
                'name'     => 'Muhamad Anjar',
                'username' => 'operator',
                'email'    => 'operator@gmail.com',
                'password' => Hash::make('operator'),
                'leveluser' => '2',
            )
            
        );
        foreach($user as $u){
            User::create($u);
        }

    }

}

class BookmarkTableSeeder extends Seeder {

    public function run()
    {
       
        DB::table('Bookmark')->delete();

        //DB::statement("TRUNCATE TABLE role_user");
        //DB::statement("TRUNCATE TABLE Users");
        
        Bookmark::create(array(
            'name'     => 'Bogor',
            'x_min' => 106.604388339,
            'y_min'    => -6.71663787,
            'x_max' => 107.003690281,
            'y_max' => -6.438022028,
            'wkid' => 4326
        ));

    }

}

class UserLevelTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();
        
        Role::create(array(
            'id' => 0,
            'name'     => 'guest',
        ));
        Role::create(array(
            'id' => 1,
            'name'     => 'admin',
        ));

        Role::create(array(
            'id' => 2,
            'name'     => 'user',
        ));

    }

}

class RoleUserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('role_user')->delete();

        $roleuser = array(
            array('role_id' => 1, 'user_id' => 1),
            array('role_id' => 2, 'user_id' => 2),
        );
        foreach ($roleuser as $key) {
            DB::table('role_user')->insert($key);
        }
       


    }

}

class RoleLayerTableSeeder extends Seeder {

    public function run()
    {
        DB::table('role_layer')->delete();
        $rolelayer =  array(
            array('role_id' => 0, 'layer_id' => 4),
            array('role_id' => 0, 'layer_id' => 5),

            array('role_id' => 1, 'layer_id' => 1),
            array('role_id' => 1, 'layer_id' => 2),
            array('role_id' => 1, 'layer_id' => 3),
            array('role_id' => 1, 'layer_id' => 4),
            array('role_id' => 1, 'layer_id' => 6),
            array('role_id' => 1, 'layer_id' => 7),

            array('role_id' => 2, 'layer_id' => 6),
            array('role_id' => 2, 'layer_id' => 7)
            
            
        );
        

        foreach($rolelayer as $rl){
            DB::table('role_layer')->insert($rl);
        }


    }

}

class LayerTableSeeder extends Seeder {

    public function run()
    {
        DB::table('Layers')->delete();

        $p = array(
            array(
                'layername'     => 'Administrasi Kota Bogor',
                'layerurl' => 'http://rsmm2014.com:6080/arcgis/rest/services/RTH/Peta_Dasar_Kota_Bogor/MapServer',
                'layer'    => 'Peta_Dasar_Kota_Bogor',
                'leveluser' => '1',
                'na' => 'N',
                'id_grouplayer' => '0',
                'orderlayer' => 0,
                'tipelayer' => 'dynamic',
                'option_opacity' => 0.7,
                'option_visible' => true,
                'option_mode' => 1,
                'featureaccess' => '', 
                'visible' => 'viewer',
                'jsonfield' => ' ',
            ),
            array(
                'layername'     => 'Rencana Pola Ruang Kota Bogor',
                'layerurl' => 'http://rsmm2014.com:6080/arcgis/rest/services/RTH/Peta_Rencana_Pola_Ruang_Kota_Bogor/MapServer',
                'layer'    => 'Peta_Rencana_Pola_Ruang_Kota_Bogor',
                'leveluser' => '1',
                'na' => 'N',
                'id_grouplayer' => '0',
                'orderlayer' => 1,
                'tipelayer' => 'dynamic',
                'option_opacity' => 0.7,
                'option_visible' => true,
                'option_mode' => 1,
                'featureaccess' => '', 
                'visible' => 'viewer',
                'jsonfield' => ' ',
            ),
            array(
                'layername'     => 'Tematik Kota Bogor',
                'layerurl' => 'http://rsmm2014.com:6080/arcgis/rest/services/RTH/Peta_Tematik_Kota_Bogor/MapServer',
                'layer'    => 'Peta_Tematik_Kota_Bogor',
                'leveluser' => '1',
                'na' => 'N',
                'id_grouplayer' => '0',
                'orderlayer' => 2,
                'tipelayer' => 'dynamic',
                'option_opacity' => 0.7,
                'option_visible' => true,
                'option_mode' => 1,
                'featureaccess' => '', 
                'visible' => 'viewer',
                'jsonfield' => ' ',
            ),
            array(
                'layername'     => 'Sebaran Point',
                'layerurl' => 'http://rsmm2014.com:6080/arcgis/rest/services/RTH/Peta_POI/MapServer',
                'layer'    => 'Peta_POI',
                'leveluser' => '1',
                'na' => 'N',
                'id_grouplayer' => '0',
                'orderlayer' => 3,
                'tipelayer' => 'dynamic',
                'option_opacity' => 0.7,
                'option_visible' => true,
                'option_mode' => 1,
                'featureaccess' => '', 
                'visible' => 'viewer',
                'jsonfield' => ' ',
            ),
            array(
                'layername'     => 'RTH Kota Bogor',
                'layerurl' => 'http://rsmm2014.com:6080/arcgis/rest/services/RTH/Peta_RTH_Kota_Bogor/MapServer',
                'layer'    => 'Peta_RTH_Kota_Bogor',
                'leveluser' => '1',
                'na' => 'N',
                'id_grouplayer' => '0',
                'orderlayer' => 4,
                'tipelayer' => 'dynamic',
                'option_opacity' => 0.7,
                'option_visible' => true,
                'option_mode' => 1,
                'featureaccess' => '', 
                'visible' => 'viewer',
                'jsonfield' => ' ',
            ),
            array(
                'layername'     => 'RTH Publik Kota Bogor',
                'layerurl' => 'http://rsmm2014.com:6080/arcgis/rest/services/RTH/Peta_RTH_Kota_Bogor_edit/FeatureServer/1',
                'layer'    => 'rth_publik',
                'leveluser' => '1',
                'na' => 'N',
                'id_grouplayer' => '0',
                'orderlayer' => 5,
                'tipelayer' => 'feature',
                'option_opacity' => 0.7,
                'option_visible' => true,
                'option_mode' => 1,
                'featureaccess' => '', 
                'visible' => 'editor',
                'jsonfield' => ' ',
            ),
            array(
                'layername'     => 'RTH Privat Kota Bogor',
                'layerurl' => 'http://rsmm2014.com:6080/arcgis/rest/services/RTH/Peta_RTH_Kota_Bogor_edit/FeatureServer/4',
                'layer'    => 'rth_privat',
                'leveluser' => '1',
                'na' => 'N',
                'id_grouplayer' => '0',
                'orderlayer' => 6,
                'tipelayer' => 'feature',
                'option_opacity' => 0.7,
                'option_visible' => true,
                'option_mode' => 1,
                'featureaccess' => '', 
                'visible' => 'editor',
                'jsonfield' => ' ',
            )  
        );

        foreach($p as $pri){
            layer::create($pri);
        }
        

    }

}

class WidgetTableSeeder extends Seeder {

    public function run()
    {
        DB::table('widget')->delete();

        $widgets = array(
            array(
                'include'     => true,
                'canFloat' => false,
                'type'    => 'titlePane',
                'placeAt' => 'left',
                'path' => '',
                'id' => '',
                'title' => '',
                'open' => false,
                'position' => 5,
                'srcNodeRef' => 'nodeId',
                'option_map' => true,
                'option_mapClickMode' => true, 
                'option_legendLayerInfos' => true,
                'option_tocLayerInfos' => true,
                'option_editorLayerInfos' => true,
                'option_property' => 'value',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            )
            
           
        );

        foreach($widgets as $widget){
            Widget::create($widget);
        }
        

    }

}

class SettingTableSeeder extends Seeder {

    public function run()
    {
        DB::table('setting')->delete();

        $settings = array(
            array(
                'name'     => 'routeTaskUrl',
                'value' => 'http://rsmm2014.com:6080/arcgis/rest/services/SIMTARU/ROUTE/NAServer/Route',
            ),
            array(
                'name'     => 'printTaskURL',
                'value' => 'http://rsmm2014.com:6080/arcgis/rest/services/SIMTARU/ExportWebMap/GPServer/Export%20Web%20Map',
            )
        );

        foreach($settings as $setting){
            Setting::create($setting);
        }
        

    }

}




