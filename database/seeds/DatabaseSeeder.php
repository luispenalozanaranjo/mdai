<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    public function run(){
        $this->call( workflowEtapasSeed::class );
        $this->call( configNodosSeed::class );
        $this->call( estadosSeed::class );
        $this->call( formulariosSeed::class );
        $this->call( formulariosPregSeed::class );
        $this->call( workflowDatosSeed::class );
        $this->call( areasSeed::class );
        $this->call( cargosSeed::class );
        $this->call( usuariosSeed::class );
        $this->call( regionesSeed::class );
        $this->call( permissionsTableSeed::class );
        $this->call( entidadesSeed::class );
    }
}