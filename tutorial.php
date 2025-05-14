
// reading last logs
===========================
tail -f storage/logs/laravel.log
or
storage\logs\laravel.log
or 
Get-Content storage/logs/laravel.log -Wait




how to update node js
========================
2. Update Node.js Using a Node Package Manager (npm)
Run npm -v to see which installed version you're currently using.
Run npm install npm@latest -g to install the most recent npm update.
Run npm -v again to validate that the npm version was updated correctly.
28 Sept 2023


ecom9 commands 
======================
	to start : 
	1. composer create-project laravel/laravel example-app 
	1.b setup environment and variables
	2. composer require laravel/ui
	3. php artisan ui bootstrap --auth  -- or $ php artisan ui vue --auth  or $ php artisan ui react --auth
	4. npm install && npm run dev
	5. php artisan migrate
	6. php artisan serve
	
	
	
 $ php artisan serve -- to start package

-- install breeze for login 
=================================
	- go to laravel.com
	- navigate to document 
	- starter kit
	- install breeze -
	$ composer require laravel/breeze --dev
	$ php artisan breeze:install 
	$ npm install && npm run dev
	
	$ php artisan migrate

 -- create controller for Admin 
 =================================
	$ php artisan make:controller Admin/AdminController  
	$ php artisan make:migration create_vendors_table
	
	$ php artisan migrate
	
	$ php artisan make:migration create_admins_table
	$ php artisan make:model Vendor
	$ php artisan make:model Admin
	$ php artisan make:middleware Admin
	
	add route middleware to the http/kernel as : 'admin' => \App\Http\Middleware\Admin::class,
	$ php artisan make:seeder AdminsTableSeeder
	$ composer dump-autoload
	$ php artisan db:seed

	
	// need html element formatter 
	@ https://www.freeformatter.com/html-formatter.html#ad-output

	// to process image uploading 
	==================================
	first run $ composer require intervention/image
	php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent
	
	// vendors 
	====================
	$ php artisan make:migration create_vendors_business_details_table
	$ php artisan make:migration create_vendors_bank_details_table
	$ php artisan migrate
	$ php artisan make:seeder VendorTableSeeder
	
	$ php artisan make:model VendorsBusinessDetails
	$ php artisan make:model VendorsBankDetails
	
	$ php artisan make:seeder VendorsBusinessDetailsSeeder
	$ php artisan make:seeder VendorsBankDetailsSeeder
	
	// erp sap - bro Amos
	
	under sections - part #26
	==========================
	$ php artisan make:migration create_sections_table
	$ php artisan migrate
	$ php artisan make:model Section
	$ php artisan make:controller SectionController

  composer create-project aimeos/aimeos myshop
  
  for creating dummy image like no image go to https://www.dummyimage.com/


	include payment platform 
	====================================
	-- from https://laravel.com/docs/9.x/billing#main-content
	composer require laravel/cashier
	php artisan migrate
	php artisan vendor:publish --tag="cashier-migrations"

	to remove any package initially installed 
	==============================================
	- composer remove laravel/cashier 
	this will remove every other dependencies attached to it. 
	
	to install payment platform like flutterwave 
	===============================================
	go to https://laravelrave.netlify.app/getting-started/installation.html#prerequisite

    to rollback database migration for last transaction     
    ==================================================
    php artisan migrate:rollback --step=1

    To include your personal functions  
    =====================================
    sample created :
    1.  go to App directory
    2.  create a folder : Helpers
    3.  go to the helpers folder and create Helper.php file 
    4.  open you composer.json - and add the directory under autoloads 
    5.  include file directory as 
     -   "files":[
            "app/Helpers/Helper.php"
        ]
    6. run this command :
        composer dump-autoload
	
	mysql error - shutting down unexpectedly - how to resolve 
  ====================================================================
        UPDATED APRIL (2022)

        Rename folder mysql/data to mysql/data_old
        Make a copy of mysql/backup folder and name it as mysql/data
        Copy all your database folders and mysql folder from mysql/data_old into mysql/data
        Copy mysql/data_old/ibdata1 file into mysql/data folder

        Start MySQL from XAMPP control panel

        REFERENCE

        https://www.youtube.com/watch?v=ipMedkjMupw&ab_channel=GeekyScript
        Share
        Improve this answer
        Follow
        edited Apr 6, 2022 at 0:58
        answered Apr 6, 2022 at 0:52 

	ssh -i ~/ojo_rsa.pub centos@140.105.46.242
	
	
	generating random strings 
	============================
	e.g str_random(8)
	-- needs to install : composer require laravel/helpers
	
	Import a SQL file in MySQL
	===================================
	1. Open MySQL Command Line
	2. Insert the user name and the password
	3. mysql > use your_database;
	4. mysql > source file_path_with_file_name.sql
		e.g. source d:/db/sisdb.sql;
        

