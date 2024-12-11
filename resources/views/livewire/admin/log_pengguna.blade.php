<?php

use Livewire\Volt\Component;
use App\Models\LogPengguna;

new class extends Component {
    public function headers():array
    {
        return [
            ['key' => 'name', 'label' => 'Nama'],
            ['key' => 'umur', 'label' => 'Umur'],
            ['key' => 'no_hp', 'label' => 'No HP/Email'],
            ['key' => 'umkm_name', 'label' => 'Nama UMKM'],
            ['key' => 'alamat', 'label' => 'Alamat']
        ];
    }

    public function with():array
    {
        return [
            'headers' => $this->headers(),
            'data' => LogPengguna::orderBy('id', 'desc')->get()
        ];
    }
}; ?>

<div>
    <x-header title="Log Pengguna" separator progress-indicator/>

    <x-card>
        <x-table :headers="$headers" :rows="$data" class="text-base">
            @scope('cell_alamat', $data)
                {{ $data['provinsi'].', '.$data['kabupaten'] }}
            @endscope
        </x-table>
    </x-card>
</div>
