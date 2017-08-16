<?php

use Illuminate\Database\Seeder;
Use App\Node;
class NodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	$nodes = factory(App\Node::class, 5)->create();

  //   	//asignamos los valores al nuevo nodo
  //   	DB::table('nodes')->insert([
  //       	'name' => str_random(10),
  //   		'parent'	=> $randomNumber,
		// ]);
    }
}