// TO INSTALL DOMPDF 
============================
composer require dompdf/dompdf

// TO INSTALL OMNIPAY PAYPAL 
==============================
composer require league/omnipay omnipay/paypal
@ https://github.com/thephpleague/omnipay-paypal


// importing large records from csv via mysql shell
====================================================

load data infile 'c:/db/pg_gradtb.csv'
into table gradtb
fields terminated by ','
enclosed by '"' lines
terminated by '\n'
(id, regno, session, degree,school_type);


laravel import / export - excel 
====================================
composer require maatwebsite/excel
from : https://docs.laravel-excel.com/3.1/imports/
https://sweetcode.io/import-and-export-excel-files-data-using-in-laravel/
https://www.youtube.com/watch?v=9xuWSK6qqEs

php artisan make:import UsersImport --model=User

// Importing from default disk
============================================
Excel::import(new UsersImport, 'users.xlsx');

// Importing uploaded files
=====================================
Excel::import(new UsersImport, request()->file('your_file'));

// Importing to array or collection
=========================================
$array = Excel::toArray(new UsersImport, 'users.xlsx');
$collection = Excel::toCollection(new UsersImport, 'users.xlsx');
 
namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            User::create([
                'name' => $row[0],
            ]);
        }
    }
}

## in controller
===========================
public function import() 
{
    Excel::import(new UsersImport, 'users.xlsx');
}



Roles and Permission (Spatie)
===================================
run : composer require spatie/laravel-permission

Publish the migrations and config file:
====================================
run : php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

run : php artisan migrate - to create tables 

## $perms = Permission::all()->pluck('id')->toArray();
## $roles = Role::all()->toArray();
## $superAdmin = Role::find(1); 

## $administrator = Role::find(2); 
## $administrator->givePermissionTo('edit-role');##
## $superAdmin->syncPermissions($perms); 

##  $admin = Admin::find(1);
## dd($admin); 
## $admin->assignRole('Administrator');
## $admin->givePermissionTo(['create-student','view-student']);
       

update app / http / kernel
===================================
'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,


create roles and permission using console 
==========================================
-- run : php artisan permission:create-role Super-Admin 
// this  will be created with the default guard as web
// so to specify your guard 
-- run php artisan permission:create-role Super-Admin admin 


Assign all permissions to a role
=====================================
// If you need to assign all permissions to a role, collect an array of the permission ids:

$permissions = Permission::all()->pluck('id')->toArray();

// Then select a role and sync the permissions array:

$role = Role::find(1); // first role on db
$role->syncPermissions($permissions);


When creating roles you can also create and link permissions at the same time:
==================================================================
-- run : php artisan permission:create-role writer web "create articles|edit articles"


Displaying roles and permissions in the console
===============================================
// There is also a show command to show a table of roles and permissions per guard:
-- run : php artisan permission:show


Assigning Roles
=========================
$user->assignRole('writer');

// You can also assign multiple roles at once
$user->assignRole('writer', 'admin');
// or as an array
$user->assignRole(['writer', 'admin']);

A role can be removed from a user:
=====================================
$user->removeRole('writer');


Roles can also be synced:
================================
// All current roles will be removed from the user and replaced by the array given
$user->syncRoles(['writer', 'admin']);

// more at https://spatie.be/docs/laravel-permission/v5/basic-usage/role-permissions

// when run into problem - 
type: php artisan cache:clear


mysql database backup and restore in console
============================================1
mysqldump -u root -p  schoolmgt > schoolmgt_backup.sql  // backup 
mysql -u root -p schoolmgt < schoolmgt_backup.sql // to restore



// laravel - caculating student positions 
//===============================================
visit : https://laracasts.com/discuss/channels/laravel/get-position-subjects-in-exams-by-students-using-laravel
<?php 
## support 
$getProgramme = Input::get('getProgramme');
dump($getProgramme);
$getYear = Input::get('getYear');
dump($getYear);
$getTerm = Input::get('getTerm');
dump($getTerm);
$getLevel = Input::get('getLevel');
dump($getLevel);

$results = Results::where('programmes', $getProgramme)
    // ->where('ternYear',$getYear)
    // ->where('termDesc',$getTerm)
    // ->where('level',$getLevel)
    ->get()
    ->groupBy('subject')
    ->map(function($subject) {
        $rank = 0; $score = -1;
        return $subject->sortByDesc('exams100')->map(function($record) use (&$rank, &$score) {
                if ($score != $record->getAttribute('exams100')) {
                $score = $record->getAttribute('exams100');
                $rank++;
            }

            $record->setAttribute('Position', $rank);

            return collect($record->getAttributes());
        });
    });


dd($results);

## from user 
        $getScores = ViewResults::where('programmes', $getProgramme)
             ->where('ternYear',$getYear)
             ->where('termDesc',$getTerm)
             ->where('level',$getLevel)
            ->get()
            ->groupBy('subject')

            ->map(function($subject) {
                $rank = 0; $score = -1;
                return $subject->sortByDesc('exams100')->map(function($record) use (&$rank, &$score) {
                    if ($score != $record->getAttribute('exams100'))
                    {
                        $score = $record->getAttribute('exams100');
                        $rank++;
                    }
                    $record->setAttribute('Position', $rank);
                    return collect($record->getAttributes());
                });
            });

         $net = $getScores->collapse();

        $getResults = $net->all();
        
   
    

bit bucket 
ATBBubmCp7PMnpMr4PHKPGKA84SZ2F18549B

hrmdrens
vudroc-nugvir-3kyXfa


      <ThemedView style={styles.titleContainer}>
        <ThemedText type="title">List of Songs </ThemedText>
      </ThemedView>




       
      {/* <Collapsible title="File-based routing">
        <ThemedText>
          This app has two screens:{' '}
          <ThemedText type="defaultSemiBold">app/(tabs)/index.tsx</ThemedText> and{' '}
          <ThemedText type="defaultSemiBold">app/(tabs)/explore.tsx</ThemedText>
        </ThemedText>
        <ThemedText>
          The layout file in <ThemedText type="defaultSemiBold">app/(tabs)/_layout.tsx</ThemedText>{' '}
          sets up the tab navigator.
        </ThemedText>
        <ExternalLink href="https://docs.expo.dev/router/introduction">
          <ThemedText type="link">Learn more</ThemedText>
        </ExternalLink>
      </Collapsible> */}

      {/* <Collapsible title="Android, iOS, and web support">
        <ThemedText>
          You can open this project on Android, iOS, and the web. To open the web version, press{' '}
          <ThemedText type="defaultSemiBold">w</ThemedText> in the terminal running this project.
        </ThemedText>
      </Collapsible>
      <Collapsible title="Images">
        <ThemedText>
          For static images, you can use the <ThemedText type="defaultSemiBold">@2x</ThemedText> and{' '}
          <ThemedText type="defaultSemiBold">@3x</ThemedText> suffixes to provide files for
          different screen densities
        </ThemedText>
        <Image source={require('@/assets/images/react-logo.png')} style={{ alignSelf: 'center' }} />
        <ExternalLink href="https://reactnative.dev/docs/images">
          <ThemedText type="link">Learn more</ThemedText>
        </ExternalLink>
      </Collapsible>
      <Collapsible title="Custom fonts">
        <ThemedText>
          Open <ThemedText type="defaultSemiBold">app/_layout.tsx</ThemedText> to see how to load{' '}
          <ThemedText style={{ fontFamily: 'SpaceMono' }}>
            custom fonts such as this one.
          </ThemedText>
        </ThemedText>
        <ExternalLink href="https://docs.expo.dev/versions/latest/sdk/font">
          <ThemedText type="link">Learn more</ThemedText>
        </ExternalLink>
      </Collapsible> */}
      {/* <Collapsible title="Light and dark mode components">
        <ThemedText>
          This template has light and dark mode support. The{' '}
          <ThemedText type="defaultSemiBold">useColorScheme()</ThemedText> hook lets you inspect
          what the user's current color scheme is, and so you can adjust UI colors accordingly.
        </ThemedText>
        <ExternalLink href="https://docs.expo.dev/develop/user-interface/color-themes/">
          <ThemedText type="link">Learn more</ThemedText>
        </ExternalLink>
      </Collapsible> */}
      {/* <Collapsible title="Animations">
        <ThemedText>
          This template includes an example of an animated component. The{' '}
          <ThemedText type="defaultSemiBold">components/HelloWave.tsx</ThemedText> component uses
          the powerful <ThemedText type="defaultSemiBold">react-native-reanimated</ThemedText>{' '}
          library to create a waving hand animation.
        </ThemedText>
        {Platform.select({
          ios: (
            <ThemedText>
              The <ThemedText type="defaultSemiBold">components/ParallaxScrollView.tsx</ThemedText>{' '}
              component provides a parallax effect for the header image.
            </ThemedText>
          ),
        })}
      </Collapsible> */}